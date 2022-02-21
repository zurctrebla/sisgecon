<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\{
    Point,
    Sector,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeController extends Controller
{
    protected $employee;
    protected $sector;
    protected $point;

    public function __construct(
        User $employee,
        Sector $sector,
        Point $point
        )
    {
        $this->employee = $employee;
        $this->sector = $sector;
        $this->point = $point;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = date('Y-m-d');

        $employees = $this->employee
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('date', 'LIKE', "{$filter}%");    /* filtra points */
                        $query->where('reason_status','N');                 /* filtra points sem motivos*/

                    }])->where('role_id', '2')                              /* filtra os usuários com função funcionário */
                    ->paginate();

        // return view('admin.pages.employees.index', compact('employees'));
        return view('admin.pages.employees.index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = $this->sector->get();

        // return view('admin.pages.employees.create', compact('sectors'));
        return view('admin.pages.employees.create', [
            'sectors' => $sectors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 2;
        $employee = $this->employee->create($data);

        $employee->employee()->create($data);

        if ($request->number) {

            $data['number'] = $request->number;
            $employee->phone()->create($data);
        }

        // if ($request->model && $request->plate) {

        //     $data['model'] = $request->model;
        //     $data['plate'] = $request->plate;

        //     $employee->vehicles()->create($data);
        // }

        if ($request->doc_no) {

            $data['doc_no'] = $request->doc_no;
            $data['emission'] = $request->emission;
            $data['emission_for'] = $request->emission_for;
            $data['uf'] = $request->uf;

            $employee->document()->create($data);
        }

        return redirect()->route('employees.index')->with('message', 'Funcionário criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$employee = $this->employee->find($id)) {
            return redirect()->back();
        }

        $sectors = $this->sector->get();
        return view('admin.pages.employees.edit', [
            'employee' => $employee,
            'sectors' => $sectors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$employee = $this->employee->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();
        $employee->update($data);

        // Phone::find($data['user_id'])->update($data);
        // $employee->employee()->update($data);

        // if ($request->number) {
        //     $data['number'] = $request->number;
        //     $employee->phone()->update($data);
        // }

        // $employee->complement()->create($request->all());                        //  desta forma ok
        // $employee->phone()->create($request->all());                             //  desta forma ok
        // $user->vehicles()->create($request->only('type', 'plate', 'color'));     //  desta forma ok

        return redirect()->route('employees.index')->with('message', 'Funcionário editado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $id)
    {
        if (!$employee = $this->employee->find($id)) {
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

        $employee->points()->create($data);

        return redirect()->route('employees.index')->with('message', 'Ponto Registrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        if (!$employee = $this->employee->find($id)) {
            return redirect()->back();
        }

        $dados = $this->point
                    ->where('pointable_id', $id)
                    ->where('pointable_type', 'App\Models\User')
                    ->orderBy('date', 'desc')
                    ->get()
                    ->groupBy('date');
        // dd($dados);

        // return $dados;

        // $dados = $this->point
        //             ->select(   DB::raw('GROUP_CONCAT(register) as registro'),
        //                         DB::raw('GROUP_CONCAT(reason_status) as status'),
        //                         DB::raw('GROUP_CONCAT(reason) as motivo'),
        //                         DB::raw('DATE(register) as data_registro'))
        //             ->groupBy(DB::raw('data_registro'))
        //             ->orderBy('data_registro', 'desc')
        //             ->where('pointable_id', $id)
        //             ->get();

        // dd($dados);

        return view('admin.pages.employees.history', [
            'employee' => $employee,
            'dados' => $dados
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$employee = $this->employee->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.employees.show', [
            'employee' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$employee = $this->employee->find($id)) {
            return redirect()->back();
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('message', 'Funcionário deletado com sucesso');
    }

    /**
     * Generate PDF page
     */
    public function pdf($id)
    {
        if(!$employee = $this->employee->find($id))
            return redirect()->back();

        $dados = $this->point
            ->where('pointable_id', $id)
            ->where('pointable_type', 'App\Models\User')
            ->where('reason_status', 'N')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date');
        // $guests = Guest::all();

        return PDF::loadView('admin.pages.employees.pdf', compact('employee', 'dados'))
                    // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                    ->stream()/* download("relatorio_{{$guest->name}}.pdf") */;
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

        $employees = $this->employee
                            ->where ('role_id', 2)
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('email', $request->filter);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.pages.employees.index', [
            'employees' => $employees,
            'filters' => $filters
        ]);
    }
}
