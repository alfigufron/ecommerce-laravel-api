@extends('layouts.default')

@section('title') Data Galeri Produk @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Galeri Produk</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item active">Galeri Produk</li>
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
              <a href="{{ route('add-gallery') }}" class="btn btn-1 btn-block mt-2 mb-3">
                <i class="fas fa-plus mr-1"></i>
                Tambah Gambar Produk
              </a>

              <table class="table table-bordered table-hover datatables-basic text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Prioritas</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($galleryData as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getProduct->name }}</td>
                    <td>
                      <img src="{{ asset($item->photo) }}" class="product-image">
                    </td>
                    <td>
                      @if($item->default == 1)
                        <i class="fas fa-check"></i>
                      @else
                        <i class="fas fa-times"></i>
                      @endif
                    </td>
                    <td>
                      <form action="{{ route('delete-gallery', $item->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm btn-option">
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
    $('#product-menu').addClass('menu-open');
    $('#product-menu a').first().addClass('active');
    $('#product-gallery-menu a').addClass('active');
  </script>
@endpush