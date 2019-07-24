<div class="box-content">
  <h2><i class="fas fa-user-edit"></i> Editar Usuário</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      if(isset($_POST['acao'])){
        //Enviei meu formulário.
        $usuario = new Usuario();
        $nome = $_POST['nome'];
        $password = $_POST['password'];
        $imagem = $_FILES['imagem'];
        $imagem_atual = $_POST['imagem_atual'];
        if($imagem['name'] != ''){
          //Existe upload de imagem
          if(Usuario::imagemValida($imagem)){
            Usuario::deletarImagem($imagem_atual);
            $imagem = Usuario::uploadImagem($imagem);
            if($usuario->atualizarUsuario($nome,$password,$imagem)){
              $_SESSION['img'] = $imagem;
              Painel::alert('sucesso','Atualizado com sucesso!');
            }else{
              Painel::alert('erro','Ocorreu um erro ao atualizar as informações.');
            }
          }else{
            Painel::alert('erro','Formato de imagem inválido.');
          }
        }else{
          $imagem = $imagem_atual;
          if($usuario->atualizarUsuario($nome,$password,$imagem)){
            Painel::alert('sucesso','Atualizado com sucesso!');
          }else{
            $imagem = $imagem_atual;
            if($usuario->atualizarUsuario($nome,$password,$imagem)){
              Painel::alert('sucesso','Atualizado com sucesso!');
            }else{
              Painel::alert('erro','Ocorreu um erro ao atualizar as informações.');
            }
          }
        }
      }
    ?>

    <div class="form-group">
      <label>Nome:</label>
      <input class="nome" type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Senha</label>
      <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Imagem:</label>
      <input type="file" name="imagem">
      <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
</div><!--box-content-->
