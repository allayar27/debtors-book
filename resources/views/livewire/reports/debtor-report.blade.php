<div class="bg-light p-4 rounded">
    <h4>Отчет должника</h4>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="float-left">
                    <form wire:submit.prevent="search" class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" wire:model="search" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
                    
                  
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" width="1%">№</th>
                    <th scope="col" width="10%">Имя</th>
                    <th scope="col" width="10%">Сумма долгов</th>
                    <th scope="col" width="10%">Сумма оплаченных</th>
                    <th scope="col" width="10%">Текущий баланс</th>
                    <th scope="col" width="10%">Действия</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($debtors as $debtor)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $debtor->name }}</td>
                            <td>{{ $debtor->transactions->sum('pay_amount') }} UZS</td>
                            <td>{{ $debtor->transactions->sum('received_amount') }} UZS</td>
                            <td>{{ $debtor->balance }} UZS</td>
                            <td>
                                <a href="{{ route('debtor-history', $debtor->id) }}" class="btn btn-primary btn-sm">
                                подробнo
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center" class="px-6 py-4 whitespace-no-wrap text-sm leading">
                                {{ __('No data not found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="card-footer d-flex justify-content-end">
                {{ $debtors->links() }}
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>	
    
   
    





