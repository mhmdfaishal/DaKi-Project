@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/home.css') }}">
@endpush

@section('title', 'Home | Dasbor Pendaki')

@section('main')
<div class="container-fluid header">
  <div class="head-title" data-aos="fade-up">
    <h3>Daftar Gunung</h3>
    <hr class="under-split">
  </div>
</div>
<div class="box-container">
    <div class="body-content d-flex">
        <div class="sidebar-left">
            <h2 style="font-weight: 300;"><i class="fas fa-filter"></i> Filters</h2>
            <div class="search-bar">
              <form role="search" method="GET" id="searchform" action="{{route('index')}}">
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
              <form role="search" id="location_filter" action="{{route('index')}}" class="location_form" method="GET">
                @if(request('search'))
                  <input type="hidden" name="search" id="search" value="{{ request('search') }}">
                @endif
                {{-- @foreach ($all_data->unique('provinsi') as $gunung)
                  <div class="location_filter container">
                      <input type ="checkbox" name="location" class="location_name" id="location_name" value="{{$gunung->provinsi}}" @if($location == $gunung->provinsi) checked @endif/>
                      <label for="location">{{$gunung->provinsi}}</label>
                  </div>
                @endforeach --}}
              </form>
            </div>
        </div>
        <div class="container" id="list-element-gunung">
          <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
          {{-- @if($data_gunung->count() == 0)
          <h2 style="text-align:center;">Tidak ada data</h2>
          @else
            @foreach ($data_gunung as $gunung)
            <div class="list-gunung" data-id="{{ $gunung->nama_gunung }}" id="list_gunung" data-aos="fade-up">
                <div class="wrap-list d-flex">
                    <img src="{{asset('images/gunung/'.$gunung->gambar_gunung.'')}}" alt="" class="home_gambar_gunung">
                    <div class="detail" id="detail">
                      <h3>Gunung {{ $gunung->nama_gunung }}</h3>
                      <i class="fas fa-map-marker-alt"></i><a href="{{$gunung->url_gmaps}}" target="_blank" class="location-mount"> {{ $gunung->lokasi }}</a>
                    </div>
                    <div class="detail-other d-flex">
                      <p class="height-mount"><i class="fas fa-mountain"></i> {{$gunung->ketinggian}} MDPL</p>
                      <p class="status-mount">Status : {{$gunung->status}}</p>
                    </div>
                    <a href="{{route('detail.gunung',$gunung->nama_gunung)}}" class="btn-detail-gunung"><i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
            @endforeach
            @endif --}}
        </div>
    </div>
    <div class="Page navigation example">
        <ul class="pagination justify-content-center">
          {{-- @if($data_gunung->lastPage() > 1)
          @if($data_gunung->currentPage() == 1)
          <li class="page-item disabled">
            <a class="page-link" href="">Previous</a>
          </li>
          @else
          <li class=" page-item">
            <a class="page-link" href="{{ $data_gunung->url($data_gunung->currentPage() - 1) }}"">Previous</a>
          </li>
          @endif
          <li class=" page-item active">
                <span class="page-link">
                  {{ $data_gunung->currentPage() }}
                  <span class="sr-only">(current)</span>
                </span>
          </li>
          @if($data_gunung->currentPage() == $data_gunung->lastPage())
          <li class="page-item disabled">
            <a class="page-link" href="{{ $data_gunung->url($data_gunung->lastPage()) }}">Next</a>
          </li>
          @else
          <li class="page-item">
            <a class="page-link" href="{{ $data_gunung->url($data_gunung->currentPage() + 1) }}">Next</a>
          </li>
          @endif
          @endif --}}
        </ul>
      </div>
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
  <script src="{{asset('js/list-gunung.js')}}"></script>
  <script src="{{asset('js/home.js')}}"></script>
@endpush