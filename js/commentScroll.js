    $('[href^="#comment"]').on('click', function(){
    let href = $(this).attr('href'), elem = $(document).find(href);
    if(elem.length > 0) {
    let posY = elem.eq(0).offset().top;
    $('html, body').animate({
    scrollTop: posY
}, 1000);
}
    return false;
});


