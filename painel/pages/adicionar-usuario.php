<div class="box-content">
  <h2><i class="fas fa-user-plus"></i> Adicionar Usuários</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        $login = $_POST['login'];
        $nome = $_POST['nome'];
        $password = $_POST['password'];
        $cargo = $_POST['cargo'];
        $imagem = $_FILES['imagem'];

        if($login == ''){
          Painel::alert('erro','O login está vazio.');
        }else if($nome == ''){
          Painel::alert('erro','O nome está vazio.');
        }else if($password == ''){
          Painel::alert('erro','A senha está vazia.');
        }else if($cargo == ''){
          Painel::alert('erro','Defina um cargo!');
        }else if($imagem['name'] == ''){
          Painel::alert('erro','Defina uma imagem!');
        }else{
          if($cargo >= $_SESSION['cargo']){
            Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
          }else if(Usuario::imagemValida($imagem) == false){
            Painel::alert('erro','O formato especificado não está correto!');
          }else if(Usuario::loginExists($login)){
            Painel::alert('erro','O login já existe! Informe outro.');
          }else{
            //Podemos cadastrar
            $usuario = new Usuario();
            $imagem = Usuario::uploadImagem($imagem);
            $usuario->cadastrarUsuario($login,$password,$imagem,$nome,$cargo);
            Painel::redirect(INCLUDE_PATH_PAINEL.'adicionar-usuario?sucesso');
          }
        }
      }
      if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','Usuário cadastrado com sucesso!');
      }
    ?>

    <div class="form-group">
      <label>Login:</label>
      <input class="nome" type="text" name="login" value="<?php echo recoverPost('login'); ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Nome:</label>
      <input class="nome" type="text" name="nome" value="<?php echo recoverPost('nome'); ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Senha:</label>
      <input type="password" name="password" value="<?php echo recoverPost('password'); ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Cargo:</label>
      <select name="cargo" value="<?php echo recoverPost('cargo'); ?>">
        <?php
          foreach (Painel::$cargos as $key => $value) {
            if($key < $_SESSION['cargo'])
              echo '<option value="'.$key.'">'.$value.'</option>';
          }
        ?>
      </select>
    </div><!--form-group-->
    <div class="form-group">
      <label>Imagem:</label>
      <input type="file" name="imagem">
    </div><!--form-group-->
    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Adicionar">
    </div><!--form-group-->
  </form>
</div><!--box-content-->
