<div class="sidebar-left" id="sidebar_left">
    <h2 style="font-weight: 300;"><i class="fas fa-filter"></i> Filters</h2>
    <div class="search-bar">
      <form id="searchform" >
        <div class="input-group rounded">
          @if(request('location'))
          <input type="hidden" name="location" id="location" value="{{ request('location') }}">
          @endif
          <span class="border-0" id="search-addon">
            <button class="btn-search" type="submit"><i class="fas fa-search"></i></button>
          </span>
          <input type="search" class="search-box form-control rounded" placeholder="Search" name="search_input" id="search_input" aria-label="Search"
          aria-describedby="search-addon" value="{{request('search')}}" />
        </div>
      </form>
    </div>
    <h2 class="location-title">Lokasi</h2>
    @include('location_filter_marketplace')
</div>