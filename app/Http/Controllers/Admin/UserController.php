<?php

namespace App\Http\Controllers\Admin;

use App\Events\EventRegisterEmployee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\{
    User,
    Role,
    Complement,
    Sector,
    Phone,
    Relative,
    Vehicle
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        // $this->middleware(['can:users', 'can:users-edit', 'can:users-employee', 'can:users-profile']);
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository/* ->with('sheets') */->where('role_id', '<>', '2')->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee()
    {
        // $this->middleware(['can:users-employee']);

        $filter = date('Y-m-d');

        $users = $this->repository
                    ->with(['points' => function ($query) use ($filter) {

                        $query->where('register', 'LIKE', "{$filter}%");    /* filtra points */
                        $query->where('reason_status','N');                 /* filtra points sem motivos*/

                    }])->where('role_id', '2')                              /* filtra os usuários com função funcionário */
                    ->paginate();

        return view('admin.pages.users.employees', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmployee()
    {
        $sectors = Sector::all();
        return view('admin.pages.users.createEmployee', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        // $this->repository->create($request->all());

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index')->with('message', 'Usuário criado com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployee(Request $request)
    {
        // $this->repository->create($request->all());

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 2;
        $user = $this->repository->create($data);

        $user->employee()->create($data);

        if ($request->number) {

            $data['number'] = $request->number;

            $user->phones()->create($data);
        }

        if ($request->model && $request->plate) {

            $data['model'] = $request->model;
            $data['plate'] = $request->plate;

            $user->vehicles()->create($data);
        }

        if ($request->doc_no) {

            $data['doc_no'] = $request->doc_no;
            $data['emission'] = $request->emission;
            $data['emission_for'] = $request->emission_for;
            $data['uf'] = $request->uf;

            $user->documents()->create($data);
        }

        // $user->docs()->create($data);

        return redirect()->route('users.employee')->with('message', 'Funcionário criado com sucesso');
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
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->reason) {
            $data['reason'] = $request->reason;
            $data['reason_status'] = 'Y';
        }

        $data['register'] = date('Y-m-d H:i:s');

        $user->points()->create($data);

        return redirect()->route('users.employee')->with('message', 'Ponto Registrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        /* aqui possivelmente seja implementado uma função para agrupar os registros, dividindo-os em dia, mes e ano */

        return view('admin.pages.users.historySheet', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $roles = Role::all();
        $userRole = $user->role->name;
        return view('admin.pages.users.edit', compact('user', 'roles' , 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email', 'role_id']);

        if ($request->password) {

            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        // $user->phones()->create($request->all());                            //  desta forma ok
        // $user->vehicles()->create($request->only('type', 'plate', 'color')); //  desta forma ok
        // $user->complement()->create($request->all());                        //  desta forma ok

        return redirect()->route('users.index')->with('message', 'Usuário editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', 'Usuário deletado com sucesso');
    }

    /**
     *
     *
     */
    public function profile()
    {
        // $this->middleware(['can:users-profile']);

        $id = auth()->user()->id;

        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.profile', compact('user'));
    }

    /**
     *
     *
     */
    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;

        // $this->middleware(['can:users-profile']);   //  update-profile

        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.index')->with('message', 'Perfil editado com sucesso');
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

        $users = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('email', $request->filter);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
