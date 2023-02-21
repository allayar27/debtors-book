<div class="bg-light p-4 rounded">
    <h4>Список пользователей</h4>

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
        <table class="table table-hover">
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
              <th scope="col" width="10%">Email</th>
              <th scope="col" width="10%">Дата регистраций</th>
              <th scope="col" width="1%" colspan="3">Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                      <th scope="row">
                        <div  class="icheck-primary d-inline ml-2">
                          <input wire:model="selectedRows" type="checkbox" value="{{ $user->id }}" name="todo2" id="{{ $user->id }}">
                          <label for="{{ $user->id }}"></label>
                        </div>
                      </th>
                        <th scope="row">{{ $users->firstItem() + $index }}</th>
                        <td>
                          <img src="{{ $user->avatar_url }}" id="profileImage" style="width: 50px;" class="img img-circle mr-1" alt="">
                          {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                          <button type="button"  class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showInfoModal" wire:click.prevent="showUserInfo({{ $user->id }})">
                          <i class="fas fa-eye"></i>
                          </button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" wire:click.prevent="edit({{ $user->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger"  wire:click.prevent="deleteConfirm({{ $user->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
          <div class="card-footer d-flex justify-content-end">
            {{ $users->links() }}
          </div>
        </div><!-- /.container-fluid -->

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
          <div class="modal-dialog" role="document">
            <form  wire:submit.prevent="create">
             <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    <span>Добавить нового пользователя</span>
                  </h5>
                  <button type="button" wire:click.prevent="closeModal" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                      <label for="phone">Email</label>
                      <input type="mail" name="email" wire:model.defer="email" class="form-control" id="email" placeholder="Enter email">
                      @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Пароль</label>
                      <input type="password" name="password" wire:model.defer="password" class="form-control" id="password" placeholder="пароль">
                      @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Подтвердите пароль</label>
                      <input type="password" name="password_confirmation" wire:model.defer="password_confirmation" class="form-control" id="password-confirmation" placeholder="подтвержения паролья">
                      @error('password_confirmaiton') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-group">
                    <label for="customFile">Фото профиля</label>
                    
                    <div class="custom-file">
                      <div x-data ="{ isUploading: false, progress: 5 }"
                           x-on:livewire-upload-start="isUploading = true" 
                           x-on:livewire-upload-finish="isUploading = false; progress = 5" 
                           x-on:livewire-upload-error="isUploading = false" 
                           x-on:livewire-upload-progress="$event.detail.progress" 
                      >
                        <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                          <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width:${progress}%`">
                            <span class="sr-only">40% Complete (success)</span>
                          </div>
                        </div>
                      </div>
                      <label class="custom-file-label" for="customFile">
                        @if($photo)
                          {{ $photo->getClientOriginalName() }}
                        @else
                          Выберите файл
                        @endif
                      </label>
                    </div>
                      @if($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="img img-circle d-block mt-2 w-50">
                      @endif
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" wire:click.prevent="closeModal" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
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
          <form  wire:submit.prevent="update">
           <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  <span>Изменить пользователя</span>
                </h5>
                <button type="button" wire:click.prevent="closeModal" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                    <label for="phone">Email</label>
                    <input type="mail" name="email" wire:model.defer="email" class="form-control" id="email" placeholder="Enter email">
                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                  <label for="customFile">Фото профиля</label>
                  <div class="custom-file">
                    <div x-data ="{ isUploading:false, progress: 5 }"
                           x-on:livewire-upload-start="isUploading = true" 
                           x-on:livewire-upload-finish="isUploading = false; progress = 5" 
                           x-on:livewire-upload-error="isUploading = false" 
                           x-on:livewire-upload-progress="$event.detail.progress" 
                    >
                        <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                          <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width:${progress}%`">
                            <span class="sr-only">40% Complete (success)</span>
                          </div>
                        </div>
                      </div>
                    <label class="custom-file-label" for="customFile">
                      @if($photo)
                          {{ $photo->getClientOriginalName() }}
                        @else
                          Выберите файл
                        @endif
                    </label>
                  </div>
                    @if($photo)
                      <img src="{{ $photo->temporaryUrl() }}" class="img img-circle d-block mt-2 w-50">
                    @else
                      <img src="{{ $db_photo ?? '' }}" class="img img-circle d-block mt-2 w-50">
                    @endif
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" wire:click.prevent="closeModal" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i>Отмена</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                  <span>Изменить</span>
                </button>
              </div>
           </div>
          </form>
        </div>
      </div>


      <!--Show Info Modal -->
      <div class="modal fade" id="showInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  <span>Данные пользователя</span>
                </h5>
                <button type="button" wire:click.prevent="closeModal" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="name">ID</label>
                    <p>{{ $this->user_id }}</p>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <p>{{ $this->name }}</p>
                </div>
                <div class="form-group">
                    <label for="phone">Email</label>
                    <p>{{ $this->email }}</p>
                </div>
                <div class="form-group">
                  <label for="customFile">Фото профиля</label>
                    <img src="{{ $this->db_photo ?? '' }}" class="img img-circle d-block mt-2 w-50">
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

    window.addEventListener('close-modal', event => {
        $('#createModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('hide-edit-modal', event => {
        $('#editModal').modal('hide');
        toastr.info(event.detail.message, 'Info!');
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
