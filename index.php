<?php
  include('config.php');
  Site::updateUsuarioOnline();
  Site::contador();
?>
<?php
  $infoSite = MySql::conectar()->prepare("SELECT* FROM `tb_site.config`");
  $infoSite->execute();
  $infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title><?php echo $infoSite['titulo']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do site">
    <meta name="keywords" content="palavras,chaves,do,site">
    <meta name="author" content="Matheus Ferreira Siqueira - Designer & Programador">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
  </head>
  <body>

    <base base="<?php echo INCLUDE_PATH; ?>"/>

    <?php
      $url = isset($_GET['url']) ? $_GET['url'] : 'home';
      switch ($url) {
        case 'depoimentos':
          echo '<target target="depoimentos"/>';
          break;

        case 'servicos':
          echo '<target target="servicos"/>';
          break;
      }
    ?>
    <div class="sucesso">Formulário enviado com sucesso!</div>
    <div class="erro">Erro ao enviar formulário.<br>Tente novamente!</div>
    <div class="overlay-loading">
      <img src="<?php echo INCLUDE_PATH; ?>images/ajax-loader.gif">
    </div><!--overlay-loading-->

    <header>
      <div class="center">
        <div class="logo left">Logomarca</div>
        <nav class="desktop right">
          <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
            <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
          </ul>
        </nav><!--desktop-->
        <nav class="mobile right">
          <div class="icon-mobile">
            <i class="fas fa-bars"></i>
          </div><!--icon-mobile-->
          <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
            <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
          </ul>
        </nav><!--mobile-->
        <div class="clear"></div>
      </div><!--center-->
    </header>

    <div class="container-principal">
      <?php
        if(file_exists('pages/'.$url.'.php')){
          include('pages/'.$url.'.php');
        }else{
          if($url != 'depoimentos' && $url != 'servicos'){
            $urlPar = explode('/',$url)[0];
            if($urlPar != 'noticias'){
              $pagina404 = true;
              include('pages/404.php');
            }else{
              include('pages/noticias.php');
            }
          }else{
            include('pages/home.php');
          }
        }
      ?>
    </div><!--container-principal-->


    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"';?>>
      <div class="center">
        <p>&copy; Todos os direitos reservados - <a style="color:white" href="http://www.meuportfolio.ml">Matheus</a></p>
      </div><!--center-->
    </footer>

    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>

    <?php
      if($url == 'contato'){
    ?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
    <?php } ?>

    <?php
      if($url == 'home' || $url == ''){
    ?>
    <script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
    <?php } ?>

    <?php
      if(is_array($url) && strstr($url[0],'noticias') !== false){
    ?>
      <script>
        $(function(){
          $('select').change(function(){
            location.href=include_path+"noticias/"+$(this).val();
          })
        })
      </script>
    <?php
      }
    ?>

  </body>
</html>
