const params = new URLSearchParams(window.location.search);
var search_value = "";
var location_value = "";
function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}
function fetch_data(page){
  var newUrl=updateQueryStringParameter(window.location.href,"page",page);
  window.history.pushState("", "Daki", newUrl);

  if(location_value != ""){
    $.get("/fetchlocation?location="+location_value,                                   
      function (data) {
        $('#location-filter').html(data);
    })
    $.get("/fetchgunung?page=" + page +"&location="+location_value,                                   
      function (data) {
        $('#list_element_gunung').html(data);
    })
  }else{
    $.get("/fetchgunung?page=" + page,                                   
        function (data) {
          $('#list_element_gunung').html(data);
    })
  }
}

$(document).ready(function(){
      if(params.has('location')){
        location_value = params.get('location');
      }
      if(params.has('search')){
        search_value = params.get('search');
      }

      $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
      });

      $(document).on('click', '#location_name', function(event){
        event.preventDefault(); 
        var location = $(this).val();
        
        if($(this)[0].hasAttribute("checked")){
          $(this).removeAttr('checked');
          location_value = "";
          var newUrl=updateQueryStringParameter(window.location.href,"location","");
          window.history.pushState("", "Daki", newUrl);
          var newUrl=updateQueryStringParameter(window.location.href,"search",search_value.replace(/ /g,"+").toLowerCase());
          window.history.pushState("", "Daki", newUrl);
          var newUrl=updateQueryStringParameter(window.location.href,"page","");
          window.history.pushState("", "Daki", newUrl);

          if(search_value != ""){
            $.get("/fetchlocation?location=",
            function (data) {
              $('#location-filter').html(data);
            })

            $.get("/fetchgunung?location=&search="+search_value,
            function (data) {
              $('#list_element_gunung').html(data);
            })
          }else{
            $.get("/fetchlocation?location=",
              function (data) {
                $('#location-filter').html(data);
            })
            $.get("/fetchgunung?location=",
              function (data) {
                $('#list_element_gunung').html(data);
            })
          }
        }else{
          location_value = location;

          var newUrl=updateQueryStringParameter(window.location.href,"location",location);
          window.history.pushState("", "Daki", newUrl);
          var newUrl=updateQueryStringParameter(window.location.href,"search",search_value.replace(/ /g,"+").toLowerCase());
          window.history.pushState("", "Daki", newUrl);
          var newUrl=updateQueryStringParameter(window.location.href,"page","");
          window.history.pushState("", "Daki", newUrl);

          if(search_value != ""){
            $.get("/fetchlocation?location="+location,                                   
              function (data) {
                $('#location-filter').html(data);
            })
            $.get("/fetchgunung?location="+location+"&search="+search_value,                                   
              function (data) {
                $('#list_element_gunung').html(data);
            })
          }else{
            $.get("/fetchlocation?location="+location,                                   
                function (data) {
                  $('#location-filter').html(data);
            })
            $.get("/fetchgunung?location="+location,                                   
                function (data) {
                  $('#list_element_gunung').html(data);
            })
          }
        }
      });
      $('#searchform').submit(function(event){
        var search = $('#search_input').val();
        event.preventDefault();
        search_value = search;
        
        var newUrl=updateQueryStringParameter(window.location.href,"search",search.replace(/ /g,"+").toLowerCase());
        window.history.pushState("", "Daki", newUrl);
        var newUrl=updateQueryStringParameter(window.location.href,"location",location_value.replace(/ /g,"+").toLowerCase());
        window.history.pushState("", "Daki", newUrl);

        if(location_value != ""){
          event.preventDefault();
          $.get("/fetchgunung?location="+location_value+"&search=" + search,                                   
            function (data) {
              $('#list_element_gunung').html(data);
          })
        }else{
          event.preventDefault();
          $.get("/fetchgunung?search=" + search,                                   
              function (data) {
                $('#list_element_gunung').html(data);
          })
        }
      });
});