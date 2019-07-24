<?php
  if(isset($_COOKIE['lembrar'])){
    $user = $_COOKIE['user'];
    $password = $_COOKIE['password'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
    $sql->execute(array($user,$password));
    if($sql->rowCount() == 1){
      //Logamos com sucesso e setamos o cookie
      $info = $sql->fetch();
      $_SESSION['login'] = true;
      $_SESSION['user'] = $user;
      $_SESSION['password'] = $password;
      $_SESSION['cargo'] = $info['cargo'];
      $_SESSION['nome'] = $info['nome'];
      $_SESSION['img'] = $info['img'];
      header('Location: '.INCLUDE_PATH_PAINEL);
      die();
    }
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
    <div class="box-login">
    <?php
      if(isset($_POST['acao'])){
        $user = $_POST['user'];
        $password = $_POST['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1){
          $info = $sql->fetch();
          //Logamos com sucesso
          $_SESSION['login'] = true;
          $_SESSION['user'] = $user;
          $_SESSION['password'] = $password;
          $_SESSION['cargo'] = $info['cargo'];
          $_SESSION['nome'] = $info['nome'];
          $_SESSION['img'] = $info['img'];
          if(isset($_POST['lembrar'])){
            setcookie('lembrar',true,time()+(60*60*24), '/');
            setcookie('user',$user,time()+(60*60*24), '/');
            setcookie('password',$password,time()+(60*60*24), '/');
            header('Location: '.INCLUDE_PATH_PAINEL);
            die();
          }
        }else{
          //Login falhou
          echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou Senha incorretos!</div>';
        }
      }

    ?>
      <h2>Efetue o login</h2>
      <form method="post">
        <input type="text" name="user" placeholder="Login">
        <input type="password" name="password" placeholder="Senha">
        <div class="form-group-login left">
          <input class="btnsubmit" type="submit" name="acao" value="Logar!">
        </div><!--form-group-login-->
        <div class="form-group-login right">
          <label for="logar">Lembrar-me</label>
          <input type="checkbox" name="lembrar" id="logar">
        </div><!--form-group-login-->
        <div class="clear"></div>
      </form>
    </div>
  </body>
</html>
