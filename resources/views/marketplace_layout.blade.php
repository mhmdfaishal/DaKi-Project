<div class="list-element-toko flex-direction-column" id="list_element_toko">
  <div class="container">
    <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
    @if($data_toko->count() == 0)
    <h2 style="text-align:center;">Tidak ada toko</h2>
    @else
      @foreach ($data_toko as $toko)
      <div class="list-toko" data-id="{{ str_replace(' ', '-', strtolower($toko->nama_toko)) }}" id="list_toko" data-aos="fade-up">
          <div class="wrap-list d-flex">
              <img src="{{asset('storage/images/toko/'.$toko->logo_toko)}}" alt="" class="home_gambar_toko">
              <div class="detail" id="detail">
                <h3>{{ $toko->nama_toko }}</h3>
                <i class="fas fa-map-marker-alt"></i><a href="{{$toko->url_gmaps}}" target="_blank" class="location-mount"> {{ $toko->kotakabupaten }}</a>
              </div>
              <div class="detail-other d-flex">
                <p class="jumlah-barang"><i class="fas fa-box"></i> {{$toko->barang->count()}} Barang</p>
                <p class="rating-toko"><i class="far fa-star"></i> {{$toko->rating}}</p>
              </div>
              <a href="{{route('detail.toko',str_replace(' ', '-', strtolower($toko->nama_toko)) )}}" class="btn-detail-toko"><i class="fas fa-chevron-circle-right"></i></a>
          </div>
      </div>
      @endforeach
      @endif
  </div>
  {!! $data_toko->links() !!}
</div>