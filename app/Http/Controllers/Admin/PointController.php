<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;

class PointController extends Controller
{
    protected $repository;

    public function __construct(Point $point)
    {
        $this->repository = $point;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$point = $this->repository->find($id)) {
            return redirect()->back();
        }

        $points = $this->repository
                            ->where('pointable_id', $point->pointable_id)
                            ->where('date', date('Y-m-d'))
                            ->orderBy('id', 'desc')/*
                            ->take(2) */
                            ->get()
                            ->groupBy('date');

        /* $points = $this->repository
                            ->where()
                            ->orderBy()
                            ->get(); */

        dd($points);

        $value = date_diff(date_create(date('h:i:s')), date_create($point->hour))->format("%H") ;

        if (($point->date >= date('Y-m-d') && ( ($value) <= 16 ) )) {                        //verifica se o dia de hj é o mesmo do registro e atualiza.

            $point->update($request->only('hour'));

            return redirect()->back()->with('message', 'Hora atualizada com Sucesso!');

        }else{

            return redirect()->back()->with('error', 'Hora não foi atualizada!');
        }

        // $point->update($request->only('hour'));
        // return redirect()->back()->with('message', 'Hora atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
