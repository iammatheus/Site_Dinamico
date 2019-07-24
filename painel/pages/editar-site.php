<?php
  $site = Painel::select('tb_site.config',false);
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Configurações do Site</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        if(Painel::update($_POST,true)){
          Painel::alert('sucesso','O site foi editado com sucesso!');
          $site = Painel::select('tb_site.config',false);
        }else{
          Painel::alert('erro','Campos vazios não são permitidos!');
        }
      }
    ?>

    <div class="form-group">
      <label>Titulo do Site:</label>
      <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Nome do Autor:</label>
      <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Descrição do Autor</label>
      <textarea name="descricao" rows="8" cols="80"><?php echo $site['descricao']; ?></textarea>
    </div><!--form-group-->

    <?php for($i=1;$i<=3;$i++){ ?>
    <div class="form-group">
      <label>Ícone<?php echo $i ?></label>
      <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i]; ?>">
    </div><!--form-group-->
    <div class="form-group">
      <label>Descrição do ícone<?php echo $i ?></label>
      <textarea name="descricao<?php echo $i; ?>" rows="8" cols="80"><?php echo $site['descricao'.$i]; ?></textarea>
    </div><!--form-group-->
    <?php } ?>

    <div class="form-group">
      <input type="hidden" name="nome_tabela" value="tb_site.config">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
</div><!--box-content-->
