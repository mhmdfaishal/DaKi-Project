@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/list_penyewaan.css') }}">
<style>
  .pagination{
    margin-left: 50%;
  }
</style>
@endpush

@section('title', 'Transaksi | Dasbor Pendaki')

@section('main')
<div class="container-fluid header"></div>
<div class="box-container" id="container_home">
  <div class="body-content">
    <div class="head-title" data-aos="fade-up">
      <h3>Riwayat Penyewaan Produk</h3>
      <table class="table table-bordered" id="user-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pesan</th>
            <th>Total Produk</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
      </table>    
    </div>
  </div>
</div>
@endsection

@push('scripts')

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
  <script src="{{asset('js/home.js')}}"></script>
  <script src="{{asset('js/list-gunung.js')}}"></script>
  <script>
  /*
  $(function() {
      $('#users-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: 'user/json',
          columns: [
              { data: 'no', name: 'no' },
              { data: 'tanggal_pesan', name: 'tanggal_pesan' },
              { data: 'total_produk', name: 'total_produk' },
              { data: 'total_harga', name: 'total_harga' },
              { data: 'status', name: 'status' },
              { data: 'aksi', name: 'aksi' }
          ]
      });
  });
  */
  </script>

@endpush