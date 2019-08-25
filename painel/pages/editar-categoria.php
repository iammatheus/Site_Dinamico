<?php
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $categoria = Painel::select('tb_site.categorias','id=?',array($id));
  }else{
    Painel::alert('erro','Você precisa clicar em editar na página: Listar Categorias');
    die();
  }
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Categoria</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        $slug = Painel::generateSlug($_POST['nome']);
        $arr = array_merge($_POST,array('slug'=>$slug));
        $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? AND id != ?");
        $verificar->execute(array($_POST['nome'],$id));
        if($verificar->rowCount() == 1){
          Painel::alert('erro','Já existe uma categoria com este nome!');
        }else{
          if(Painel::update($arr)){
            Painel::alert('sucesso','A categoria foi editado com sucesso!');
            $categoria = Painel::select('tb_site.categorias','id=?',array($id));
          }else{
            Painel::alert('erro','Campos vazios não são permitidos!');
          }
        }
      }
    ?>

    <div class="form-group">
      <label>Categoria:</label>
      <input type="text" name="nome" value="<?php echo $categoria['nome']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="nome_tabela" value="tb_site.categorias">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-categorias">Categorias Cadastradas</a>
</div><!--box-content-->
