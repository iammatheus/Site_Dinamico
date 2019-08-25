<div class="box-content">
  <h2><i class="fas fa-file-image"></i> Cadastrar Slides</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        $nome = $_POST['nome'];
        $imagem = $_FILES['imagem'];

        if($nome == ''){
          Painel::alert('erro','O campo nome não pode ficar vazio.');
        }else{
          if(Usuario::imagemValida($imagem) == false){
            Painel::alert('erro','O formato especificado não está correto!');
          }else{
            //Podemos cadastrar
            $imagem = Usuario::uploadImagem($imagem);
            $arr = ['nome'=>$nome, 'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_sites.slides'];
            Painel::insert($arr);
            Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-slides?sucesso');
          }
        }
      }
      if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
        Painel::alert('sucesso','Slide cadastrado com sucesso!');
      }
    ?>

    <div class="form-group">
      <label>Nome do slide:</label>
      <input class="nome" type="text" name="nome">
    </div><!--form-group-->
    <div class="form-group">
      <label>Imagem:</label>
      <input type="file" name="imagem">
    </div><!--form-group-->
    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Cadastrar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-slides">Slides Cadastrados</a>
</div><!--box-content-->
