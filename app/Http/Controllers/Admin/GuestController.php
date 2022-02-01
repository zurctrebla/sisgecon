<?php

namespace App\Http\Controllers\Admin;

use App\Events\CheckGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGuest;
use App\Models\Sector;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    protected $repository;
    protected $user;

    public function __construct(Guest $guest, User $user)
    {
        $this->repository = $guest;
        $this->user = $user;

        $this->middleware(['can:guests']);

        // $this->middleware('permission:guest-list|guest-create|guest-edit|guest-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:guest-create', ['only' => ['create','store']]);
        // $this->middleware('permission:guest-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:guest-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$guests = $this->repository/* ->where('status', '<>', 'Expirado') */->paginate();

        $filter = date('Y-m-d');

        $guests = $this->repository
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('register', 'LIKE', "{$filter}%");    /* filtra points */
                        $query->where('reason_status','N');                 /* filtra points sem motivos*/

                    }])
                    ->where('status', '<>', 'Expirado')
                    ->orderBy('expires_at', 'DESC')->paginate();

        //dd($guests);
        // $guest = $this->repository->first();

        // $guest->points()->create([
        //     'register' => date('y-m-d H:i:s'),
        // ]);

        // dd($guest->points);

        foreach ($guests as $guest) {

            CheckGuest::dispatch($guest);

        }

        return view('admin.pages.guests.index', compact('guests'));
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function history()
    // {
    //     $guests = $this->repository->where('status', 'Expirado')->paginate();

    //     return view('admin.pages.guests.history', compact('guests'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::all();

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

        $guest = $this->repository->create($data);

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

            $guest->documents()->create($data);
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
        if (!$guest = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->reason) {
            $data['reason'] = $request->reason;
            $data['reason_status'] = 'Y';
        }

        $data['register'] = date('Y-m-d H:i:s');

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
        if (!$guest = $this->repository->find($id)) {
            return redirect()->back();
        }

        /* aqui possivelmente seja implementado uma função para agrupar os registros, dividindo-os em dia, mes e ano */

        return view('admin.pages.guests.historySheet', compact('guest'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$guest = $this->repository->find($id)){
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
        if(!$guest = $this->repository->find($id))
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
        if(!$guest = $this->repository->find($id))
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
        if(!$guest = $this->repository->find($id))
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
    public function pdf()
    {
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];

        // $pdf = PDF::loadView('myPDF', $data);
        // return $pdf->download('itsolutionstuff.pdf');

        $guests = Guest::all();

        // dd($products);
        // return view('admin.pages.guests.index', compact('guests'));

        return PDF::loadView('admin.pages.guests.index', compact('guests'))
                    // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                    ->stream()/* download('teste.pdf') */;
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

        $guests = $this->repository
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
                            ->latest()/*
                            ->tenantUser() */
                            ->paginate();

        return view('admin.pages.guests.index', compact('guests', 'filters'));
    }
}
