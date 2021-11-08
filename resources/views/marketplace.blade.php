@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/marketplace.css') }}">
@endpush

@section('title', 'Marketplasce | Dasbor Pendaki')

@section('main')
<div class="container-fluid header">
  <div class="head-title" data-aos="fade-up">
    <h3>Daftar Toko</h3>
    <hr class="under-split">
  </div>
</div>
<div class="box-container">
    <div class="body-content d-flex">
        <div class="sidebar-left">
            <h2 style="font-weight: 300;"><i class="fas fa-filter"></i> Filters</h2>
            <div class="search-bar">
              <form role="search" method="GET" id="searchform" action="{{route('index.marketplace')}}">
                <div class="input-group rounded">
                  @if(request('location'))
                  <input type="hidden" name="location" id="location" value="{{ request('location') }}">
                  @endif
                  <span class="border-0" id="search-addon">
                    <button class="btn-search" type="submit"><i class="fas fa-search"></i></button>
                  </span>
                  <input type="search" class="search-box form-control rounded" placeholder="Search" name="search" aria-label="Search"
                  aria-describedby="search-addon" value="{{request('search')}}" />
                </div>
              </form>
            </div>
            <h2 class="location-title">Lokasi</h2>
            <div class="location-filter">
              <form role="search" id="location_filter" action="{{route('index.marketplace')}}" class="location_form" method="GET">
                @if(request('search'))
                  <input type="hidden" name="search" id="search" value="{{ request('search') }}">
                @endif
                @foreach ($all_data->unique('kotakabupaten') as $toko)
                  <div class="location_filter container">
                      <input type ="checkbox" name="location" class="location_name" id="location_name" value="{{$toko->kotakabupaten}}" @if($location == $toko->kotakabupaten) checked @endif/>
                      <label for="location">{{$toko->kotakabupaten}}</label>
                  </div>
                @endforeach
              </form>
            </div>
        </div>
        <div class="container">
          <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
          @if($data_toko->count() == 0)
          <h2 style="text-align:center;">Tidak ada data</h2>
          @else
            @foreach ($data_toko as $toko)
            <div class="list-toko" data-id="{{ $toko->nama_toko }}" id="list_toko" data-aos="fade-up">
                <div class="wrap-list d-flex">
                    <img src="{{asset('images/logo6.png')}}" alt="" class="home_gambar_toko">
                    <div class="detail" id="detail">
                      <h3>{{ $toko->nama_toko }}</h3>
                      <i class="fas fa-map-marker-alt"></i><a href="{{$toko->url_gmaps}}" target="_blank" class="location-mount"> {{ $toko->kotakabupaten }}</a>
                    </div>
                    <div class="detail-other d-flex">
                      <p class="jumlah-barang"><i class="fas fa-box"></i> 120 Barang</p>
                      <p class="rating-toko"><i class="far fa-star"></i> {{$toko->rating}}</p>
                    </div>
                    <a href="{{route('detail.toko',$toko->nama_toko)}}" class="btn-detail-toko"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="Page navigation example">
        <ul class="pagination justify-content-center">
          @if($data_toko->lastPage() > 1)
          @if($data_toko->currentPage() == 1)
          <li class="page-item disabled">
            <a class="page-link" href="">Previous</a>
          </li>
          @else
          <li class=" page-item">
            <a class="page-link" href="{{ $data_toko->url($data_toko->currentPage() - 1) }}"">Previous</a>
          </li>
          @endif
          <li class=" page-item active">
                <span class="page-link">
                  {{ $data_toko->currentPage() }}
                  <span class="sr-only">(current)</span>
                </span>
          </li>
          @if($data_toko->currentPage() == $data_toko->lastPage())
          <li class="page-item disabled">
            <a class="page-link" href="{{ $data_toko->url($data_toko->lastPage()) }}">Next</a>
          </li>
          @else
          <li class="page-item">
            <a class="page-link" href="{{ $data_toko->url($data_toko->currentPage() + 1) }}">Next</a>
          </li>
          @endif
          @endif
        </ul>
      </div>
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
  <script src="{{asset('js/marketplace.js')}}"></script>
@endpush