<div class="bg-light p-4 rounded">
      <h4>Список должников</h4>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
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
                    @if($selectedRows)
                    <div class="btn-group ml-2">
                      <button type="button" class="btn btn-default">массовые действия</button>
                      <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu" style="">
                        <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">удалить выбранные</a>

                      </div>
                    </div>
                    <span class="ml-2" style="color: blue">выбрано: {{ count($selectedRows) }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
              <div class="float-left">
                <div class="input-group input-group-sm ml-5" style="width: 250px;">
                    <input type="text" wire:model="search" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <i class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </i>
                    </div>
                </div>
              </div>
              <ol class="breadcrumb float-sm-right">
                <button wire:click.prevent="addNew()" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle mr-1"></i>Добавить</button>
              </ol>
            </div>

        </div>

              <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col" width="1%">
                      <div class="icheck-primary d-inline ml-2">
                        <input wire:model="selectPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                        <label for="todoCheck2"></label>
                      </div>
                    </th>
                    <th scope="col" width="1%">№</th>
                    <th scope="col" width="10%">Имя</th>
                    <th scope="col" width="10%">Телефон</th>
                    <th scope="col" width="10%">Баланс</th>
                    <th scope="col" width="10%">Дата создание</th>
                    <th scope="col" width="1%" colspan="3">Действия</th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($debtors as $index => $debtor)
                          <tr>
                            <th scope="row">
                              <div  class="icheck-primary d-inline ml-2">
                                <input wire:model="selectedRows" type="checkbox" value="{{ $debtor->id }}" name="todo2" id="{{ $debtor->id }}">
                                <label for="{{ $debtor->id }}"></label>
                              </div>
                            </th>
                              <th scope="row">{{ $debtors->firstItem() + $index }}</th>
                              <td>{{ $debtor->name }}</td>
                              <td>{{ $debtor->phone }}</td>
                              <td>{{ $debtor->balance }} UZS</td>
                              <td>{{ $debtor->created_at }}</td>
                              <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#showInfoModal" class="btn btn-info btn-sm" wire:click="showDebtorInfo({{ $debtor->id }})" >
                                <i class="fas fa-eye"></i>
                                </button>
                            </td>
                              <td>
                                  <button type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-primary" wire:click="edit({{ $debtor->id }})">
                                      <i class="fas fa-edit"></i>
                                  </button>
                              </td>
                              <td>
                                  <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal" wire:click="deleteConfirm({{ $debtor->id }})">
                                      <i class="fas fa-trash">
                                      </i>
                                  </button>
                              </td>
                          </tr>
                      @empty
                        <tr>
                            <td colspan="7" style="text-align: center" class="px-6 py-4 whitespace-no-wrap text-sm leading">
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

          <!-- Create Modal -->
          <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
              <div class="modal-dialog" role="document">
                <form autocomplete="off" wire:submit.prevent="create">
                 <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <span>Добавить нового должника</span>
                      </h5>
                      <button type="button" wire:click.prevent="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Имя</label>
                          <input type="text" name="name" wire:model.defer="name" class="form-control" id="name" placeholder="Enter name">
                          @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                          <label for="phone">Телефон номер</label>
                          <input type="number" name="phone" wire:model.defer="phone" class="form-control" id="phone" placeholder="Enter phone number">
                          @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Запасной номер</label>
                          <input type="number" name="reserve_phone" wire:model.defer="reserve_phone" class="form-control" id="reserve_phone" placeholder="необязательное поле">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" wire:click.prevent="close" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Сохранить</span>
                      </button>
                    </div>
                 </div>
                </form>
              </div>
          </div>

          <!--Edit Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                  <form autocomplete="off" wire:submit.prevent="update">
                   <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          <span>Изменить должника</span>
                        </h5>
                        <button type="button" wire:click.prevent="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" wire:model="name" class="form-control" id="name" placeholder="Enter name">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон номер</label>
                            <input type="number" name="phone" wire:model="phone" class="form-control" id="phone" placeholder="Enter phone number">
                            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Запасной номер</label>
                            <input type="number" name="reserve_phone" wire:model="reserve_phone" class="form-control" id="reserve_phone" placeholder="необязательное поле">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" wire:click.prevent="close" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                          <span>Изменить</span>
                        </button>
                      </div>
                   </div>
                  </form>
                </div>
          </div>


          <!--Show Info Modal-->
          <div class="modal fade" id="showInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          <span>Данные должника</span>
                        </h5>
                        <button type="button" wire:click.prevent="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="name">ID</label>
                          <p>{{ $this->debtor_id }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <p>{{ $this->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <p>{{ $this->phone }}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Запасной номер</label>
                            @if($this->reserve_phone == null)
                            <p>не имееться</p>
                            @else
                            <p>{{ $this->reserve_phone }}</p>
                            @endif
                        </div>
                      </div>
                   </div>
                </div>
          </div>
      </section>
</div>
 
@push('scripts')
<script>
  $(document).ready(function() {
    toastr.options = {
      "positionClass": "toast-top-right",
    }

    window.addEventListener('close-create-modal', event => {
        $('#createModal').modal('hide');
        toastr.success(event.detail.message, 'Created!');
    })

    window.addEventListener('hide-edit-modal', event => {
        $('#editModal').modal('hide');
        toastr.info(event.detail.message, 'Updated!');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.message, 'Deleted!');
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



