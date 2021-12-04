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
    <div class="modal fade" id="modal-detail-penyewaan" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content  modal-dialog-scrollable">
          <div class="modal-header">
                  <h5 class="modal-title text-center">Detail Penyewaan</h5>
                  <button type="close" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
              </div>
              <div class="modal-body">
                <table id="detail-user">
                    <tr>
                        <td class="data">Tanggal Penyewaan</td>
                        <td> : </td>
                        <td class="detail-sewa" id="tgl-sewa"></td>
                    </tr>
                    <tr>
                        <td class="data">Nama Penyewa</td>
                        <td> : </td>
                        <td class="detail-sewa" id="nama-user"></td>
                    </tr>
                    <tr>
                        <td class="data">Nama Toko</td>
                        <td> : </td>
                        <td class="detail-sewa" id="nama-toko"></td>
                    </tr>
                    <tr>
                        <td class="data">Alamat toko</td>
                        <td> : </td>
                        <td class="detail-sewa" id="alamat-toko"></td>
                    </tr>
                    <tr>
                        <td class="data">Kontak toko</td>
                        <td> : </td>
                        <td class="detail-sewa" id="kontak-toko"></td>
                    </tr>
                </table>
                <table id="detail-transaksi">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Kuantitas</th>
                      <th>Harga</th>
                      <th>Lama penyewaan</th>
                      <th>Total Harga</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                 
                </table>
              </div>
          </div>
      </div>
    </div>
    <div class="head-title" data-aos="fade-up">
      <h3><a href="/sewa" class="btn-back"><i class="fas fa-chevron-left"></i></a> Riwayat Penyewaan Produk</h3>
      <table class="table table-bordered" id="tablepenyewaan">
        <thead>
          <tr>
            <th class="text-center">No Transaksi</th>
            <th class="text-center">Tanggal Pesan</th>
            <th class="text-center">Total Produk</th>
            <th class="text-center">Total Harga</th>
            <th class="text-center">Detail</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>

  <script>
  $(document).ready(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      });
  $(document).ready(function() {
          $('#tablepenyewaan').DataTable({
              processing : true,
              serverSide : true,
              ajax : {
                  url : "{{ route('penyewaan.user') }}",
                  type : "GET"
              },
              columns: [
                  { data: 'no_transaksi', name: 'no_transaksi' },
                  { data: 'hari', name: 'hari' },
                  { data: 'total_produk', name: 'total_produk' },
                  { data: 'total_harga', name: 'total_harga' },
                  { data: 'detail', name: 'detail' },
                  { data: 'status', name: 'status' },
              ]
            });
    });
  </script>
  <script src="{{asset('js/list-penyewaan.js')}}"></script>

@endpush