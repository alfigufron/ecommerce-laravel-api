@extends('layouts.default')

@section('title') Data Produk @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Produk</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item active">Data Produk</li>
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
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>
                        {{ $item->getCategory->name }}
                      </td>
                      <td>Rp {{ $item->price }}</td>
                      <td>
                        {{-- <a href="detail-gallery.html" class="btn btn-primary btn-sm btn-option">
                          <i class="fas fa-images"></i>
                        </a> --}}
                        <a href="{{ route('edit-product', $item->id) }}" class="btn btn-1 btn-sm btn-option">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('delete-product', $item->id) }}" method="post" class="d-inline">
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
    $('#product-data-menu a').addClass('active');
  </script>
@endpush