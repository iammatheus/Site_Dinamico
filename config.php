<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
  $autoload = function($class){
    if($class == 'Email'){
      require_once('classes/Email.php');
    }
    include('classes/'.$class.'.php');
  };
  spl_autoload_register($autoload);

  define('INCLUDE_PATH','http://localhost/Back-End/5%20-%20Projetos/Projeto_01/');
  define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
  define('BASE_DIR_PAINEL',__DIR__.'/painel');
  define('INCLUDE_PATH_USER','http://localhost/Back-End/5%20-%20Projetos/Projeto_01/painel/editar-usuario');

  //Constante para o painel
  define('NOME_EMPRESA','Danki Code');

  //Conectar com o banco de dados.
  define('HOST','localhost');
  define('USER','root');
  define('PASSWORD','');
  define('DATABASE','projeto_01');

  //Funções do painel
  function pegaCargo($indice){
    return Painel::$cargos[$indice];
  }

  function selecionadoMenu($par){
    $url = explode('/',@$_GET['url'])[0];
    if($url == $par){
      echo 'class="menu-active"';
    }
  }

  function verificaPermissaoMenu($permissao){
    if($_SESSION['cargo'] >= $permissao){
      return;
    }else{
      echo 'style="display:none;"';
    }
  }

  function verificaPermissaoPagina($permissao){
    if($_SESSION['cargo'] >= $permissao){
      return;
    }else{
      include('painel/pages/permissao_negada.php');
      die();
    }
  }

  function recoverPost($post){
    if(isset($_POST[$post])){
      echo $_POST[$post];
    }
  }
?>
