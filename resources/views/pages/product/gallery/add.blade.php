@extends('layouts.default')

@section('title') Tambah Gambar Produk @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Gambar Produk</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Produk</li>
            <li class="breadcrumb-item"><a href="{{ route('gallery-data') }}">Galeri Produk</a></li>
            <li class="breadcrumb-item active">Tambah Gambar Produk</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-12">
          <form action="" method="post">
          <div class="card text-left">
            <div class="card-body">

              <div class="form-group">
                <label>Nama Produk</label>
                <select class="form-control form-control-sm" id="product_id">
                  <option>Pilih Opsi</option>
                  @foreach ($productData as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Upload Gambar</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">
                      <i class="fas fa-image"></i>
                    </span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload-image" aria-describedby="inputGroupFileAddon01" accept="image/*">
                    <label class="custom-file-label" for="upload-image">Pilih Gambar</label>
                  </div>
                </div>
                <small id="helpId" class=" text-danger">* Rasio Gambar Wajib 1:1</small>
              </div>

              <div class="cropping-image d-none">
              </div>

              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="default" class="custom-control-input" id="priority-switch">
                  <label class="custom-control-label" for="priority-switch">Prioritas</label>
                </div>
              </div>

              <button type="submit" class="btn btn-block btn-1" id="store">Tambah Data</button>

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
    $('#product-gallery-menu a').addClass('active');

    let cropImg = $('.cropping-image').croppie({
      viewport: {
        width: 500,
        height: 500,
        type: 'square'
      },
      boundary: {
        width: 800,
        height: 500
      },
      enableExif: true
    });

    $('#upload-image').on('change', function(){
      readImage(this);
    });

    function readImage(input){
      if(input.files && input.files[0]){
        $('.cropping-image').removeClass('d-none');
        let reader = new FileReader();
        reader.onload = function(e){
          $('.cropping-image').croppie('bind', {
            url: e.target.result
          });
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('#store').on('click', function(e){
      e.preventDefault();

      var _token = $('input[name=_token]').val();
      var productId = $('#product_id').val();
      if($('#priority-switch').is(':checked')) {
        isDefault = 1;
      }else{
        isDefault = 0;
      }

      cropImg.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(img){
        $.ajax({
          url: "{{route('store-gallery')}}",
          type: "POST",
          data: {
            'image':img, 
            '_token':_token,
            'productId':productId,
            'isDefault':isDefault,
          },
          success:function(data){
            if(data['status'] == 200){
              window.location.href = "{{ route('gallery-data') }}"
            }
          }
        });
      });
    });
  </script>
@endpush