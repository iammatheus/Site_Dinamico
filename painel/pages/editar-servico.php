<?php
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $servicos = Painel::select('tb_site.servicos','id=?',array($id));
  }else{
    Painel::alert('erro','Você precisa clicar em editar na página: Listar Serviços');
    die();
  }
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Serviços</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        if(Painel::update($_POST)){
          Painel::alert('sucesso','O serviço foi editado com sucesso!');
          $servicos = Painel::select('tb_site.servicos','id=?',array($id));
        }else{
          Painel::alert('erro','Campos vazios não são permitidos!');
        }
      }
    ?>

    <div class="form-group">
      <label>Serviço:</label>
      <textarea name="servico"><?php echo $servicos['servico']; ?></textarea>
    </div><!--form-group-->
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="nome_tabela" value="tb_site.servicos">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-servicos">Serviços Cadastrados</a>
</div><!--box-content-->
