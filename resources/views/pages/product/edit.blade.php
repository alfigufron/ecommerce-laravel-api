@extends('layouts.default')

@section('title') Ubah Data Produk @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Data Produk</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item"><a href="{{ route('product-data') }}">Data Produk</a></li>
            <li class="breadcrumb-item active">Edit Produk</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-12">
          <form action="{{ route('save-product', $data->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="card text-left">
            <div class="card-body">

              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" id="" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ $data->name }}" autocomplete="off">
                @error('name')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>Kategori Barang</label>
                <select class="form-control form-control-sm @error('category_id') is-invalid @enderror" name="category_id" id="">
                  <option>Pilih Opsi</option>
                  @foreach ($categoryData as $item)
                  <option value="{{ $item->id }}" @if($item->id == $data->category_id) selected="selected" @endif>{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="number" name="quantity" id="" class="form-control form-control-sm @error('quantity') is-invalid @enderror" value="{{ $data->quantity }}">
                @error('quantity')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>Harga Barang</label>
                <input type="number" name="price" id="" class="form-control form-control-sm @error('price') is-invalid @enderror" value="{{ $data->price }}">
                @error('price')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>Deskripsi Barang</label>
                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" name="description" id="" rows="5">{{ $data->description }}</textarea>
                @error('description')
                  <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <button type="submit" class="btn btn-block btn-1">Simpan Perubahan Data</button>

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
    $('#product-menu').addClass('menu-open');
    $('#product-menu a').first().addClass('active');
    $('#product-data-menu a').addClass('active');
  </script>
@endpush