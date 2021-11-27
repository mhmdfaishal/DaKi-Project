<div class="flex-direction-column" id="list_element_gunung">
  <div class="container">
      <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
      @if($data_gunung->count() == 0)
      <h2 style="text-align:center;">Tidak ada gunung.</h2>
      @else
        @foreach ($data_gunung as $gunung)
        <div class="list-gunung" data-id="{{ $gunung->id }}" id="list_gunung" data-aos="fade-up">
            <div class="wrap-list d-flex">
                <img src="{{asset('images/gunung/'.$gunung->gambar_gunung.'')}}" alt="" class="home_gambar_gunung">
                <div class="detail" id="detail">
                  <h3>Gunung {{ $gunung->nama_gunung }}</h3>
                  <i class="fas fa-map-marker-alt"></i><a href="{{$gunung->url_gmaps}}" target="_blank" class="location-mount"> {{ $gunung->provinsi->nama_provinsi }}</a>
                </div>
                <div class="detail-other d-flex">
                  <p class="height-mount"><i class="fas fa-mountain"></i> {{$gunung->ketinggian}} MDPL</p>
                  <p class="status-mount">Status : {{$gunung->status}}</p>
                </div>
                <a href="{{route('detail.gunung',$gunung->id)}}" class="btn-detail-gunung"><i class="fas fa-chevron-circle-right"></i></a>
            </div>
        </div>
        @endforeach
        @endif
  </div>
  {!! $data_gunung->links() !!}
</div>
