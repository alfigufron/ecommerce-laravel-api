@extends('layouts.default')

@section('title') Data Kategori @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Kategori</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Kategori</li>
            <li class="breadcrumb-item active">Data Kategori</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-12">
          <div class="card text-left">
            <div class="card-body">
              <table class="table table-bordered table-hover datatables-basic text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                      <a href="{{ route('edit-category', $item->id) }}" class="btn btn-1 btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                    <form action="{{ route('delete-category', $item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')

                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('after-script')
  <script>
    $('#category-menu').addClass('menu-open');
    $('#category-menu a').first().addClass('active');
    $('#category-data-menu a').addClass('active');
  </script>
@endpush