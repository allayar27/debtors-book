
<div>
    @include('livewire.payments.payment_create')

    <div class="row mb-2">
        <div class="col-sm-6">
            
            <form wire:submit.prevent="sort">
                <label for="">from</label><input type="date">
                <label for="">to</label><input type="date">
            <button class="btn btn-primary" type="submit">search</button>
            </form>
        </div>   
    
    </div>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col" width="1%">№</th>
        <th scope="col" width="10%">Дата</th>
        <th scope="col" width="15%">Имя</th>
        <th scope="col" width="15%">Примечание</th>
        <th scope="col" width="10%">Сумма долга</th>
        <th scope="col" width="1%" colspan="2">Действия</th>
    </tr>
    </thead>
    <tbody>
        @if(count($transactions) > 0)
      @foreach ($transactions as $transaction)
          <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $transaction->created_at }}</td>
              <td>{{ $transaction->debtor->name }}</td>
              <td>{{ $transaction->transaction_remark }}</td>
              <td>{{ $transaction->pay_amount }}</td>
              </td>
                <td><a href="{{ route('payment.edit', $transaction->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>
                <td>
                    <form action="{{ route('payment.destroy', $transaction->id) }}" method="POST">
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
      @else
      <tr>
        <td>not found</td>
      </tr>
      @endif
      
    </tbody>  
</table>
{{-- {{ $transactions->links('livewire.payments.paginate') }} --}}
</div>

