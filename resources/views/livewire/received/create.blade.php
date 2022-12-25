<form action="{{ route('received.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div wire:ignore class="form-group">
                <label>Имя должника</label><br>
                <select  class="form-control"  name="debtor_id" style="width: 70%;"  id="select2">
                <option disabled >Поиск..</option>
                @foreach($debtors as $debtor)
                <option  value="{{ $debtor->id }}">{{ $debtor->name }}</option>
                @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Сумма возврата</label>
                <input type="number" step=".01" name="received_amount" class="form-control" id="exampleInputEmail1" placeholder="Введите сумму">
                @error('received_amount') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Замечание</label>
                <input type="text"  name="transaction_remark" class="form-control" id="exampleInputEmail1" placeholder="комментарий..">
                @error('transaction_remark') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>
</form>
<br>


@push('scripts')

    <script>
        $(document).ready(function() {
            $('#select2').select2();
            $('#select2').on('change', function (e) {
                let elementName = $(this).attr('id');
                var data = $(this).select2("val");
                @this.set('select', data);
            });
        });
    </script>

@endpush


