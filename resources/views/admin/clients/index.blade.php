@extends('layouts.admin_layout')

@section('title', 'users')
 
@section('content')

    <div class="bg-light p-4 rounded">
        <h4>Список клиентов</h4>
    
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="float-left">
                        <select class="custom-select" style="width: auto;" data-sortOrder>
                          <option value="index"> Sort by Position </option>
                          <option value="sortData"> Sort by Custom Data </option>
                        </select>
                        <div class="btn-group">
                          <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                          <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                        </div>
                      </div>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('client.create') }}" class="btn btn-primary btn-sm float-right">Создать</a>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">ID</th>
                <th scope="col" width="15%">Имя</th>
                <th scope="col" width="15%">Долги</th>
                <th scope="col" width="10%">Телефон</th>
                <th scope="col" width="10%">Дата создание</th>
                <th scope="col" width="1%" colspan="3">Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $client->name }}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye">подробно</i>
                            </a>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        
                        <td><a href="{{ route('client.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>
                        <td>
                            <form action="" method="POST">
                                {{-- @csrf
                                @method('DELETE') --}}
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
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        <div class="d-flex">
            {{-- {!! $users->links() !!} --}}
        </div>

</div>		
    
        
    



@endsection