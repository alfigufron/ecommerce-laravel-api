@extends('layouts.default')

@section('title') Data Transaksi @endsection

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Transaksi</h1>
        </div>
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Data Transaksi</li>
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
              <table class="table table-bordered table-hover datatables-basic text-center" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->transcode }}</td>
                    <td id="transdate">{{ $item->transdate }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                      @if ($item->status == "P")
                      <span class="badge badge-warning">Ditunda</span>
                      @elseif ($item->status == "R")
                      <span class="badge badge-danger">Ditolak</span>
                      @else
                      <span class="badge badge-success">Dikonfirmasi</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('detail-transaction-data', $item->id) }}" class="btn btn-primary btn-sm">
                        Detail Transaksi
                      </a>
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
    $('#transaction-menu').addClass('menu-open');
    $('#transaction-menu a').first().addClass('active');
    $('#transaction-data-menu a').addClass('active');

    var transdate = $('#transdate').html();
    transdate = transdate.split('-');
    transdate = transdate[2]+'/'+transdate[1]+'/'+transdate[0];
    $('#transdate').html(transdate);
  </script>
@endpush