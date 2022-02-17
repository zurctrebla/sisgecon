<?php

namespace App\Http\Controllers\Admin;

use App\Events\CheckGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGuest;
use App\Models\{
    Guest,
    Point,
    Sector,
    User

};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    protected $employee;
    protected $sector;
    protected $point;
    protected $guest;

    public function __construct(User $employee, Sector $sector, Point $point, Guest $guest)
    {
        $this->employee = $employee;
        $this->sector   = $sector;
        $this->point    = $point;
        $this->guest    = $guest;

        $this->middleware(['can:guests']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = date('Y-m-d');

        $guests = $this->guest
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('register', 'LIKE', "{$filter}%");    /* filtra points */
                        $query->where('reason_status','N');                 /* filtra points sem motivos*/

                    }])
                    ->where('status', '<>', 'Expirado')
                    ->orderBy('expires_at', 'DESC')->paginate();

        $sheets = [];

        foreach ($guests as $guest) {

            array_push($sheets, $guest->points);

            CheckGuest::dispatch($guest);

        }

        return view('admin.pages.guests.index', compact('guests', 'sheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = $this->sector->all();

        return view('admin.pages.guests.create', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateGuest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateGuest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 'Pendente';
        $data['authorization'] = uniqid();

        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $data['photo'] = $request->photo->store('guests/photos');
        }

        $guest = $this->guest->create($data);

        if ($request->model && $request->plate) {

            $data['model'] = $request->model;
            $data['plate'] = $request->plate;

            $guest->vehicles()->create($data);
        }

        if ($request->doc_no) {

            $data['doc_no'] = $request->doc_no;
            $data['emission'] = $request->emission;
            $data['emission_for'] = $request->emission_for;
            $data['uf'] = $request->uf;

            $guest->document()->create($data);
        }

        return redirect()->route('guests.index')->with('message', 'Visitante cadastrado com sucesso');

    }

    /**
     * Register the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateGuest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $id)
    {
        if (!$guest = $this->guest->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->reason) {
            $data['reason'] = $request->reason;
            $data['reason_status'] = 'Y';
        }

        $data['register'] = date('Y-m-d H:i:s');
        $data['date'] = date('Y-m-d');
        $data['hour'] = date('H:i:s');

        $guest->points()->create($data);

        return redirect()->route('guests.index')->with('message', 'Ponto Registrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        if (!$guest = $this->guest->find($id)) {
            return redirect()->back();
        }

        $dados = $this->point
                    ->where('pointable_id', $id)
                    ->where('pointable_type', 'App\Models\Guest')
                    ->orderBy('date', 'desc')
                    ->get()
                    ->groupBy('date');
        /* aqui possivelmente seja implementado uma função para agrupar os registros, dividindo-os em dia, mes e ano */

        return view('admin.pages.guests.history', compact('guest', 'dados'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$guest = $this->guest->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$guest = $this->guest->find($id))
            return redirect()->back();

        $sectors = Sector::all();

        return view('admin.pages.guests.edit', compact('guest', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateGuest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$guest = $this->guest->find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $data['photo'] = $request->photo->store('guests/photos');
        }

        if ($request->status) {

            $data['authorized_at'] = auth()->user()->name;

        }

        // if ($request->photo->isValid()) {

        //     if (Storage::exists($guest->photo)) {
        //         Storage::delete($guest->photo);
        //     }

        //     $data['photo'] = $request->photo->store('guests/photos');
        // }

        $guest->update($data);

        return redirect()->route('guests.index')->with('message', 'Visitante atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$guest = $this->guest->find($id))
            return redirect()->back();

        if (Storage::exists($guest->photo)) {
            Storage::delete($guest->photo);
        }

        $guest->delete();
        return redirect()->route('guests.index')->with('message', 'Visitante deletado com sucesso');
    }

    /**
     * PDF
     */
    public function pdf($id)
    {
        if(!$guest = $this->guest->find($id))
            return redirect()->back();

        $dados = $this->point
            ->where('pointable_id', $id)
            ->where('pointable_type', 'App\Models\Guest')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date');
        // $guests = Guest::all();

        return PDF::loadView('admin.pages.guests.pdf', compact('guest', 'dados'))
                    // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                    ->stream()/* download("relatorio_{{$guest->name}}.pdf") */;
    }

    /**
     * PDF
     */
    public function test($id)
    {
        if(!$guest = $this->guest->find($id))
            return redirect()->back();

        return view('admin.pages.guests.pdf', compact('guest'));
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $guests = $this->guest
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('authorization', $request->filter);
                                }
                            })
                            ->orWhereHas('documents', function($query) use ($request){  /** adciona pesquisa por documento do visitante */
                                if ($request->filter) {
                                    $query->where('doc_no', $request->filter);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.pages.guests.index', compact('guests', 'filters'));
    }
}
