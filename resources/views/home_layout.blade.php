<div class="body-content d-flex">
    <div class="sidebar-left">
        <h2 style="font-weight: 300;"><i class="fas fa-filter"></i> Filters</h2>
        <div class="search-bar">
          <form id="searchform">
            <div class="input-group rounded">
              @if(request('location'))
              <input type="hidden" name="location" id="location" value="{{ strtolower(request('location')) }}">
              @endif
              <span class="border-0" id="search-addon">
                <button type="button" class="btn-search" id="button_search"><i class="fas fa-search"></i></button>
              </span>
              <input type="text" class="search-box form-control rounded" placeholder="Search" id="search_input" name="search" aria-label="Search"
              aria-describedby="search-addon" value="{{request('search')}}" />
            </div>
          </form>
        </div>
        <h2 class="location-title">Lokasi</h2>
        <div class="location-filter">
          <form role="search" id="location_filter" class="location_form" >
            @if(request('search'))
              <input type="hidden" name="search" id="search" value="{{ request('search') }}">
            @endif
            @foreach ($all_data->unique('provinsi_id') as $gunung)
              <div class="location_filter container">
                  <input type ="checkbox" name="location" class="location_name" id="location_name" value="{{$gunung->provinsi_id}}" @if(ucwords($location) == $gunung->provinsi_id) checked @endif/>
                  <label for="location">{{$gunung->provinsi->nama_provinsi}}</label>
              </div>
            @endforeach
          </form>
        </div>
    </div>
    <div class="container" id="list_element_gunung">
      <input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">
      @if($data_gunung->count() == 0)
      <h2 style="text-align:center;">Tidak ada data</h2>
      @else
        @foreach ($data_gunung as $gunung)
        <div class="list-gunung" data-id="{{ $gunung->nama_gunung }}" id="list_gunung" data-aos="fade-up">
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
                <a href="{{route('detail.gunung',$gunung->nama_gunung)}}" class="btn-detail-gunung"><i class="fas fa-chevron-circle-right"></i></a>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
{!! $data_gunung->links() !!}