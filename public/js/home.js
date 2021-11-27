$(document).on('click', '#list_gunung', function () {
    var id = $(this).data('id');
    window.location.href = '/home/'+id;
});
// $("input:checkbox").on('click', function() {
//     var $box = $(this);
//     if ($box.is(":checked")) {
//         var group = "input:checkbox[name='" + $box.attr("name") + "']";
//         $(group).prop("checked", false);
//         $box.prop("checked", true);
//     }else {
//         $box.prop("checked", false);
//     }
// });
// $(document).ready(function(){
//     $("#location_filter").on("change", "input:checkbox", function(e){
//         e.preventDefault();
//         $("#location_filter").submit();
//     });
// });