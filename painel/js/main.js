$(function(){
  var open = true;
  var windowSize = $(window)[0].innerWidth;
  var targetSizeMenu = (windowSize <= 400) ? 200 : 300;
  if(windowSize <= 768){
    $('.menu').css('width','0').css('padding','0');
    open = false;
  }
  $('.menu-btn').click(function(){
    if(open){
      //Menu aberto, precisamos fechar e adaptar o nosso conteúdo geral do painel
      $('.menu').animate({'width':0,'padding':0},function(){
        open = false;
      });
      $('header,.content').css('width','100%');
      $('header,.content').animate({'left':0},function(){
        open = false;
      });
    }else{
      //Menu está fechado.
      $('.menu').css('display','block');
      $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
        open = true;
      });
      if(windowSize > 768)
      $('header,.content').css('width','calc(100% - 300px)');
      $('header,.content').animate({'left':targetSizeMenu+'px'},function(){
        open = true;
      });
    }
  })
  $(window).resize(function(){
    windowSize = $(window)[0].innerWidth;
    targetSizeMenu = (windowSize <= 400) ? 200 : 300;
    if(windowSize <= 768){
      $('.menu').css('width','0').css('padding','0');
      $('header,.content').css('width','100%').css('left','0');
      open = false;
    }else{
      $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
        open = true;
      });
      $('header,.content').css('width','calc(100% - 300px)');
      $('header,.content').animate({'left':targetSizeMenu+'px'},function(){
        open = true;
      });
    }
  });
  $('[actionBtn=delete]').click(function(){
    var txt;
    var r = confirm("Deseja excluir permanentemente?");
    if(r == true){
      return true;
    }else{
      return false;
    }
  });
})
