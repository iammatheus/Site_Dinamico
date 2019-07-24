<?php
require_once("phpmailer/src-phpmailer/PHPMailer.php");
require_once("phpmailer/src-phpmailer/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;

class Contato{

  private $mailer;

  public function __construct($host,$username,$password,$name){

    $this->mailer = new PHPMailer;

    $this->mailer->IsSMTP();
    $this->mailer->Mailer = 'smtp';
    $this->mailer->Host = $host;
    $this->mailer->SMTPAuth = true;
    $this->mailer->Port = 465;
    $this->mailer->SMTPSecure = 'ssl';
    $this->mailer->Username = $username;
    $this->mailer->Password = $password;
    $this->mailer->setFrom($username,$name);
    $this->mailer->IsHTML(true); // Define que o e-mail será enviado como HTML
    $this->mailer->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

  }

  function addAddress($email,$nome){
    $this->mailer->addAddress($email,$nome);
  }
  function formatarEmail($info){
    $this->mailer->Subject  = $info['assunto'];
    $this->mailer->Body     = $info['corpo'];
    $this->mailer->AltBody  = strip_tags($info['corpo']);
  }
  function enviarEmail(){
    if($this->mailer->send()){
      return true;
    }else{
      return false;
    }
  }
}
