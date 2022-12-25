@extends('layouts.app')

@section('title', 'update debts')

@section('content')

<div class="bg-light p-4 rounded">
    <h4>Изменить</h4>
   
    <form action="{{ route('payment.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Имя должника</label><br>
                    <select  class="form-control"  name="debtor_id" style="width: 70%;"  id="select2">
                        @foreach($debtors as $debtor)
                        @if($debtor->id == $payment->debtor_id)
                        <option selected value="{{ $debtor->id }}">
                            {{ $debtor->name }}
                        </option>
                        @else{
                        <option  value="{{ $debtor->id }}">{{ $debtor->name }}</option>
                        }
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Сумма долга</label>
                    <input type="number" step=".01" name="pay_amount" value="{{ $payment->pay_amount }}" class="form-control" id="exampleInputEmail1" placeholder="Введите сумму">
                    @error('pay_amount') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Замечание</label>
                    <input type="text"  name="transaction_remark" value="{{ $payment->transaction_remark }}" class="form-control" id="exampleInputEmail1" placeholder="комментарий..">
                    @error('transaction_remark') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('payment.index') }}" class="btn btn-danger">Отмена</a>
            </div>
        </div>
    </form>
    
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            let elementName = $(this).attr('id');
            var data = $(this).select2("val");
           
        });
    });
</script>
@endpush
