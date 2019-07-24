<?php
  include('../config.php');
  require_once('../classes/Email.php');
  $data = array();
  $assunto = 'Nova mensagem do site!';
  $corpo = '';
  foreach ($_POST as $key => $value) {
    $corpo.="<hr>".ucfirst($key).": ".$value;
  }
  $info = array('assunto'=>$assunto,'corpo'=>$corpo);
  $mail = new Contato('smtp.gmail.com','seuemail','suasenha','seunome');
  $mail->addAdress('email','nome');
  $mail->formatarEmail($info);
  if($mail->enviarEmail()){
    $data['sucesso'] = true;
  }else{
    $data['erro'] = true;
  }
  die(json_encode($data));
?>
