@extends('client.layouts.default')

@section('title-client') Beranda @endsection

@section('content-client')

  <section class="hero-slider">
    <div class="hero-items owl-carousel">
      <div class="single-slider-item set-bg" data-setbg="{{asset('client/img/slider-1.jpg')}}">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>2020</h1>
              <h2>New Set Up.</h2>
              <a href="#" class="primary-btn">See More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slider-item set-bg" data-setbg="{{asset('client/img/slider-2.jpg')}}">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>2020</h1>
              <h2>New Set Up.</h2>
              <a href="#" class="primary-btn">See More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slider-item set-bg" data-setbg="{{asset('client/img/slider-3.jpg')}}">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>2020</h1>
              <h2>New Set Up.</h2>
              <a href="#" class="primary-btn">See More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="features-section spad">
    <div class="features-ads">
      <div class="container">
        <div class="row">

          <div class="col-lg-4">
            <div class="single-features-ads first">
              <i class="fas fa-truck fa-2x"></i>
              <h4>Gratis Ongkir</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore officiis, odio porro ipsa saepe harum quidem nisi aliquam fugiat exercitationem facilis ipsam esse sunt, aperiam dicta, expedita quasi architecto? Odio!</p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="single-features-ads second">
              <i class="fas fa-hand-holding-usd fa-3x"></i>
              <h4>100% Uang Kembali</h4>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis saepe laboriosam perspiciatis consequuntur harum ipsam dignissimos illum corrupti quae odit inventore at ex quaerat ab odio, ipsum mollitia incidunt adipisci.</p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="single-features-ads third">
              <i class="fa fa-phone fa-2x"></i>
              <h4>Operator 24 Jam</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus officia ducimus architecto laboriosam dolorem odit dicta voluptas iusto labore laudantium earum ut debitis, accusamus impedit nihil itaque minus voluptatem laborum!</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="latest-products spad">
    <div class="container">
      <div class="product-filter">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="section-title">
              <h2>Produk Terbaru</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="product-list">

      </div>
    </div>
  </section>

  <section class="lookbok-section">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-4 offset-lg-1">
          <div class="lookbok-left">
            <div class="section-title">
              <h2>2020 <br />#NewSetup</h2>
            </div>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique, repellat omnis quos quasi enim rem quod tenetur maxime optio laboriosam illo harum eos natus quisquam, labore est perspiciatis accusamus iste!
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus iure itaque magnam nihil minima placeat inventore doloremque eos exercitationem. Possimus expedita necessitatibus suscipit! Fugiat incidunt, alias non odio quia earum.
            </p>
            <a href="#" class="primary-btn look-btn">See More</a>
          </div>
        </div>

        <div class="col-lg-5 offset-lg-1">
          <div class="lookbok-pic">
            <img src="{{asset('client/img/lookbok.jpg')}}" alt="">
          </div>
        </div>

      </div>
    </div>
  </section>

  <div class="logo-section spad support-carousel">
    <div class="logo-items owl-carousel">
      <div class="logo-item">
        <img src="{{asset('client/img/logos/logo-1.png')}}" alt="">
      </div>
      <div class="logo-item">
        <img src="{{asset('client/img/logos/logo-2.png')}}" alt="">
      </div>
      <div class="logo-item">
        <img src="{{asset('client/img/logos/logo-3.png')}}" alt="">
      </div>
      <div class="logo-item">
        <img src="{{asset('client/img/logos/logo-4.png')}}" alt="">
      </div>
      <div class="logo-item">
        <img src="{{asset('client/img/logos/logo-5.png')}}" alt="">
      </div>
    </div>
  </div>

@endsection

@push('after-script')
  <script>
    $('#beranda').addClass('active');

    $(document).ready(function() {
      $.ajax({
        type: 'get',
        url: 'http://localhost:8000/api/products?status=new',
        cache: true,
        error: function(req, err) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat',
            text: 'Terjadi kesalahan pada server',
          });
        },
        success: function(response) {
          console.log('success');
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