@extends('layouts.default')

@section('title') Tambah Kategori @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Data Kategori</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Kategori</li>
            <li class="breadcrumb-item active">Tambah Kategori</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-12">
          <form action="{{ route('store-category') }}" method="post">
          @csrf
          <div class="card text-left">
            <div class="card-body">

              <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" id="" class="form-control form-control-sm @error('name') is-invalid @enderror" autocomplete="off">
                @error('name')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <button type="submit" class="btn btn-block btn-1">Tambah Data</button>

            </div>
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('after-script')
  <script>
    $('#category-menu').addClass('menu-open');
    $('#category-menu a').first().addClass('active');
    $('#add-category-menu a').addClass('active');
  </script>
@endpush