<div>
    
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
            </div>
            
            <div class="row">
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                    <input type="text" wire:model="byDate" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    
                </div>
            </div>
        
        </div>   
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right">Создать</a>
            </ol>
          </div>
    </div>
    
    <div class="input-group rounded">
        <input type="search" class="form-control rounded" wire:model="searchTerm" placeholder="Поиск" aria-label="Search" aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
          <i class="fas fa-search"></i>
        </span>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="1%">№</th>
            <th scope="col" width="15%">Имя</th>
            <th scope="col" width="15%">Email</th>
            <th scope="col" width="10%">Дата создание</th>
            <th scope="col" width="1%" colspan="3">Действия</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    
                    <td>{{ $user->created_at }}</td>
                    <td><a href="" class="btn btn-warning btn-sm">
                        <i class="fas fa-eye"></i>
                    </a></td>
                    <td><a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash">
                                </i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links('livewire.pagination') }}
</div>

{{-- @push('scripts')
<script type="text/javascript">
     $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'ru'
                });
            });
</script>
@endpush --}}
