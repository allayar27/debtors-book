<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DebtorRequest;
use App\Http\Requests\DebtorUpdate;
use App\Models\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    
    public function index()
    {
        return view('admin.debtors.index');
    }

    
    public function create()
    {
        return view('admin.debtors.create');
    }

    

    public function store(DebtorRequest $request)
    {
        $valid = $request->validated();
        $create = Debtor::create($valid);
        if($create){
            return redirect(route('debtor.index'));
        }
    }

    
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
        $debtor = Debtor::findOrFail($id);
        return view('admin.debtors.edit', compact('debtor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DebtorUpdate $request, $id)
    {
        $params = $request->validated();
        $update = Debtor::where('id', $id)->update($params);
        if($update){
            return redirect(route('debtor.index'));
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
