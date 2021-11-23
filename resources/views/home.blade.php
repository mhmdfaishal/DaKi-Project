@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/home.css') }}">
<style>
  .pagination{
    margin-left: 50%;
  }
</style>
@endpush

@section('title', 'Home | Dasbor Pendaki')

@section('main')
<div class="container-fluid header">
  <div class="head-title" data-aos="fade-up">
    <h3>Daftar Gunung</h3>
    <hr class="under-split">
  </div>
</div>
<div class="box-container" id="container_home">
  @include('home_layout')
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
    
</script>
@endpush