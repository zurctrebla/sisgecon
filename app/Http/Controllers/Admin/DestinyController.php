<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDestiny;
use App\Models\Destiny;
use Illuminate\Http\Request;

class DestinyController extends Controller
{
    protected $repository;

    public function __construct(Destiny $destiny)
    {
        $this->repository = $destiny;

        // $this->middleware(['can:destinies']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinies = $this->repository->paginate();

        return view('admin.pages.destinies.index', compact('destinies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.destinies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateDestiny  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDestiny $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('destinies.index')->with('message', 'Setor cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$destiny = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.destinies.show', compact('destiny'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$destiny = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.destinies.edit', compact('destiny'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateDestiny  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDestiny $request, $id)
    {
        if (!$destiny = $this->repository->find($id)) {
            return redirect()->back();
        }

        $destiny->update($request->all());

        return redirect()->route('destinies.index')->with('message', 'Setor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$destiny = $this->repository->find($id)) {
            return redirect()->back();
        }

        $destiny->delete();

        return redirect()->route('destinies.index')->with('message', 'Setor deletado com sucesso');
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

        $destinies = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('name', $request->filter);/*
                                    $query->orWhere('description', 'LIKE', "%{$request->filter}%"); */
                                }
                            })
                            ->paginate();

        return view('admin.pages.destinies.index', compact('destinies', 'filters'));
    }
}
