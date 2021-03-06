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

class EmployeeController extends Controller
{
    protected $repository;

    public function __construct(User $employee)
    {
        $this->repository = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = date('Y-m-d');

        $employees = $this->repository
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('register', 'LIKE', "{$filter}%");    /* filtra points */
                        $query->where('reason_status','N');                 /* filtra points sem motivos*/

                    }])->where('role_id', '2')                              /* filtra os usuários com função funcionário */
                    ->paginate();

        return view('admin.pages.employees.index', compact('employees'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::all();

        return view('admin.pages.employees.create', compact('sectors'));
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
        $employee = $this->repository->create($data);

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
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        $sectors = Sector::all();
        return view('admin.pages.employees.edit', compact('employee', 'sectors'));
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
        if (!$employee = $this->repository->find($id)) {
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
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->reason) {
            $data['reason'] = $request->reason;
            $data['reason_status'] = 'Y';
        }

        $data['register'] = date('Y-m-d H:i:s');

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
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        $filter = date('');

        $employee = $this->repository
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('register', 'LIKE', "{$filter}%")->orderBy('register', 'DESC');
                        $query->where('reason_status','N');

                    }])->find($id);

        $value = [];

        // foreach ($employee->points ?? '' as $key => $point) {

        //     array_push($value, $point->register);

        // }

        foreach ($employee->points->chunk(4) as $chunk) {

            foreach ($chunk as $key => $point) {

                array_push($value, $point->register);

            }
        }

        dd($value);

        return view('admin.pages.employees.historySheet', compact('employee', 'value'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.employees.show', compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('message', 'Funcionário deletado com sucesso');
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

        $employees = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('email', $request->filter);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.pages.employees.index', compact('employees', 'filters'));
    }
}
