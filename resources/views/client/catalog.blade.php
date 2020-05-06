@extends('client.layouts.default')

@section('title-client') Katalog @endsection

@section('content-client')

  <section class="page-add">
    <div class="container">

      <div class="product-filter">
        <div class="row">
          <div class="col-lg-12 text-center" style="padding-top: 30px;">

            <div class="section-title">
              <h2>Semua Produk</h2>
            </div>

            {{-- <ul class="product-controls">
              <li class="all">Semua</li>
              <li class=".Processor">Processor</li>
              <li class=".VGA">VGA</li>
              <li class=".Storage">Storage</li>
              <li class=".Accessories">Aksesoris</li>
            </ul> --}}

          </div>
        </div>
      </div>

      <div class="row" id="product-list">
      </div>

    </div>
  </section>

@endsection

@push('after-script')
  <script>
    $('#katalog').addClass('active');

    $(document).ready(function() {
      $.ajax({
        type: 'get',
        url: 'http://localhost:8000/api/products',
        cache: true,
        error: function(req, err) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat',
            text: 'Terjadi kesalahan pada server',
          });
        },
        success: function(response) {
          $.each(response.data, function(index, item) {
            var price = format(item.price);
            var urlPhoto = "";

            $.each(item.set_product, function(index, item) {
              if(item.default == 1) {
                urlPhoto = item.photo;
              }
            });

            $('#product-list').html();
            $('#product-list').append(`<div class="col-lg-4 col-sm-6 mix all ${item.get_category.name}">\
              <div class="single-product-item">
                <figure>
                  <a href="{{route('detail-client')}}?id=${item.id}"><img src="http://localhost:8000/${urlPhoto}" alt=""></a>\
                </figure>\
                <div class="product-text">\
                  <h6>${item.name}</h6>\
                  <p>Rp ${price}</p>\
                </div>
              </div>\
            </div>`);
          });
        }
      });
    });
  </script>
@endpush