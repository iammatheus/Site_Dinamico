<?php
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $depoimento = Painel::select('tb_site.depoimentos','id=?',array($id));
  }else{
    Painel::alert('erro','Você precisa clicar em editar na página: Listar Depoimentos');
    die();
  }
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Depoimentos</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        if(Painel::update($_POST)){
          Painel::alert('sucesso','O depoimento foi editado com sucesso!');
          $depoimento = Painel::select('tb_site.depoimentos','id=?',array($id));
        }else{
          Painel::alert('erro','Campos vazios não são permitidos!');
        }
      }
    ?>

    <div class="form-group">
      <label>Nome da pessoa:</label>
      <input class="nome" type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Depoimento:</label>
      <textarea name="depoimento"><?php echo $depoimento['depoimento']; ?></textarea>
    </div><!--form-group-->
    <div class="form-group">
      <label>Data:</label>
      <input type="date" name="data" value="<?php echo $depoimento['data']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="nome_tabela" value="tb_site.depoimentos">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-depoimentos">Depoimentos Cadastrados</a>
</div><!--box-content-->
