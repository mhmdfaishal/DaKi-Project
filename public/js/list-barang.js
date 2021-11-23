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
function fetch_data(page,id){
    $.get("/fetchbarang?page=" + page +"&id="+id,                                   
        function (data) {
            var newUrl=updateQueryStringParameter(window.location.href,"page",page);
            window.history.pushState("", "Daki", newUrl);
            $('#list-barang').html(data);
    })
    
}

$(document).ready(function(){
      $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        var id = $('#id_toko').val();
        fetch_data(page,id);
      });
      $('#searchform').submit(function(event){
        var search = $('#search_input').val();
        var id = $('#id_toko').val();
        event.preventDefault();
        $.get("/fetchbarang?search=" + search+"&id="+id,                                   
            function (data) {
                var newUrl=updateQueryStringParameter(window.location.href,"search",search.replace(/ /g,"+").toLowerCase());
                window.history.pushState("", "Daki", newUrl);
                console.log(data);
            $('#list-barang').html(data);
        })
      });
});