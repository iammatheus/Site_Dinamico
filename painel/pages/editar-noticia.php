<?php
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $noticia = Painel::select('tb_site.noticias','id=?',array($id));
  }else{
    Painel::alert('erro','Você precisa clicar em editar na página: Listar Notícias');
    die();
  }
?>
<div class="box-content">
  <h2><i class="fas fa-edit"></i> Editar Notícia</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      if(isset($_POST['acao'])){
        //Enviei meu formulário.
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $capa = $_FILES['capa'];
        $data = $_POST['data'];
        $capa_atual = $_POST['capa_atual'];
        $categoria_id = $_POST['categoria_id'];
        $verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
        $verifica->execute(array($titulo,$categoria_id,$id));
        if($verifica->rowCount() == 0){
          if($capa['name'] != ''){
            //Existe upload de imagem
            if(Usuario::imagemValida($capa)){
              Usuario::deletarImagem($capa_atual);
              $capa = Usuario::uploadImagem($capa);
              $slug = Painel::generateSlug($titulo);
              $arr = [
                'id'=>$id,
                'titulo'=>$titulo,
                'conteudo'=>$conteudo,
                'capa'=>$capa,
                'data'=>$data,
                'categoria_id'=>$categoria_id,
                'slug'=>$slug,
                'nome_tabela'=>'tb_site.noticias'
              ];
              Painel::update($arr);
              $slide = Painel::select('tb_site.noticias','id=?',array($id));
              Painel::alert('sucesso','A notícia foi editada junto com a imagem!');
            }else{
              Painel::alert('erro','Formato de imagem inválido.');
            }
          }else{
            $capa = $capa_atual;
            $slug = Painel::generateSlug($titulo);
            $arr = [
              'id'=>$id,
              'titulo'=>$titulo,
              'conteudo'=>$conteudo,
              'capa'=>$capa,
              'data'=>$data,
              'categoria_id'=>$categoria_id,
              'slug'=>$slug,
              'nome_tabela'=>'tb_site.noticias'
            ];
            Painel::update($arr);
            $noticia = Painel::select('tb_site.noticias','id=?',array($id));
            Painel::alert('sucesso','A notícia foi editada com sucesso!');
          }
        }else{
          Painel::alert('erro','Já existe uma notícia com este nome!');
        }
      }
    ?>
    <div class="form-group">
      <label>Categoria:</label>
      <select name="categoria_id">
        <?php
          $categoria = Painel::selectAll('tb_site.categorias');
          foreach ($categoria as $key => $value){
        ?>
        <option <?php if($value['id'] == $noticia['categoria_id']){echo 'selected';} ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
        <?php } ?>
      </select>
    </div><!--form-grou-->

    <div class="form-group">
      <label>Título:</label>
      <input type="text" name="titulo" required value="<?php echo $noticia['titulo']; ?>">
    </div><!--form-group-->

    <div class="form-group">
      <label>Conteúdo:</label>
      <textarea class="tinymce" name="conteudo" required ><?php echo $noticia['conteudo']; ?></textarea>
    </div><!--form-group-->

    <div class="form-group">
      <label>Imagem:</label>
      <input type="file" name="capa">
      <input type="hidden" name="capa_atual" value="<?php echo $noticia['capa']; ?>">
    </div><!--form-group-->

    <div class="form-group">
      <label>Data:</label>
      <input type="date" name="data" required value="<?php echo $noticia['data']; ?>">
    </div><!--form-group-->

    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Atualizar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-noticias">Notícias Cadastradas</a>
</div><!--box-content-->
