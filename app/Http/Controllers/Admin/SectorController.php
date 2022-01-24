<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSector;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    protected $repository;

    public function __construct(Sector $sector)
    {
        $this->repository = $sector;

        // $this->middleware(['can:sectors']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = $this->repository->paginate();

        return view('admin.pages.sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateSector  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSector $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('sectors.index')->with('message', 'Setor cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$sector = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.sectors.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$sector = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateDestiny  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSector $request, $id)
    {
        if (!$sector = $this->repository->find($id)) {
            return redirect()->back();
        }

        $sector->update($request->all());

        return redirect()->route('sectors.index')->with('message', 'Setor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$sector = $this->repository->find($id)) {
            return redirect()->back();
        }

        $sector->delete();

        return redirect()->route('sectors.index')->with('message', 'Setor deletado com sucesso');
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

        $sectors = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('name', $request->filter);/*
                                    $query->orWhere('description', 'LIKE', "%{$request->filter}%"); */
                                }
                            })
                            ->paginate();

        return view('admin.pages.sectors.index', compact('sectors', 'filters'));
    }
}
