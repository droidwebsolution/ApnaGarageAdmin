$(document).on('click','.close_pop_up',function(){
    $('.details_open').removeAttr("open");
});
$(document).on('click','.pop_up_cancel',function(){
    $('.details_open').removeAttr("open");
});
$('.bar').click(function(){
    $('.sidebar').css("left","0px")
    $('#container').css("padding-left","245px");
})
$('.menu_close').click(function(){
    $('.sidebar').css("left","-225px");
    $('#container').css("padding-left","20px");

})