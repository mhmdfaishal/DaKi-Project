$(document).ready(function(){
    $('#follow_button').click(function () {
        var id = $(this).data('id');
        let formData = new FormData();
        formData.append('toko_id', id);
        setTimeout(function(){  
            $.ajax({
                url: "/toko/followunfollow", 
                data: formData, 
                type: "POST", 
                dataType: 'json', 
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {  
                    $('#jumlah_follower').html(data.data);  
                    $('#follow_button').html(data.html);  
                },
                error: function (data) { le
                    console.log('Error:', data);
                }
            });
        },
        100);
    });
});