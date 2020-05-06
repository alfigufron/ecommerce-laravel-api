@extends('client.layouts.default')

@section('title-client') Detail Produk @endsection

@section('content-client')

  <section class="page-add">
    <div class="container">
      <div class="page-breadcrumb">
        <a href="index.html">Beranda</a>
        <a href="#" class="category-text"></a>
        <a class="active name-text" href="#"></a>
      </div>
    </div>
  </section>

  <section class="product-page" style="padding-bottom: 120px;">
    <div class="container">
      <div class="row">

        <div class="col-lg-6">
            <div class="product-img">
              
            </div>
        </div>

        <div class="col-lg-6">
          <div class="product-content">
            <h2 class="name-text"></h2>
            <div class="pc-meta">
              <h5 id="price-text"></h5>
            </div>

            <p id="description-text">

            </p>

            <ul class="tags">
              <li><span>Kategori :</span> <span class="category-text"></span></li>
              <li><span>Jumlah Barang :</span> <span class="quantity-text"></span></li>
            </ul>

            <a href="#" class="primary-btn pc-btn" id="btn-cart">Tambahkan ke keranjang</a>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@push('after-script')
  <script>
    var idParams = getUrlParameter('id');

    $(document).ready(function() {
      $.ajax({
        type: 'get',
        url: `http://localhost:8000/api/products?id=${idParams}`,
        cache: false,
        error: function(req, err) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat',
            text: 'Terjadi kesalahan pada server',
          });
        },
        success: function(response) {
          var urlPhoto = "";

          $.each(response.data.set_product, function(index, item) {
            if(item.default == 1) {
              urlPhoto = item.photo;
            }
          });

          $('.product-img').html(`<figure>\
            <img src="http://localhost:8000/${urlPhoto}" alt="">\
          </figure>`)

          $('.name-text').html(response.data.name);
          $('.category-text').html(response.data.get_category.name);
          $('.quantity-text').html(response.data.quantity);

          var price = format(response.data.price);
          $('#price-text').html(`Rp. ${price}`);

          $('#description-text').html(response.data.description);

          if(response.data.quantity == 0) {
            $('#btn-cart').hide()
          }
        }
      });
    });

    $('#btn-cart').on('click', function(e){
      e.preventDefault();
      const key = 'cart';
      var arrayItems = [];
      var status = "";

      var storage = localStorage.getItem('cart');
      if(storage != null){
        var listItem = $.parseJSON(storage);
        $.each(listItem, function(key, value) {
          arrayItems.push(value);
        });
      }

      $.each(arrayItems, function(key, value) {
        if(value == idParams) {
          status = 'found';
        }else {
          status = 'not found';
        }
      });

      if(status == 'found') {
        Swal.fire({
          icon: 'warning',
          title: 'Peringatan',
          text: 'Produk sudah ada di dalam keranjang',
        });
      }else {
        arrayItems.push(parseInt(idParams));
        localStorage.setItem(key, JSON.stringify(arrayItems));
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: 'Produk sudah di tambahkan ke keranjang',
        });
      }

    });
  </script>
@endpush