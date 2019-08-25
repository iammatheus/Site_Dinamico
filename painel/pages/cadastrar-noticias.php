<div class="box-content">
  <h2><i class="fas fa-newspaper"></i> Cadastrar Notícias</h2>
  <form method="post" enctype="multipart/form-data">
    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        $categoria_id = $_POST['categoria_id'];
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $capa = $_FILES['capa'];
        $data = $_POST['data'];

        if($titulo == '' || $conteudo == ''){
          Painel::alert('erro','Campos vazios não são permitidos!');
        }else if($capa['tmp_name'] == ''){
          Painel::alert('erro','Selecione uma imagem de capa!');
        }else{
          if(Usuario::imagemValida($capa)){
            $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? ");
            $verifica->execute(array($titulo,$categoria_id));
            if($verifica->rowCount() == 0){
              $imagem = Usuario::uploadImagem($capa);
              $slug = Painel::generateSlug($titulo);
              $arr = [
                'categoria_id'=>$categoria_id,
                'data'=>$data,
                'titulo'=>$titulo,
                'conteudo'=>$conteudo,
                'capa'=>$imagem,
                'slug'=>$slug,
                'order_id'=>'0',
                'nome_tabela'=>'tb_site.noticias'
              ];
              if(Painel::insert($arr)){
                Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticias?sucesso');
              }else{
                Painel::alert('erro','Erro ao cadastrar notícia, tente novamente!');
              }
            }else{
              Painel::alert('erro','Já existe uma notícia com este nome!');
            }
          }else{
            Painel::alert('erro','Selecione uma imagem válida!');
          }
        }
      }
      if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','Notícia cadastrada com sucesso!');
      }
    ?>
    <div class="form-group">
      <label>Categoria:</label>
      <select name="categoria_id">
        <?php
          $categoria = Painel::selectAll('tb_site.categorias');
          foreach ($categoria as $key => $value){
        ?>
        <option <?php if($value['id'] == @$_POST['categoria_id']){echo 'selected';} ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
        <?php } ?>
      </select>
    </div><!--form-group-->

    <div class="form-group">
      <label>Título:</label>
      <input type="text" name="titulo" value="<?php echo recoverPost('titulo'); ?>">
    </div><!--form-group-->

    <div class="form-group">
      <label>Conteúdo:</label>
      <textarea class="tinymce" name="conteudo"><?php echo recoverPost('conteudo'); ?></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <label>Capa:</label>
      <input type="file" name="capa">
    </div><!--form-group-->

    <div class="form-group">
      <label>Data:</label>
      <input type="date" name="data" required value="<?php echo recoverPost('data'); ?>">
    </div><!--form-group-->

    <div class="form-group">
      <input type="hidden" name="order_id" value="0">
      <input type="hidden" name="nome_tabela" value="tb_site.noticias">
      <input class="btnsubmit" type="submit" name="acao" value="Cadastrar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-noticias">Notícias Cadastradas</a>
</div><!--box-content-->
