<?php
  if(isset($_GET['logout'])){
    Painel::logout();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Painel de Controle</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css">
  </head>
  <body>
    <div class="menu">
      <div class="menu-wraper">
        <div class="box-usuario">
          <?php
            if($_SESSION['img'] == ''){
          ?>
          <div class="avatar-usuario">
            <i class="fa fa-user"></i>
          </div><!--avatar-usuario-->
        <?php }else{ ?>
          <div class="imagem-usuario">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>"/>
          </div><!--imagem-usuario-->
        <?php } ?>
          <div class="nome-usuario">
            <p><?php echo $_SESSION['nome']; ?></p>
            <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
          </div><!--nome-usuario-->
        </div><!--box-usuario-->
        <div class="items-menu">
          <h2>Cadastro</h2>
          <a <?php selecionadoMenu('cadastrar-depoimentos'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimentos">Cadastrar Depoimentos</a>
          <a <?php selecionadoMenu('cadastrar-servicos'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servicos">Cadastrar Serviços</a>
          <a <?php selecionadoMenu('cadastrar-slides'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
          <h2>Gestão</h2>
          <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
          <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
          <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
          <h2>Gestão de Notícias</h2>
          <a <?php selecionadoMenu('cadastrar-categorias'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
          <a <?php selecionadoMenu('listar-categorias'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-categorias">Listar Categorias</a>
          <a <?php selecionadoMenu('cadastrar-noticias'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticias">Cadastrar Notícias</a>
          <a <?php selecionadoMenu('listar-noticias'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-noticias">Listar Notícias</a>
          <h2>Administração do Painel</h2>
          <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
          <a <?php selecionadoMenu('adicionar-usuario'); verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuários</a>
          <h2>Configuração Geral</h2>
          <a <?php selecionadoMenu('editar-site'); verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
        </div><!--items-menu-->
      </div><!--menu-wraper-->
    </div><!--menu-->

    <header>
      <div class="center">
        <div class="menu-btn">
          <i class="fa fa-bars"></i>
        </div><!--menu-btn-->
        <div class="logout">
          <a <?php if(@$_GET['url'] == ''){ ?> style="background:#60727a;padding:15px; <?php } ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fas fa-home"></i> Página Inicial</a>
          <div style="padding: 0 10px;display:inline;"></div>
          <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </div><!--logout-->
        <div class="clear"></div>
      </div><!--center-->
    </header>
    <div class="content">
      <?php Painel::carregarPagina(); ?>
    </div><!--content-->

  <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector:'.tinymce',
      plugins:'image',
      height: 400
    });
  </script>
  </body>
  </html>
