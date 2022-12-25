@extends('layouts.app')

@section('title', 'debtors')
 
@section('content')

    <div class="bg-light p-4 rounded">
        <h4>Список должников</h4>
    
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
                <a href="{{ route('debtor.create') }}" class="btn btn-primary btn-sm float-right">Создать</a>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      @livewire('debtor-pagination')
        
    </div>		 



@endsection