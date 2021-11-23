@extends('layout_marketplace')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/marketplace.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush

@section('title', 'Marketplace | Dasbor Pendaki')

@section('main')
<div class="container-fluid p-0 header">
  <div class="site-slider">
    <div class="slider-one">
      <div class="banner1">
        <img src="/images/marketplace/Carrier-Marketplace.jpg" class="img-fluid" alt="Banner1">
      </div>
      <div class="banner2">
        <img src="/images/marketplace/Cooking-Set-Marketplace.jpg" class="img-fluid" alt="Banner2">
      </div>
      <div class="banner3">
        <img src="/images/marketplace/Shoe-Marketplace.jpg" class="img-fluid" alt="Banner3">
      </div>
      <div class="banner4">
        <img src="/images/marketplace/Tent-Marketplace.jpg" class="img-fluid" alt="Banner4">
      </div>
    </div>
    <div class="slider-btn">
      <span class="prev position-top">
        <i class="fas fa-chevron-left"></i>
      </span>
      <span class="next position-top right-0">
        <i class="fas fa-chevron-right"></i>
      </span>
    </div>
  </div>
</div>
<div class="box-container" id="container_home">
    <div class="head-title" data-aos="fade-up">
      <h3>Daftar Toko</h3>
      <hr class="under-split">
    </div>
    @include('marketplace_layout')
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="{{asset('js/marketplace.js')}}"></script>
  <script src="{{asset('js/list-marketplace.js')}}"></script>
@endpush