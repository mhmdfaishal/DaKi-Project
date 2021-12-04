@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/detail_toko.css') }}">
<link rel="stylesheet" href="{{asset('css/list_barang.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Detail Toko | Dasbor Pendaki')
<style type="text/css">
    .preloader {
      position: fixed;
      width: 18%;
      height: 22%;
      margin-left: 40%;
      margin-top: 17%;
      z-index: 1;
      background-color: #fff;
      border-radius: 15px;
    }
    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
    }
    .text-loading{
        margin-top: 20%;
        text-align: center;
    }
    .spinner-border{
        margin-top: 10%;
        margin-left: 30%;
    }
</style>
@section('main')
<div class="box-container wrap-body">
    <div class="head-title">
        <h3><a href="/sewa" class="btn-back"><i class="fas fa-chevron-left"></i></a> Detail Toko</h3>
        {{-- <hr class="under-split"> --}}
    </div>
    <div class="body-content">
        <div class="container d-flex content-header">
            <div class="store-profile container">
                <div class="d-flex">
                    <img src="{{asset('storage/images/toko/'.$data_toko->logo_toko)}}" class="logo-toko" alt="">
                    <h4 class="nama-toko">{{$data_toko->nama_toko}}</h4>
                </div>
                <div class="d-flex container justify-content-center">
                    @if(Auth::check())
                        @if(Auth::user()->email != $data_toko->user->email && !$hasfollow)
                            <button class="btn btn-outline-dark btn-follow" id="follow_button" data-id="{{$data_toko->id}}"><i class="fas fa-plus"></i> Ikuti</button>
                        @elseif(Auth::user()->email != $data_toko->user->email && $hasfollow)
                            <button class="btn btn-outline-dark btn-follow" id="follow_button" data-id="{{$data_toko->id}}"><i class="fas fa-user-check"></i> Mengikuti</button>
                        @endif
                    @else
                        <button class="btn btn-outline-dark btn-follow" data-toggle="modal" data-target=".login-modal"><i class="fas fa-plus"></i> Ikuti</button>
                    @endif
                </div>
            </div>
            <div class="detail-store d-flex">
                <div class="flex-direction-column detail-first">
                    <input type="hidden" name="id_toko" id="id_toko" value="{{$data_toko->id}}">
                    <h5 class="alamat"><i class="fas fa-map-marker-alt"></i> {{$data_toko->alamat}}</h5>
                    <h5><i class="fas fa-box-open"></i> Produk: {{$jumlah->count()}}</h5>
                    <h5><i class="fas fa-user-check"></i> Bergabung: {{$data_toko->created_at->diffForHumans();}}</h5>
                </div>
                <div class="flex-direction-column detail-end">
                    <h5><i class="far fa-star"></i> Penilaian: {{$data_toko->rating}}</h5>
                    <h5><i class="fas fa-users"></i> Pengikut: <span id="jumlah_follower">{{$data_toko->follower}}</span></h5>
                </div>
            </div>
            @if(Auth::check() && Auth::user()->email == $data_toko->user->email)
            <a href="{{route('admin.detail.toko')}}"><button class="btn-edit-toko"><i class="far fa-edit"></i> Edit Toko</button></a>
            @endif
        </div>

        <div class="content-body">
            <div class="container d-flex">
                @if(Auth::check() && Auth::user()->email == $data_toko->user->email)
                    <button class="btn-tambah-barang" id="btn-tambah-barang" data-toggle="modal" data-target="#modal-tambah-barang"><i class="fas fa-plus-square"></i> Tambah barang</button>
                    <div class="modal fade" id="modal-tambah-barang" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content modal-dialog-scrollable">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center">Tambah barang</h5>
                                    <button type="close" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="form-tambah-barang" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">                                    
                                                <div class="form-group">
                                                    <label for="nama_barang" class="col-sm-12 control-label">Nama Barang</label>
                                                    <div class="col-sm-12">
                                                        <input type="hidden" name="id_barang" id="id_barang" value="">
                                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga" class="col-sm-12 control-label">Harga</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" class="form-control" id="harga" name="harga" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="interval" class="col-sm-12 control-label">Interval Penyewaan</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-select" id="interval" name="interval" aria-label="Default select example" required>
                                                            <option selected>Pilih interval</option>
                                                            <option value="hari">Hari</option>
                                                            <option value="minggu">Minggu</option>
                                                            <option value="bulan">Bulan</option>
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="interval_number" class="col-sm-12 control-label">Lama interval</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" class="form-control" id="interval_number" name="interval_number" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi" class="col-sm-12 control-label">Deskripsi Barang</label>
                                                    <div class="col-sm-12">
                                                        <textarea name="deskripsi" id="deskripsi" cols="28" rows="10" placeholder="(ex : Ukuran 2m x 2m)" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gambar_barang" class="col-sm-12 control-label">Gambar Barang</label>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" name="gambar_barang" id="gambar_barang" accept="image/*" required>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="submit" class="btn btn-block btn-sewa" id="tombol-sewa"><i class="far fa-caret-square-up"></i> Sewakan barang</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>
                @endif  
            </div>
            <div class="modal fade" id="modal-detail-barang" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content modal-dialog-scrollable">
                        <div class="modal-header">
                            <h5 class="modal-title text-center">Detail barang</h5>
                            <button type="close" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <img src="" class="detail-gambar-barang" id="gambar_barang_detail" alt="">
                            <h2 class="detail-nama-barang" id="get_nama_barang"></h2>
                            <hr>
                            <h4 class="text-center">Deskripsi barang : </h4>
                            <h2 class="detail-deskripsi-barang" name="get_deskripsi" id="get_deskripsi"></h2>
                            <hr>
                            <h3 class="detail-harga-barang" id="harga_interval"></h3>
                        </div>
                    </div>
                </div>
              </div>
            <div class="d-flex justify-content-center">
                <div class="title-list">
                    <h2 class="title-daftar-barang">Daftar Barang</h2>
                    <hr class="split-title">
                </div>
                <div class="search-bar">
                    <form id="searchform">
                        <div class="input-group rounded">
                        <span class="border-0" id="search-addon">
                            <button type="button" class="btn-search" id="button_search"><i class="fas fa-search"></i></button>
                        </span>
                        <input type="text" class="search-box form-control rounded" placeholder="Search" id="search_input" name="search" aria-label="Search"
                        aria-describedby="search-addon" value="{{request('search')}}" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="modal-diff-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Barang</h5>
                        <button type="close" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Barang yang anda pilih terdapat di <b>toko yang berbeda</b> dengan yang sebelumnya anda pilih. Jika anda ingin <b>melanjutkan</b> maka barang sebelumnya akan <b style="color:red;">terhapus dari keranjang.</b></p>
                    </div>
                    <div class="modal-footer">
                        <button type="close" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-success" id="btn-lanjutkan">Lanjutkan</button>
                    </div>
                    </div>
                </div>
            </div>
            <div id="list-barang">
                @include('list_barang')
            </div>
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
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <script src="{{asset('js/list-barang.js')}}"></script>
    <script src="{{asset('js/keranjang.js')}}"></script>
    <script src="{{asset('js/detailtoko.js')}}"></script>
@endpush
