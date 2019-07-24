<?php
  include('../config.php');

  if(Painel::logado() == false) {
    include('login.php');
  }else{
    include('main.php');
  }
?>
