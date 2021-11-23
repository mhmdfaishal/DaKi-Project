@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/detail_toko.css') }}">
<link rel="stylesheet" href="{{asset('css/list_barang.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Detail Toko | Dasbor Pendaki')

@section('main')
<div class="box-container">
    <div class="head-title" data-aos="fade-up">
        <h3><a href="/sewa" class="btn-back"><i class="fas fa-chevron-left"></i></a> Detail Toko</h3>
        {{-- <hr class="under-split"> --}}
    </div>
    <div class="body-content">
        <div class="container d-flex content-header">
            <div class="store-profile container">
                <div class="d-flex">
                    <img src="{{asset('images/logo6.png')}}" class="logo-toko" alt="">
                    <h4 class="nama-toko">{{$data_toko->nama_toko}}</h4>
                </div>
                <div class="d-flex container justify-content-center">
                    @if(Auth::check())
                        @if(Auth::user()->id != $data_toko->user_id)
                            <button class="btn btn-outline-dark btn-follow"><i class="fas fa-plus"></i> Ikuti</button>
                            @else
                            
                        @endif
                    @else
                        <button class="btn btn-outline-dark btn-follow"><i class="fas fa-plus"></i> Ikuti</button>
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
                    <h5><i class="fas fa-users"></i> Pengikut: {{$data_toko->follower}}</h5>
                </div>
            </div>
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
  <script src="{{asset('js/list-barang.js')}}"></script>

@endpush