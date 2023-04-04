
<div class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Админ Панель</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

  <!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $transaction->count() }}</h4>
              <p>Все транзакции</p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
            <a href="{{ route('transaction-history') }}" class="small-box-footer">подробно <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h4>{{ $transaction->totalDebts() }} UZS</h4>

              <p>Все долги</p>
            </div>
            <div class="icon">
              <i class="ion bi-cart-dash"></i>
            </div>
            <a href="{{ route('debts') }}" class="small-box-footer">подробно <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h4>{{ $transaction->totalDebtsPaid() }} UZS</h4>
              <p>Все оплаченные долги</p>
            </div>
            <div class="icon">
              <i class="ion bi-cart-plus"></i>
            </div>
            <a href="{{ route('paid-debts') }}" class="small-box-footer">подробно <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h4>{{ $debtor->showDebtorsPercentWhereHasDebts() }}%</h4>
              <p>Имееть долги</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('debtor-report') }}" class="small-box-footer">подробно <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Пользователи</span>
              <span class="info-box-number">{{ $user }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-address-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Должники</span>
              <span class="info-box-number">{{ $debtor->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- ./col -->
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-danger"><i class="fas fa-{{ $transaction->showDebtsPercent() >= 0 ? 'caret-up' : 'caret-down'}}"></i> {{ $transaction->showDebtsPercent() }}%</span>
              <h5 class="description-header">{{ $transaction->totalDebts() }} UZS</h5>
              <span class="description-text">Общая сумма долгов</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-6 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-success"><i class="fas fa-{{ $transaction->showPaidDebtsPercent() >= 50 ? 'caret-up' : 'caret-down' }}"></i> {{ $transaction->showPaidDebtsPercent() }}%</span>
              <h5 class="description-header">{{ $transaction->totalDebtsPaid() }} UZS</h5>
              <span class="description-text">Общая сумма оплаченных долгов</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>

@push('scripts')
<script>
  $(document).ready(function() {
    toastr.options = {
      "positionClass": "toast-bottom-right",
    }

    @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @endif
  });
</script>
@endpush
