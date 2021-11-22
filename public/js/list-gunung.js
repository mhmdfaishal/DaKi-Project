const params = new URLSearchParams(window.location.search);
    
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
  if(params.has('location')){
    $.get("/fetchgunung?page=" + page +"&location="+params.get('location'),                                   
      function (data) {
        var newUrl=updateQueryStringParameter(window.location.href,"page",page);
        window.history.pushState("", "Daki", newUrl);
        $('#container_home').html(data);
    })
  }else{
    $.get("/fetchgunung?page=" + page,                                   
        function (data) {
          var newUrl=updateQueryStringParameter(window.location.href,"page",page);
          window.history.pushState("", "Daki", newUrl);
          $('#container_home').html(data);
    })
  }
}

$(document).ready(function(){
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
          if(params.has('search')){
            $.get("/fetchgunung?location=&search="+params.get('search'),
            function (data) {
              var newUrl=updateQueryStringParameter(window.location.href,"location","");
              window.history.pushState("", "Daki", newUrl);
              var newUrl=updateQueryStringParameter(window.location.href,"page","");
              window.history.pushState("", "Daki", newUrl);
              $('#container_home').html(data);
            })
          }else{
            $.get("/fetchgunung?location=",
              function (data) {
                var newUrl=updateQueryStringParameter(window.location.href,"location","");
                window.history.pushState("", "Daki", newUrl);
                var newUrl=updateQueryStringParameter(window.location.href,"page","");
                window.history.pushState("", "Daki", newUrl);
                $('#container_home').html(data);
            })
          }
        }else{
          if(params.has('search')){
            $.get("/fetchgunung?location="+location+"&search="+params.get('search'),                                   
              function (data) {
                var newUrl=updateQueryStringParameter(window.location.href,"location",location);
                window.history.pushState("", "Daki", newUrl);
                var newUrl=updateQueryStringParameter(window.location.href,"page","");
                window.history.pushState("", "Daki", newUrl);
                $('#container_home').html(data);
            })
          }else{
            $.get("/fetchgunung?location="+location,                                   
                function (data) {
                  var newUrl=updateQueryStringParameter(window.location.href,"location",location);
                  window.history.pushState("", "Daki", newUrl);
                  var newUrl=updateQueryStringParameter(window.location.href,"page","");
                  window.history.pushState("", "Daki", newUrl);
                  $('#container_home').html(data);
            })
          }
        }
      });
      // $(document).on('click', '#button_search', function(event){
      //   var search = $('#search_input').val();
      //   event.preventDefault();
      //   if(params.has('location')){
      //     event.preventDefault();
      //     $.get("/fetchgunung?location="+params.get('location')+"&search=" + search,                                   
      //       function (data) {
      //         var newUrl=updateQueryStringParameter(window.location.href,"search",search.replace(/ /g,"+").toLowerCase());
      //         window.history.pushState("", "Daki", newUrl);
      //         $('#container_home').html(data);
      //     })
      //   }else{
      //     event.preventDefault();
      //     $.get("/fetchgunung?search=" + search,                                   
      //         function (data) {
      //           var newUrl=updateQueryStringParameter(window.location.href,"search",search.replace(/ /g,"+").toLowerCase());
      //           window.history.pushState("", "Daki", newUrl);
      //           $('#container_home').html(data);
      //     })
      //   }
      // });
});