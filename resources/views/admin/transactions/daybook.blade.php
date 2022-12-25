@extends('layouts.app')

@section('title', 'transactions')
 
@section('content')

    <div class="bg-light p-4 rounded">
        <h4>Транзакций</h4>
    
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="float-left">
                        <select class="custom-select" style="width: auto;" data-sortOrder>
                          <option value="index"> Sort by Position </option>
                          <option value="sortData"> Sort by Custom Data </option>
                        </select>
                        <div class="btn-group">
                          <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                          <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                        </div>
                      </div>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('transaction.create') }}" class="btn btn-primary btn-sm float-right">Создать</a>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
        </section>


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">№</th>
                <th scope="col" width="10%">Дата</th>
                <th scope="col" width="15%">Имя</th>
                <th scope="col" width="15%">Примечание</th>
                <th scope="col" width="10%">Сумма долга</th>
                <th scope="col" width="10%">Сумма возврата</th>
                <th scope="col" width="1%" colspan="2">Действия</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($transactions as $transaction)
                  <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $transaction->created_at }}</td>
                      <td>{{ $transaction->debtor->name }}</td>
                      <td>{{ $transaction->transaction_remark }}</td>
                      <td>{{ $transaction->pay_amount }}</td>
                      <td>{{ $transaction->received_amount }}</td>
                      </td>
                        <td><a href="{{ route('debt.edit', $transaction->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>
                        <td>
                          <form action="{{ route('debt.delete', $transaction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                              <i class="fas fa-trash">
                              </i>
                            </button>
                          </form>
                      </td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr class="p-4">
                     <th></th> 
                     <th colspan="3">Total</th>
                     <th>32343</th>
                     <th>343</th>
                     <th class="text-danger">
                         1234124
                     </th>
                 </tr>
          </tfoot>
        </table>
        

</div>		
    
@endsection