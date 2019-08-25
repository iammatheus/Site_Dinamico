<?php
  include('../config.php');
  require_once("../classes/Email.php");
  $data = array();
  $assunto = 'Nova mensagem do site!';
  $corpo = '';
  foreach ($_POST as $key => $value) {
    $corpo.="<hr>".ucfirst($key).": ".$value;
  }
  $info = array('assunto'=>$assunto,'corpo'=>$corpo);
  $mail = new Email('smtp.gmail.com','mohammendkang1406@gmail.com','123456789mo','Matheus');
  $mail->addAddress('mohammendkang1406@gmail.com','Matheus');
  $mail->formatarEmail($info);
  if($mail->enviarEmail()){
    $data['sucesso'] = true;
  }else{
    $data['erro'] = true;
  }
  die(json_encode($data));
?>
