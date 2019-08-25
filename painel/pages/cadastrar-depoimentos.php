<div class="box-content">
  <h2><i class="fas fa-pen-alt"></i> Cadastrar Depoimentos</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        if(Painel::insert($_POST)){
          Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-depoimentos?sucesso');
        }else{
          Painel::alert('erro','Campos vazios não são permitidos!');
        }
      }
      if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','Depoimento cadastrado com sucesso!');
      }
    ?>

    <div class="form-group">
      <label>Nome da pessoa:</label>
      <input class="nome" type="text" name="nome" value="<?php recoverPost('nome'); ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Depoimento:</label>
      <textarea name="depoimento"><?php recoverPost('depoimento'); ?></textarea>
    </div><!--form-group-->
    <div class="form-group">
      <label>Data:</label>
      <input type="date" name="data" value="<?php recoverPost('data'); ?>">
    </div><!--form-group-->
    <div class="form-group">
      <input type="hidden" name="order_id" value="0">
      <input type="hidden" name="nome_tabela" value="tb_site.depoimentos">
      <input class="btnsubmit" type="submit" name="acao" value="Cadastrar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-depoimentos">Depoimentos Cadastrados</a>
</div><!--box-content-->
