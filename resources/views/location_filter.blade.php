<div class="location-filter" id="location-filter">
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