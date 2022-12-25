
<div>
    @include('livewire.received.create')
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col" width="1%">№</th>
        <th scope="col" width="10%">Дата</th>
        <th scope="col" width="15%">Имя</th>
        <th scope="col" width="15%">Замечание</th>
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
              <td>{{ $transaction->received_amount }}</td>
              </td>
                <td><a href="{{ route('received.edit', $transaction->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>
                <td>
                    <form action="{{ route('received.destroy', $transaction->id) }}" method="POST">
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
</table>
{{ $transactions->links('livewire.pagination') }}
</div>


