@extends('layouts.default')

@section('title') Detail Data Transaksi @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Data Transaksi</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item"><a href="{{ route('transaction-data') }}">Data Transaksi</a></li>
            <li class="breadcrumb-item active">Detail Data Transaksi</li>
          </ol>
        </div>

      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <div class="card text-left">
            <div class="card-body">
              <h4 class="card-title mb-2"># {{ $data->transcode }}</h4>

              <table width="100%" class="table-detail-transaction">
                <tr>
                  <th style="width: 19%;"></th>
                  <th style="width: 1%;"></th>
                  <th></th>
                </tr>
                <tr>
                  <td>Nama Pemesan</td>
                  <td>:</td>
                  <td>{{ $data->name }}</td>
                </tr>
                <tr>
                  <td>Nomor Telepon</td>
                  <td>:</td>
                  <td>{{ $data->phone }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td>{{ $data->email }}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td style="position: absolute;">:</td>
                  <td>{{ $data->address }}</td>
                </tr>
                <tr>
                  <td>Tanggal Pemesanan</td>
                  <td>:</td>
                  <td id="transdate">{{ $data->transdate }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>:</td>
                  <td>
                    @if ($data->status == "P")
                      Menunggu
                    @elseif ($data->status == "S")
                      Sukses
                    @else
                      Dibatalkan
                    @endif
                  </td>
                </tr>
              </table>

              <table class="table mt-4 text-center table-striped">
                <thead class="bg-1 text-light">
                  <tr>
                    <th>Jumlah Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($detail as $item) 
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getProduct->name }}</td>
                    <td>Rp {{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ $item->total }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot class="bg-1 text-light">
                  <tr>
                    <td colspan="4">Total</td>
                    <td>Rp {{ $total }}</td>
                  </tr>
                </tfoot>
              </table>

              <div class="row mt-4">
                <div class="col-md-12 text-center mb-2">
                  <span class="text-muted">Status Transaksi</span>
                </div>

                @if($data->status == "R")
                <div class="col-md-12 text-center">
                  <h3 class="text-muted font-weight-bold">Transaksi sudah ditolak</h3>
                </div>
                @elseif($data->status == "P")
                <div class="col-md-12 text-center">
                  <h3 class="text-muted font-weight-bold">Transaksi di tunda</h3>
                </div>
                @else
                <div class="col-md-12 text-center">
                  <h3 class="text-muted font-weight-bold">Transaksi sudah di konfirmasi</h3>
                </div>
                @endif
                <div class="col-md-4 mt-3">
                  <form action="{{ route('transaction-success', $data->id) }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block btn-option">
                      <i class="fas fa-check mr-1"></i>Konfirmasi Transaksi
                    </button>
                  </form>
                </div>

                <div class="col-md-4 mt-3">
                  <form action="{{ route('transaction-pending', $data->id) }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-block btn-option">
                      <i class="fas fa-clock mr-1"></i>Tunda Transaksi
                    </button>
                  </form>
                </div>

                <div class="col-md-4 mt-3">
                  <form action="{{ route('transaction-reject', $data->id) }}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block btn-option">
                      <i class="fas fa-times mr-1"></i>Tolak Transaksi
                    </button>
                  </form>
                </div>
                
              </div>

            </div>
          </div>
        </div>
        

      </div>
    </div>
  </div>
@endsection

@push('after-script')
  <script>
    $('#transaction-menu').addClass('menu-open');
    $('#transaction-menu a').first().addClass('active');
    $('#transaction-data-menu a').addClass('active');

    var transdate = $('#transdate').html();
    transdate = transdate.split('-');
    transdate = transdate[2]+'/'+transdate[1]+'/'+transdate[0];
    $('#transdate').html(transdate);
  </script>
@endpush