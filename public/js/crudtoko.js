if ($("#form-toko").length > 0) {
  $("#form-toko").validate({
      submitHandler: function (form) {
          let formData = new FormData();
          if( $('#gambar_toko').val !== null) {
            const gambar = $('#gambar_toko').prop('files')[0];
            formData.append('gambar_toko', gambar);
          }
          formData.append('id_toko', $('#id_toko').val());
          formData.append('nama_toko', $('#nama_toko').val());
          formData.append('alamat', $('#alamat').val());
          formData.append('kotakabupaten', $('#kota_kabupaten').val());
          formData.append('url_gmaps', $('#url_gmaps').val());
          formData.append('kontak', $('#kontak').val());
          
          $.ajax({
              url: "/toko/detail/save-detail", 
              data: formData, 
              type: "POST", 
              dataType: 'json', 
              cache: false,
              processData: false,
              contentType: false,
              success: function (data) {  
                  if(typeof(data.error) != "undefined"){
                      iziToast.warning({
                          title: data.error,
                          message: 'Failed',
                          position: 'topRight'
                      });
                  }else{
                      iziToast.success({
                          title: data.message,
                          message: 'Success',
                          position: 'topRight'
                      });
                      setTimeout(function(){
                           location.reload();
                      },
                      500);
                  }
              },
              error: function (data) { le
                  console.log('Error:', data);
              }
          });
      }
  })
}

$(document).on('click', '#delete_button', function(event){
  event.preventDefault(); 
  var id = $(this).data('id');
  $.ajax({
      url: "/toko/delete/"+id, 
      type: "DELETE", 
      dataType: 'json', 
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {  
          if(typeof(data.error) != "undefined"){
              iziToast.warning({
                  title: data.error,
                  message: 'Failed',
                  position: 'topRight'
              });
          }else{
              iziToast.warning({
                  title: data.message,
                  message: 'Success',
                  position: 'topRight'
              });
              setTimeout(function(){
                  location.reload();
              },
              500);
          }
      },
      error: function (data) { le
          console.log('Error:', data);
      }
  });
});