<div class="bg-light p-4 rounded">
    <h4>История Транзакций</h4>

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-5">
                <div class="float-left">
                  <div class="btn-group ml-2">
                    <button type="button" class="btn btn-primary"><i class="fas fa-filter"></i> фильтр</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a wire:click.prevent="getpaidDebts()" class="dropdown-item" href="#">оплаченные долги</a>
                      <a wire:click.prevent="getUnpaidDebts()" class="dropdown-item" href="#">неоплаченные доги</a>
                    </div>
                  </div>
                    <div class="btn-group ml-2">
                      
                      <button type="button" class="btn btn-success"><i class="far fa-calendar-alt"></i> диапазон дат</button>
                      <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu" style="">
                        <a wire:click.prevent="getTodayTransactions()" class="dropdown-item" href="#">Сегодня</a>
                        <a wire:click.prevent="getYesterdayTransactions()" class="dropdown-item" href="#">Вчера</a>
                        <a wire:click.prevent="getLastSevenDaysTransactions()" class="dropdown-item" href="#">Последние 7 дней</a>
                        <a wire:click.prevent="getCurrentMonthTransactions()" class="dropdown-item" href="#">Этот месяц</a>
                        <a wire:click.prevent="getPreviousMonthTransactions()" class="dropdown-item" href="#">Прошлый месяц</a>
                      </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-6">
              <div class="float-left">
                <form wire:submit.prevent="getBetweenTwoDate">
                  <label for="">от</label>
                  <input type="date" wire:model="from">
                  <label for="">до</label>
                  <input type="date" wire:model="to">
                  <button class="btn btn-sm btn-primary" type="submit">поиск</button>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Таблица транзакций</h3>
                  
                  <div class="card-tools">
                    <form wire:submit.prevent="search">
                    <div class="input-group input-group-sm" style="width: 250px;">
                      <input type="text" wire:model="search" name="table_search" class="form-control float-right" placeholder="Search">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="1%">№</th>
                        <th scope="col" width="10%">Дата</th>
                        <th scope="col" width="15%">Имя</th>
                        <th scope="col" width="15%">Заметка</th>
                        <th scope="col" width="10%">Долг</th>
                        <th scope="col" width="10%">Оплаченный долг</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->debtor->name }}</td>
                            <td>{{ $transaction->transaction_remark }}</td>
                            @if($transaction->pay_amount > 0)
                                <td>{{ $transaction->pay_amount }}</td>
                            @else
                                <td> -- </td>
                            @endif
                            @if($transaction->received_amount > 0)
                                <td>{{ $transaction->received_amount }}</td>
                            @else
                                <td> -- </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
            
                </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          
        </div><!-- /.container-fluid -->
    </section>
</div>
    

