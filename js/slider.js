$(function(){
  var curSlider = 0;
  var maxSlider = $('.banner-single').length - 1;
  var delay     = 3;
  var banner    = $('.banner-single');


  initSlider();
  changeSlider();

  function initSlider(){
    banner.hide();
    banner.eq(0).show();
    for(var i = 0; i < maxSlider+1 ; i++){
      var content = $('.bullets').html();
      if(i == 0)
        content+='<span class="active-slider"></span>';
      else
        content+='<span></span>';
        $('.bullets').html(content);
    }
  }

  function changeSlider(){
    setInterval(function(){
      banner.eq(curSlider).stop().fadeOut(3000);
      curSlider++;
      if(curSlider > maxSlider)
        curSlider = 0;
      banner.eq(curSlider).stop().fadeIn(3000);
      $('.bullets span').removeClass('active-slider');
      $('.bullets span').eq(curSlider).addClass('active-slider');
    },delay * 1000);
  }

  $('body').on('click','.bullets span',function(){
    var currentBullet = $(this);
    banner.eq(curSlider).stop().fadeOut(1000);
    curSlider = currentBullet.index();
    banner.eq(curSlider).stop().fadeIn(1000);
    $('.bullets span').removeClass('active-slider');
    currentBullet.addClass('active-slider');
  });

});
