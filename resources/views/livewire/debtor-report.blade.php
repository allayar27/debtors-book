<div>
    <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" wire:model="search" name="table_search" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="1%">№</th>
            <th scope="col" width="10%">Дата</th>
            <th scope="col" width="10%">Имя</th>
            <th scope="col" width="10%">Заметка</th>
            <th scope="col" width="10%">Долг</th>
            <th scope="col" width="10%">Оплачено</th>
            <th scope="col" width="10%">Баланс</th>
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
                    <td>{{ $transaction->debtor->balance }}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    {{ $transactions->links('livewire.pagination') }}
</div>

