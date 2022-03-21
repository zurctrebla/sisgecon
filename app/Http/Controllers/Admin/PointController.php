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

        if (auth()->user()->role->name == "Portaria") {       // Usuário comum

            $values = $this->repository
                                ->where('pointable_id', $point->pointable_id)
                                ->where('date', date('Y-m-d'))
                                ->orderBy('hour', 'asc')
                                ->get()
                                ->groupBy('date');

            unset($hours);

            $hours = [];

            foreach ($values as $value) {
                for ($i=0; $i < $value->count(); $i++) {
                    if (($request['hour'] < $value[$i]->hour) && ($request['id'] > $value[$i]->id) && (empty($hours))) {
                        array_push($hours, $value[$i]->hour);
                    }
                }
            }

    // dd(auth()->user()->role == "Admin");

            if (!empty($hours)) {
                return redirect()->back()->with('error', 'Hora do registro anterior menor que a hora atual!');
            }

            if ($point->date < date('Y-m-d')) {
                return redirect()->back()->with('error', 'Data ultrapassada!');
            }

            if ($request['hour'] > date('H:i:s')) {
                return redirect()->back()->with('error', 'Hora do registro maior que a hora atual!');
            }

            $point->update($request->only('hour'));
            return redirect()->back()->with('message', 'Hora atualizada com Sucesso!');

        }elseif(auth()->user()->role->name == "Admin"){  // Super Usuário
            $point->update($request->only('hour'));
            return redirect()->back()->with('message', 'Hora atualizada com Sucesso!');
        }

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
