<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGuest;
use App\Models\Destiny;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    protected $repository;
    protected $user;

    public function __construct(Guest $guest, User $user)
    {
        $this->repository = $guest;
        $this->user = $user;

        // $this->middleware(['can:guests']);

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
        $guests = $this->repository->paginate();

        return view('admin.pages.guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinies = Destiny::all();

        return view('admin.pages.guests.create', compact('destinies'));
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

        //sdd($data);

        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $data['photo'] = $request->photo->store('guests/photos');
        }

        // dd($data);

        $this->repository->create($data);

        return redirect()->route('guests.index')->with('message', 'Visitante cadastrado com sucesso');

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

        $destinies = Destiny::all();

        return view('admin.pages.guests.edit', compact('guest', 'destinies'));
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
                                    $query->orWhere('document1', $request->filter);
                                    $query->orWhere('document2', $request->filter);
                                    $query->orWhere('authorization', $request->filter);
                                }
                            })
                            ->latest()/*
                            ->tenantUser() */
                            ->paginate();

        return view('admin.pages.guests.index', compact('guests', 'filters'));
    }
}
