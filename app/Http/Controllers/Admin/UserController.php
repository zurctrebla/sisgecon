<?php

namespace App\Http\Controllers\Admin;

use App\Events\EventRegisterEmployee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\{
    User,
    Role,
    Complement,
    Destiny,
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
        $users = $this->repository->with('sheets')->where('role_id', '<>', '2')->paginate();

        // dd($users);

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

        //$users = $this->repository/* ->with('sheets') *//* ->sheets() */->where('users.role_id', '2')->paginate();

        $users = $this->repository->latestSheet()->paginate();

        // $sheet = $user->sheets()->orderBy('id', 'DESC')->first();



        // dd($users);

        return view('admin.pages.users.employees', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmployee()
    {
        $destinies = Destiny::all();

        return view('admin.pages.users.createEmployee', compact('destinies'));
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

        // Listener
        // EventRegisterEmployee::dispatch($user);
        // registra o acesso do funcionário
        // $data = $request->all();
        // $data['in'] = $date;
        // $data['rest_out'] = $date;
        // $data['rest_in'] = $date;
        // $data['out'] = $date;
        // dd(in_array($user->sheets->last(), $data));
        // dd($user->sheets->last());
        // $status = $user->sheets->status;

        $date = date('Y-m-d H:i:s');
        $data['user_id'] = $id;

        // $sheets = $user->sheets->orderBy('id', 'DESC')->first();

        // $sheet = DB::table('sheets')->where('user_id', $id)->orderBy('id', 'DESC')->first();
        $sheet = $user->sheets()->orderBy('id', 'DESC')->first();

        // dd($sheet);


        if (!$sheet) {

            $data['in'] = $date;                // registra entrada do funcionário.
            $data['status'] = "1";
            $user->sheets()->create($data);

        } else {


            // $sheets = $user->sheets->last();

            // $sheets = $user->sheets()->orderBy('id', 'DESC')->first();

            /* foreach ($sheets as $sheet) { */

                if ($sheet->status == "1") {
                    // dd('1 if');
                    $data['rest_out'] = $date;
                    $data['status'] = "2";
                    $user->sheets()->update($data);

                } else if ($sheet->status == "2") {
                    // dd('2 if');
                    $data['rest_in'] = $date;
                    $data['status'] = "3";
                    $user->sheets()->update($data);

                } else if ($sheet->status== "3") {
                    // dd('3 if');
                    $data['out'] = $date;
                    $data['status'] = "4";
                    $user->sheets()->update($data);

                } else if ($sheet->status == "4") {
                    // dd('4 if');
                    $data['in'] = $date;                // registra entrada do funcionário.
                    $data['status'] = "1";
                    $user->sheets()->create($data);

                }

            /* } */

        }

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

        //$data = $request->only(['name', 'email', 'role_id']);

        $data = $request->all();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        // dd($data);
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
                            ->latest()/*
                            ->tenantUser() */
                            ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
