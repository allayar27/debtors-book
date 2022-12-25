<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceivedRequest;
use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReceivedController extends Controller
{
    
    public function index()
    {
        return view('admin.received.index');
    }

    
    public function create()
    {
        //
    }

    
    public function store(ReceivedRequest $request)
    {
        $validate = $request->validated();
        $Transaction = Transaction::create($validate);
        $Transaction->debtor()->increment('balance', $validate['received_amount']);
        return back()->with('success', 'Возврат долга создан успешно.');
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $received = Transaction::findOrFail($id);
        $debtors = Debtor::orderBy('id', 'DESC')->get();
        return view('admin.received.edit',[
            'received' => $received,
            'debtors' => $debtors
        ]);
    }

   
    public function update(ReceivedRequest $request, $id)
    {
        $validate = $request->validated();
        $update = Transaction::where('id', $id)->update($validate);

        if($update){
            return redirect(route('payment.index'))->with('success', 'Возврат долга обновлено успешно.');
        }
    }

    
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return back()->with('success', 'Возврат долга удалено успешно.');
    }
}
