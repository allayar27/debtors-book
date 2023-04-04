<div class="bg-light p-4 rounded">
    <h4>Долги</h4>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-9">
              <div class="float-left">
                <select class="custom-select" wire:model="orderBy" style="width: auto;" data-sortOrder>
                  <option value="ASC">по возрастанию</option>
                  <option value="DESC">по убыванию</option>
                </select>
                <select class="custom-select" wire:model="perPage" style="width: auto;" data-sortOrder>
                    <option value="5">5</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                </select>
              </div>

              <div class="float-left ml-4">
                <form wire:submit.prevent="getBetweenTwoDate()">
                  <label for="">от</label>
                  <input type="date" wire:model="from">
                  <label for="">до</label>
                  <input type="date" wire:model="to">
                  <button class="btn btn-sm btn-primary" type="submit">поиск</button>
                </form>
              </div>
            </div>

            <div class="col-sm-3">
              <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-sm btn-primary"  wire:click.prevent="addNew"><i class="fa fa-plus-circle mr-1"></i>Добавить</button>
              </ol>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Таблица долгов</h3>

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
                        <th scope="col" width="13%">Дата</th>
                        <th scope="col" width="15%">Имя должника</th>
                        <th scope="col" width="15%">Заметка</th>
                        <th scope="col" width="10%">Сумма долга</th>
                        <th scope="col" width="1%" colspan="3">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->debtor->name }}</td>
                            <td>{{ $transaction->transaction_remark }}</td>
                            <td>{{ $transaction->pay_amount }} UZS</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"  wire:click="edit({{ $transaction->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="deleteConfirm({{ $transaction->id }})">
                                    <i class="fas fa-trash">
                                    </i>
                                </button>
                          </td>
                        </tr>
                        @empty
                            <tr>
                              <td colspan="6" style="text-align: center" class="px-6 py-4 whitespace-no-wrap text-sm leading">
                                {{ __('No debts not found') }}
                              </td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                   <div class="card-footer d-flex justify-content-end">
                    {{ $transactions->links() }}
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

    </div><!-- /.container-fluid -->

    <!-- Modal -->
      <div class="modal fade" id="createModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" wire:ignore.self>
        <div class="modal-dialog" role="document">
          <form wire:submit.prevent="create">
           <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  <span>Добавить нового долга</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div wire:ignore class="form-group">
                  <label>Имя должника</label><br>
                  <select  class="select2" wire:model.lazy="debtor_id" id="select2" name="debtor_id" style="width: 70%;" required>
                    <option value="" disabled>выберите должника...</option>
                  @foreach($debtors as $debtor)
                  <option value="{{ $debtor->id }}">{{ $debtor->name }}</option>
                  @endforeach
                  </select>
                  
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Сумма долга</label>
                    <input type="number" step=".01" wire:model.defer="pay_amount" name="pay_amount" class="form-control" id="exampleInputEmail1" placeholder="Введите сумму">
                    @error('pay_amount') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Заметка</label>
                    <input type="text" wire:model.defer="transaction_remark" name="transaction_remark" class="form-control" id="exampleInputEmail1" placeholder="комментарий..">
                    @error('transaction_remark') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                  <span>Сохранить</span>
                </button>
              </div>
           </div>
          </form>
        </div>
      </div>

      <!-- Modal Edit -->
      <div class="modal fade" id="editModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" wire:ignore.self>
      <div class="modal-dialog" role="document">
        <form  wire:submit.prevent="update">
         <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <span>Изменить долг</span>
              </h5>
              <button type="button"  class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div wire:ignore class="form-group">
                <label>Имя должника</label><br>
                <select  class="select2" wire:model.lazy="debtor_id" name="debtor_id" id="debtor_id" style="width: 70%;" >
                @foreach($debtors as $debtor)
                <option value="{{ $debtor->id }}">{{ $debtor->name }}</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Сумма долга</label>
                  <input type="number" step=".01" wire:model.defer="pay_amount" name="pay_amount" class="form-control" id="exampleInputEmail1" placeholder="Введите сумму">
                  @error('pay_amount') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Заметка</label>
                  <input type="text" wire:model.defer="transaction_remark" name="transaction_remark" class="form-control" id="exampleInputEmail1" placeholder="комментарий..">
                  @error('transaction_remark') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                <span>Изменить</span>
              </button>
            </div>
         </div>
        </form>
      </div>
      </div>

  </section>
</div>

@push('scripts')

<script>

  window.livewire.on('open-edit-modal', () => {
          $('#editModal').modal('show');

          $('#debtor_id').select2({
        theme: 'bootstrap4',
      });
      $('#debtor_id').on('change', function (e) {
          var data = $('#debtor_id').select2("val");
          @this.set('debtor_id', data);
      });
          
  })

  window.livewire.on('open-create-modal', () => {
          $('#createModal').modal('show');

          $('#select2').select2({
        theme: 'bootstrap4',
      });
      $('#select2').on('change', function (e) {
          var data = $('#select2').select2("val");
          @this.set('debtor_id', data);
      });
          
  })


  $(document).ready( function() {
    toastr.options = {
      "positionClass": "toast-top-right",
    }

    window.addEventListener('created', event => {
        $('#createModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('updated', event => {
        $('#editModal').modal('hide');
        toastr.info(event.detail.message, 'Info!');
    })

    window.addEventListener('error updating', event => {
        $('#editModal').modal('hide');
        toastr.error(event.detail.message, 'Error!');
    })

  });
</script>

<script>
  window.addEventListener('delete-confirm', event => {
    Swal.fire({
      title: 'Вы уверены?',
      text: "Вы не сможете вернуть это!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'отмена',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Да, удалить!'
    }).then((result) => {
    if (result.isConfirmed) {
      Livewire.emit('deleteConfirmed')
      }
    })
  })

  window.addEventListener('deleted', event => {
    Swal.fire(
      'Удалено!',
      event.detail.message,
      'success'
    )
  })
</script>
@endpush






