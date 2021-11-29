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
                    <h5><i class="fas fa-map-marker-alt"></i> {{$data_toko->alamat}}</h5>
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
    <script>
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <script src="{{asset('js/list-barang.js')}}"></script>
    <script src="{{asset('js/detailtoko.js')}}"></script>
@endpush