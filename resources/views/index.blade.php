@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
@endpush

@section('title', 'DaKi | Dasbor Pendaki')

@section('main')
    <div class="container-fluid header-jumbotron">
        <div class="row">
            <div class="col">
                <h1 class="h1 display-6" data-aos="fade-up">Teman Mendaki Untuk Para<span id="pendaki"> Pendaki&nbsp;</span></h1>
            </div>
            <div class="col">
                <div>
                    <img class="img-fluid" src="{{asset('images/LandingPage.png') }}" alt="LandingPage" data-aos="fade-up">
                </div>
            </div>
        </div>
        <a href="#content-ld-pg" data-aos="fade-up" data-aos-duration="9000">
            <div class="row cf" id="scrolldown">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill ="#C9DB43"class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
        </a>
    </div>
    <div class="container-content" id="content-ld-pg">
        <div class="container content-ld-pg">
            <h1 class="title-daftar-gunung" data-aos="fade-up">Daftar Gunung</h1>
            <hr data-aos="fade-up" />
            <div class="card-gunung d-flex">
                    @if(isset($data_gunung[1]))
                    <div class="card card-left" data-aos="fade-up" data-aos-duration="5000">
                        <a href="{{route('detail.gunung',$data_gunung[1]->id)}}"><img class="card-img-top" src="{{asset('storage/images/gunung/'.$data_gunung[1]->gambar_gunung.'')}}" alt="Card image cap"></a>
                        <div class="card-body">
                          <p class="card-text"><a href="{{route('detail.gunung',$data_gunung[1]->id)}}" style="color:black;">{{$data_gunung[1]->nama_gunung}}</a></p>
                        </div>
                    </div>
                    @else
                    <div class="card card-left">
                        <a href="/home"><img class="card-img-top" src="{{asset('images/logo6.png')}}" alt="Card image cap">
                        <div class="card-body">
                          <p class="card-text"><a href="/home">Gunung</a></p>
                        </div>
                    </div>
                    @endif
                    @if(isset($data_gunung[0]))
                    <div class="card card-mid" data-aos="fade-up" data-aos-duration="4000">
                        <a href="{{route('detail.gunung',$data_gunung[0]->id)}}"><img class="card-img-top" src="{{asset('storage/images/gunung/'.$data_gunung[0]->gambar_gunung.'')}}" alt="Card image cap"></a>
                        <div class="card-body">
                          <p class="card-text"><a href="{{route('detail.gunung',$data_gunung[0]->id)}}" style="color:black;">{{$data_gunung[0]->nama_gunung}}</a></p>
                        </div>
                    </div>
                    @else
                    <div class="card card-left">
                        <a href="/home"><img class="card-img-top" src="{{asset('images/logo6.png')}}" alt="Card image cap">
                        <div class="card-body">
                          <p class="card-text"><a href="/home">Gunung</a></p>
                        </div>
                    </div>
                    @endif
                    @if(isset($data_gunung[2]))
                    <div class="card card-right" data-aos="fade-up" data-aos-duration="5000">
                        <a href="{{route('detail.gunung',$data_gunung[2]->id)}}"><img class="card-img-top" src="{{asset('storage/images/gunung/'.$data_gunung[2]->gambar_gunung.'')}}" alt="Card image cap"></a>
                        <div class="card-body">
                          <p class="card-text"><a href="{{route('detail.gunung',$data_gunung[2]->id)}}" style="color:black;">{{$data_gunung[2]->nama_gunung}}</a></p>
                        </div>
                    </div>
                    @else
                    <div class="card card-left">
                        <a href="/home"><img class="card-img-top" src="{{asset('images/logo6.png')}}" alt="Card image cap">
                        <div class="card-body">
                          <p class="card-text"><a href="/home">Gunung</a></p>
                        </div>
                    </div>
                    @endif
            </div>
            <div class="look-more" data-aos="fade-up" data-aos-duration="5000">
                <a href="/home">
                    Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection