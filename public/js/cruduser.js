if ($("#form-profile").length > 0) {
    $("#form-profile").validate({
        submitHandler: function (form) {
            let formData = new FormData();
            
            if($('#new_password').val() != "" && $('#new_password').val() != $('#password_confirm').val()){
                $('#validation_confirm').html('<b style="color:red;">Konfirmasi password harus sama!</b>');
            }else{
                console.log($('#nama_user').val());
                formData.append('nama', $('#nama_user').val());
                formData.append('email', $('#email_user').val());
                formData.append('alamat', $('#alamat_user').val());
                formData.append('password', $('#password_confirm').val());
                
                $.ajax({
                    url: "/pendaki/store", 
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
            
            
        }
    })
}
