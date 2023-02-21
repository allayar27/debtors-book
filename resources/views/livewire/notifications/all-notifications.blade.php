<div class="bg-light p-4 rounded">
    <h4>Уведомления</h4>
      <section class="col-lg-9 Sortable ui-sortable">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
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
                    <div class="float-right">
                      @if($selectedRows)
                        <div class="btn-group ml-2">
                            <button type="button" class="btn btn-default">массовые действия</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">удалить выбранные</a>
                                <a wire:click.prevent="MarkAsReadSelectedRows()" class="dropdown-item" href="#">пометить как прочитанное</a>
                            </div>
                        </div>
                        <span class="ml-2" style="color: blue">выбрано: {{ count($selectedRows) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class=" fa fa-bell mr-1"></i>
                  Список Уведомлений
                </h3>

                {{-- <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    {{ $notifications->links() }}
                  </ul>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                  <!-- drag handle -->
                    <span>
                      <i class="bi bi-arrow-down-up ml-2"></i>
                    </span>
                  <div class="icheck-primary d-inline ml-2">
                        <input wire:model="selectPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                        <label for="todoCheck2"></label>
                  </div>
                  </li>
                  @foreach($notifications as $notification)
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                      <div class="icheck-primary d-inline ml-2">
                        <input wire:model="selectedRows" type="checkbox" value="{{ $notification->id }}" name="todo2" id="{{ $notification->id }}">
                        <label for="{{ $notification->id }}"></label>
                      </div>
                    <!-- todo text -->
                     @if($notification['type'] == 'App\Notifications\UserNotification')
                     @if($notification['read_at'] == null)
                        <span class="fas fa-users mr-2" style="color: green"></span><i> пользователь: <b>{{ $notification['data']['name'] }}</b> зарегистрирован</i>
                      @else
                        <span class="fas fa-users mr-2" style="color: green"></span><i style="text-decoration: line-through"> пользователь: <b>{{ $notification['data']['name'] }}</b> зарегистрирован</i>
                      @endif
                      <small class="badge badge-success"><i class="far fa-clock"></i>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</small>
                     @endif
                     @if($notification['type'] == 'App\Notifications\debtor\DebtorNotification')
                     @if($notification['read_at'] == null)
                        <span class="fas fa-user mr-2" style="color: green"></span><i> должник: <b>{{ $notification['data']['debtor_name'] }}</b> создано</i> 
                     @else
                        <span class="fas fa-user mr-2" style="color: green"></span><i style="text-decoration: line-through"> должник: <b>{{ $notification['data']['debtor_name'] }}</b> создано</i>
                     @endif
                        <small class="badge badge-primary"><i class="far fa-clock"></i>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</small>
                     @endif

                     @if($notification['type'] == 'App\Notifications\debtor\DeleteDebtorNotification')
                     @if($notification['read_at'] == null)
                        <span class="fas fa-user mr-2" style="color: red"></span>
                        <span>должник: <b>{{ $notification['data']['debtor_name'] }}</b> телефон: {{ $notification['data']['phone'] }} удалено</span>
                     @else
                        <span class="fas fa-user mr-2" style="color: red"></span>
                        <span style="text-decoration: line-through">должник: <b>{{ $notification['data']['debtor_name'] }}</b> телефон: {{ $notification['data']['phone'] }} удалено</span>
                     @endif
                     <small class="badge badge-danger"><i class="far fa-clock"></i>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</small>
                     @endif
                    <div class="tools">
                      <a href="" wire:click.prevent="markAsRead('{{ $notification['id'] }}')" class="btn btn-success btn-sm">
                          <i class="bi bi-check-all"></i>
                      </a>
                      <a href="" wire:click.prevent="delete('{{ $notification['id'] }}')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash">
                        </i>
                      </a>
                      {{-- <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i> --}}
                    </div>
                  </li>
                  @endforeach
                </ul>
                <div class="card-footer d-flex justify-content-end">
                <ul class="pagination pagination-sm">
                    {{ $notifications->links() }}
                  </ul>
                </div>
              </div>
            {{-- <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" width="1%">
                        <div class="icheck-primary d-inline ml-2">
                          <input wire:model="selectPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                          <label for="todoCheck2"></label>
                        </div>
                    </th>
                    <th scope="col" width="1%">№</th>
                    <th scope="col" width="10%">Уведомления</th>
                    <th scope="col" width="3%">Время</th>
                    <th scope="col" width="1%">Тип</th>
                    <th scope="col" width="1%" colspan="2">Действия</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                    <tr>
                        <th scope="row">
                            <div  class="icheck-primary d-inline ml-2">
                              <input wire:model="selectedRows" type="checkbox" value="{{ $notification->id }}" name="todo2" id="{{ $notification->id }}">
                              <label for="{{ $notification->id }}"></label>
                            </div>
                          </th>
                        <th scope="row">{{ $loop->iteration }}</th>
                        @if($notification['type'] == 'App\Notifications\UserNotification')
                        <td>
                            @if($notification['read_at'] == null)
                            <i class="fas fa-user mr-2" style="color: green"></i><i> пользователь: <b>{{ $notification['data']['name'] }}</b> зарегистрирован</i>
                            @else
                            <i class="fas fa-user mr-2" style="color: green"></i><i style="text-decoration: line-through"> пользователь: <b>{{ $notification['data']['name'] }}</b> зарегистрирован</i>
                            @endif
                        </td>
                        @endif
                        @if($notification['type'] == 'App\Notifications\debtor\DebtorNotification')
                        <td>
                            @if($notification['read_at'] == null)
                            <i class="fas fa-users mr-2" style="color: green"></i><i> должник: <b>{{ $notification['data']['debtor_name'] }}</b> создано</i> 
                            @else
                            <i class="fas fa-users mr-2" style="color: green"></i><i style="text-decoration: line-through"> должник: <b>{{ $notification['data']['debtor_name'] }}</b> создано</i>
                            @endif
                        </td>
                        @endif
                        @if($notification['type'] == 'App\Notifications\debtor\DeleteDebtorNotification')
                        <td>
                            @if($notification['read_at'] == null)
                            <i class="fas fa-users mr-2" style="color: red"></i>
                            <i>имя: <b>{{ $notification['data']['debtor_name'] }}</b> телефон: {{ $notification['data']['phone'] }}</i>
                            @else
                            <i class="fas fa-users mr-2" style="color: red"></i>
                            <i style="text-decoration: line-through">имя: <b>{{ $notification['data']['debtor_name'] }}</b> телефон: {{ $notification['data']['phone'] }}</i> 
                            @endif 
                        </td>
                        @endif
                        <td>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</td>
                        <td>
                            @if($notification['type'] == 'App\Notifications\debtor\DeleteDebtorNotification')
                            <span class="badge bg-danger">удалено</span>
                            @endif
                            @if($notification['type'] == 'App\Notifications\debtor\UpdateDebtorNotification')
                            <span class="badge bg-warning">обновлено</span>
                            @endif
                            @if($notification['type'] == 'App\Notifications\debtor\DebtorNotification')
                            <span class="badge bg-success">создано</span>
                            @endif
                        </td>
                        <td>
                            <a href="" wire:click.prevent="markAsRead('{{ $notification['id'] }}')" class="btn btn-success btn-sm">
                                <i class="bi bi-check-all"></i>
                            </a>
                        </td>
                        <td>
                            <a href="" wire:click.prevent="delete('{{ $notification['id'] }}')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash">
                                </i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>   --}}
            {{-- <div class="card-footer d-flex justify-content-end">
                {{ $notifications->links() }}
              </div>  --}}
        </div>
         
      </section>    
</div>

@push('scripts')
<script>
    window.addEventListener('deleted', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('MarkedAsRead', event => {
        toastr.info(event.detail.message, 'Marked as Read!');
    })
</script>
@endpush