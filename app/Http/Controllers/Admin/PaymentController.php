<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Debtor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    

    public function index()
    {
        return view('admin.payment.index');
    }

    
    public function create()
    {
        
    }

    
    public function store(PaymentRequest $request)
    {
        $validate = $request->validated();
        $Transaction = Transaction::create($validate);
        $Transaction->debtor()->decrement('balance', $validate['pay_amount']);

        if($Transaction){
        return back()->with('success', 'Долг создан успешно.');
        }
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $payment = Transaction::findOrFail($id);
        $debtors = Debtor::orderBy('id', 'DESC')->get();
        return view('admin.payment.edit',[
            'payment' => $payment,
            'debtors' => $debtors
        ]);

    }

    
    public function update(PaymentRequest $request, $id)
    {
        $validate = $request->validated();
        $update = Transaction::where('id', $id)->update($validate);

        if($update){
            session()->flash('message', 'Долг успешно обновлено.');
            return redirect(route('payment.index'));
        }
    }

   
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        session()->flash('message', 'Долг успешно удалено.');
        return back();
    }
}
