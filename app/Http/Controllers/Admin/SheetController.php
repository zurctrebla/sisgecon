<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SheetController extends Controller
{
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

        $date = date('d-m-Y H:m:s');

        //dd($date);

        $user->update($data);


        $user->sheets()->create($request->all());                                       //  desta forma ok



        //$user->vehicles()->create($request->only('type', 'plate', 'color'));                     //  desta forma ok
        $user->complement()->create($request->all());         //  desta forma ok

        return redirect()->route('users.index')->with('message', 'Usuário editado com sucesso');
    }
}
