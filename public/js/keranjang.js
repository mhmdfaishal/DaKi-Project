var id = $('#id_barang').val();

// if ($("#form-cart-"+id).length > 0) {
//   $("#form-cart-"+id).submit(function(event){
//     let formData = new FormData();
//     event.preventDefault();
//     formData.append('id_barang', $('#id_barang').val());
//     formData.append('quantity', $('#quantity').val());
//     $.ajax({
//         url: "/keranjang/add", 
//         data: formData, 
//         type: "POST", 
//         dataType: 'json', 
//         cache: false,
//         processData: false,
//         contentType: false,
//         success: function (data) {  
//             if(typeof(data.error) != "undefined"){
//                 iziToast.warning({
//                     title: data.error,
//                     message: 'Failed',
//                     position: 'topRight'
//                 });
//             }else{
//                 iziToast.success({
//                     title: data.message,
//                     message: 'Success',
//                     position: 'topRight'
//                 });
//             }
//         },
//         error: function (data) { le
//             console.log('Error:', data);
//         }
//     });
//   })
// };

$('.cart-btn').click(function(event){
  event.preventDefault();
  var id = $(this).data('id');
  
  let formData = new FormData();
  event.preventDefault();
  formData.append('id_barang', id);
  formData.append('quantity', $('#quantity-'+id).val());
  $.ajax({
      url: "/keranjang/add", 
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
          }
      },
      error: function (data) { le
          console.log('Error:', data);
      }
  });
})