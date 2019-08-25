<?php
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $slide = Painel::select('tb_sites.slides','id=?',array($id));
  }else{
    Painel::alert('erro','Você precisa clicar em editar na página: Listar Slides');
    die();
  }
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Slide</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      if(isset($_POST['acao'])){
        //Enviei meu formulário.
        $nome = $_POST['nome'];
        $imagem = $_FILES['imagem'];
        $imagem_atual = $_POST['imagem_atual'];
        if($imagem['name'] != ''){
          //Existe upload de imagem
          if(Usuario::imagemValida($imagem)){
            Usuario::deletarImagem($imagem_atual);
            $imagem = Usuario::uploadImagem($imagem);
            $arr = ['nome'=>$nome, 'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_sites.slides'];
            Painel::update($arr);
            $slide = Painel::select('tb_sites.slides','id=?',array($id));
            Painel::alert('sucesso','O slide foi editado junto com a imagem!');
          }else{
            Painel::alert('erro','Formato de imagem inválido.');
          }
        }else{
          $imagem = $imagem_atual;
          $arr = ['nome'=>$nome, 'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_sites.slides'];
          Painel::update($arr);
          $slide = Painel::select('tb_sites.slides','id=?',array($id));
          Painel::alert('sucesso','O slide foi editado com sucesso!');
        }
      }
    ?>

    <div class="form-group">
      <label>Nome:</label>
      <input class="nome" type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Imagem:</label>
      <input type="file" name="imagem">
      <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-slides">Slides Cadastrados</a>
</div><!--box-content-->
