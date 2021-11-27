<div class="location-filter" id="location-filter">
    <form role="search" id="location_filter" class="location_form" >
      @if(request('search'))
        <input type="hidden" name="search" id="search" value="{{ request('search') }}">
      @endif
      @foreach ($all_data->unique('kotakabupaten') as $toko)
        <div class="location_filter container">
            <input type ="checkbox" name="location" class="location_name" id="location_name" value="{{$toko->kotakabupaten}}" @if(ucwords($location) == $toko->kotakabupaten) checked @endif/>
            <label for="location">{{$toko->kotakabupaten}}</label>
        </div>
      @endforeach
    </form>
</div>