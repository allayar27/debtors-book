<div>
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
            <th scope="col" width="10%">Имя</th>
            <th scope="col" width="10%">Телефон</th>
            <th scope="col" width="10%">Баланс</th>
            <th scope="col" width="10%">Дата создание</th>
            <th scope="col" width="1%" colspan="3">Действия</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($debtors as $debtor)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $debtor->name }}</td>
                    <td>{{ $debtor->phone }}</td>
                    <td>{{ $debtor->balance }}</td>
                    <td>{{ $debtor->created_at }}</td>
                    <td>
                      <a href="" class="btn btn-info btn-sm">
                      <i class="fas fa-eye"></i>
                      </a>
                  </td>
                    <td><a href="{{ route('debtor.edit', $debtor->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('debtor.destroy', $debtor->id) }}" method="POST">
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
    {{ $debtors->links('livewire.pagination') }}
</div>
