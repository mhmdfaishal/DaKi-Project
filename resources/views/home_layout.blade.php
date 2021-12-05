<div class="flex-direction-column" id="list_element_gunung">
  <div class="container">
      <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
      @if($data_gunung->count() == 0)
      <h2 style="text-align:center;">Tidak ada gunung.</h2>
      @else
        @foreach ($data_gunung as $gunung)
        <div class="list-gunung" data-id="{{ $gunung->id }}" id="list_gunung" data-aos="fade-up">
            <div class="wrap-list d-flex">
                <img src="{{asset('storage/images/gunung/'.$gunung->gambar_gunung.'')}}" alt="" class="home_gambar_gunung">
                <div class="detail" id="detail">
                  <h3>Gunung {{ $gunung->nama_gunung }}</h3>
                  <i class="fas fa-map-marker-alt"></i><a href="{{$gunung->url_gmaps}}" target="_blank" class="location-mount"> {{ $gunung->provinsi->nama_provinsi }}</a>
                </div>
                <div class="detail-other d-flex justify-content-center">
                  <p class="height-mount"><i class="fas fa-mountain"></i> {{$gunung->ketinggian}} MDPL</p>
                  @if($gunung->cuaca == 0)
                  <p class="weather-mount"><i class="fas fa-cloud"></i>  : <i class="fas fa-cloud-sun"></i><br/><span>(Cerah)</span></p>
                  @elseif($gunung->cuaca == 1)
                  <p class="weather-mount"><i class="fas fa-cloud"></i>  : <i class="fas fa-cloud-sun-rain"></i><br/><span>(Terkadang hujan)</span></p>
                  @elseif($gunung->cuaca == 2)
                  <p class="weather-mount"><i class="fas fa-cloud"></i>  : <i class="fas fa-cloud-showers-heavy"></i><br/><span>(Sering hujan)</span></p>
                  @elseif($gunung->cuaca == 3)
                  <p class="weather-mount"><i class="fas fa-cloud"></i>  : <i class="fas fa-house-damage"></i><br/><span>(Bencana Alam)</span></p>
                  @endif
                  @if($gunung->status == 0)
                  <p class="status-mount">Status : Buka</p>
                  @elseif($gunung->status == 1)
                  <p class="status-mount">Status : Tutup</p>
                  @endif
                </div>
                <a href="{{route('detail.gunung',$gunung->id)}}" class="btn-detail-gunung"><i class="fas fa-chevron-circle-right"></i></a>
            </div>
        </div>
        @endforeach
        @endif
  </div>
  {!! $data_gunung->links() !!}
</div>
