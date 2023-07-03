$(document).on('click','.close_pop_up,.close_submit',function(){
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