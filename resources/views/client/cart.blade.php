@extends('client.layouts.default')

@section('title-client') Keranjang @endsection

@section('content-client')

  <section class="page-add cart-page-add">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center p-3">
          <h2>Keranjang Belanja</h2>
        </div>
      </div>
    </div>
  </section>

  <div class="cart-page">
    <div class="container">
      <div class="cart-table">
        <table>
          <thead>
            <tr>
              <th class="product-h">Produk</th>
              <th>Harga</th>
              <th class="quan">Jumlah</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="list-cart">
            
          </tbody>
        </table>
      </div>
      <div class="cart-btn">
        <div class="row">
          <div class="col-lg-12 text-left text-lg-right">
            <div class="site-btn clear-btn" id="btn-clear-cart">Bersihkan Keranjang Belanja</div>
          </div>
        </div>
      </div>
    </div>

    <div class="shopping-method" style="padding-bottom: 0!important;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="total-info">
              <div class="total-table">
                <table>
                  <thead>
                    <tr>
                      <th class="total-cart">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="total-cart-p fulltotal-text">Rp 0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container" style="padding-bottom: 60px;">
      <h3 class="text-center" style="padding: 60px 0!important;">Lanjutkan ke Pembayaran</h3>
      <form action="#" class="checkout-form">
        <div class="row">
          <div class="col-lg-12">
            <h3>Data Diri</h3>
          </div>
          <div class="col-lg-9">
            <div class="row">
              <div class="col-lg-2">
                <p class="in-name">Nama *</p>
              </div>
              <div class="col-lg-5">
                  <input type="text" placeholder="Nama Depan" id="first-name">
              </div>
              <div class="col-lg-5">
                <input type="text" placeholder="Nama Belakang" id="last-name">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                <p class="in-name">Email *</p>
              </div>
              <div class="col-lg-10">
                <input type="text" placeholder="Email" id="email">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                <p class="in-name">Nomor HP *</p>
              </div>
              <div class="col-lg-10">
                <input type="text" placeholder="Nomor Telepon" id="phone-number">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
                <p class="in-name">Alamat *</p>
              </div>
              <div class="col-lg-10">
                <input type="text" placeholder="Alamat" id="address">
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="order-table">
              <div class="cart-item">
                <span>Harga</span>
                <p class="fulltotal-text">Rp 0</p>
              </div>
              <div class="cart-item">
                <span>Kode Unik</span>
                <p id="unique-text">0</p>
              </div>
              <div class="cart-total">
                <span>Total</span>
                <p class="fulltotalunique-text">Rp 0</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="payment-method">
              <h3>Pembayaran</h3>
              <ul>
                  <li>Lakukan transfer jika sudah ada konfirmasi melalui email</li>
                  <li>Nomor Rekening : 0628417794</li>
                  <li>Atas Nama : Muhammad Alfi Gufron</li>
                  <li>Konfirmasi selanjutnya melalui email sampai barang sampai, pastikan email yang anda masukan sudah benar</li>
              </ul>
              <button type="submit" id="btn-payment">Pesan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('after-script')
  <script>
    $('#keranjang').addClass('active');
    
    $(document).ready(function() {
      const key = 'cart';

      $('body').delegate('.cart-table tbody tr .input-quantity', 'keyup', function() {
        if($(this).val() == "") {

        }else {
          elementHtml = $(this).parent().parent().parent().children();
          price = elementHtml[1].innerHTML;
          price = price.replace('Rp ','').replace('.','').replace('.','');
          total = parseInt(price)*parseInt($(this).val());

          elementHtml[3].innerHTML = 'Rp '+format(total);

          check = $('.total');
          arrPrice = [];
          for(i=0; i<check.length; i++){
            var item = check[i].innerHTML;
            item = item.replace('Rp ','').replace('.','').replace('.','');
            arrPrice.push(parseInt(item));
          }

          total = arrPrice.reduce((a, b) => a + b, 0);
          unique = $('#unique-text').html()
          resTotal = format(total);
          totalUnique = format(total+parseInt(uniqueCode));

          $('.fulltotal-text').html('Rp '+resTotal);
          $('.fulltotalunique-text').html('Rp '+totalUnique);
        }
      });

      $('body').delegate('.cart-table tbody tr .product-close', 'click', function(){

        id = $(this).data('id');
        storage = localStorage.getItem('cart');
        listItem = $.parseJSON(storage);
        newListItem = []
        $.each(listItem, function(key, value) {
          if(value == id){

          }else{
            newListItem.push(value);
          }
        });
        localStorage.setItem(key, JSON.stringify(newListItem));
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: 'Produk di dalam keranjang berhasil di hapus',
        }).then(function() {
          window.location.reload();
        });
      });

      var storage = localStorage.getItem('cart');
      if(storage != null){
        var listItem = $.parseJSON(storage);
        var arrPriceTotal = [];
        $.each(listItem, function(key, value) {
          $.get(`http://localhost:8000/api/products?id=${value}`).done(
            function(response) {
              var price = format(response.data.price);
              var urlPhoto = "";

              $.each(response.data.set_product, function(index, item) {
                if(item.default == 1) {
                  urlPhoto = item.photo;
                }
              });

              $('#list-cart').prepend(`<tr>\
                <td class="product-col">\
                  <img src="http://localhost:8000/${urlPhoto}" alt="">\
                  <div class="p-title">\
                    <h5>${response.data.name}</h5>\
                  </div>\
                </td>\
                <td class="price-col">Rp ${price}</td>\
                <td class="quantity-col">\
                  <div class="pro-qty">\
                    <input type="text" value="1" class="input-quantity">\
                  </div>\
                </td>\
                <td class="total" id="total-text">Rp ${price}</td>\
                <td class="product-close" data-id="${response.data.id}">x</td>\
              </tr>`);

              uniqueCode = Math.floor(100000 + Math.random() * 900000);
              uniqueCode = String(uniqueCode);
              uniqueCode = uniqueCode.substring(0, 3);
              $('#unique-text').html(uniqueCode);

              arrPriceTotal.push(response.data.price);
              total = arrPriceTotal.reduce((a, b) => a + b, 0);
              resTotal = format(total);
              $('.fulltotal-text').html('Rp '+resTotal);

              totalUnique = format(total+parseInt(uniqueCode));
              $('.fulltotalunique-text').html('Rp '+totalUnique);
            }
          );
        });
      }else{
        $('#list-cart').prepend(`<tr>\
          <td colspan="5" class="text-center">Tidak ada produk</td>\
        </tr>`);
      }
    });

    $('#btn-clear-cart').on('click', function() {
      localStorage.removeItem('cart');
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Berhasil membersihkan keranjang',
      }).then(function() {
        location.reload();
      });
    });

    $('#btn-payment').on('click', function(e) {
      e.preventDefault();

      function dataNull() {
        Swal.fire({
          icon: 'warning',
          title: 'Peringatan',
          text: 'Harap isi semua data secara lengkap',
        })
      }

      var firstName = $('#first-name').val(); 
      var lastName = $('#last-name').val(); 
      var email = $('#email').val(); 
      var phoneNumber = $('#phone-number').val(); 
      var address = $('#address').val();

      if(firstName == "") {
        dataNull()
      }else if(lastName == "") {
        dataNull()
      }else if(email == "") {
        dataNull()
      }else if(phoneNumber == "") {
        dataNull()
      }else if(address == "") {
        dataNull()
      }else {
        var arrQtyProduct = [];
        var arrIdProduct = [];

        var productId = $('.product-close');
        for(i=0; i<productId.length; i++){
          arrIdProduct.push(parseInt(productId[i].getAttribute('data-id')))
        }

        var inputQty = $('.input-quantity');
        for(i=0; i<inputQty.length; i++){
          arrQtyProduct.push(parseInt(inputQty[i].value))
        }

        total = $('.fulltotalunique-text').html();
        total = parseInt(total.replace('Rp ','').replace('.','').replace('.',''));

        date = new Date();
        day = date.getDate();
        if(day > 10){day = day;}
        else{day = "0"+day;}

        month = date.getMonth();
        if(month > 10){month = month
        }else{month = "0"+month;}

        transdate = date.getFullYear()+'-'+month+'-'+day;

        data = {};
        data['transdate'] = transdate;
        data['name'] = firstName+' '+lastName;
        data['email'] = email;
        data['phone'] = phoneNumber;
        data['address'] = address;
        data['transtotal'] = total;
        data['product_id'] = arrIdProduct;
        data['quantity'] = arrQtyProduct;

        $.ajax({
          type: 'POST',
          url: 'http://localhost:8000/api/transaction/checkout',
          data: JSON.stringify(data),
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Transaksi Sukses, harap tunggu konfirmasi melalui email'
            }).then(function() {
              $('#btn-clear-cart').click();
            });
          },
          failure: function(response) {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'Transaksi Gagal, ada kesalahan pada sistem'
            })
          }
        })
      }


    });

  </script>
@endpush