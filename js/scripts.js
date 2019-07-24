$(function(){

  $('nav.mobile').click(function(){
    var listaMenu = $('nav.mobile ul');
    var icone = $('.icon-mobile').find('i');

    if(listaMenu.is(':hidden')){
      icone.removeClass('fa-bars');
      icone.addClass('fa-times');
      listaMenu.slideToggle();
    }else{
      icone.removeClass('fa-times');
      icone.addClass('fa-bars');
      listaMenu.slideToggle();
    }
  });

  if($('target').length > 0){
    var elemento = '#'+$('target').attr('target');
    var divScroll = $(elemento).offset().top;
    $('html,body').animate({'scrollTop':divScroll},800);
  }

  carregarDinamico();
  function carregarDinamico(){
    $('[realtime]').click(function(){
      var pagina = $(this).attr('realtime');
      $('.container-principal').load(include_path+'pages/'+pagina+'.php');
      
      initialize();
      addMarker(-27.609959,-48.576585,'',"Minha casa",undefined,true);

      return false;
    });
  }

})
