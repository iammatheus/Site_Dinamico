<div class="box-content">
  <h2><i class="fas fa-stream"></i> Cadastrar Categorias</h2>
  <form method="post" enctype="multipart/form-data">

    <?php
      verificaPermissaoPagina(2);
      if(isset($_POST['acao'])){
        $nome = $_POST['nome'];

        if($nome == ''){
          Painel::alert('erro','O campo nome não pode ficar vazio.');
        }else{
          //Podemos cadastrar
          $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
          $verificar->execute(array($_POST['nome']));
          if($verificar->rowCount() == 0){
            $slug = Painel::generateSlug($nome);
            $arr = ['nome'=>$nome, 'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categorias'];
            Painel::insert($arr);
            Painel::alert('sucesso','O cadastro da categoria foi efetuado com sucesso!');
          }else{
            Painel::alert('erro','Já existe uma categoria com este nome!');
          }
        }
      }
    ?>

    <div class="form-group">
      <label>Nome da categoria:</label>
      <input class="nome" type="text" name="nome">
    </div><!--form-group-->
    <div class="form-group">
      <input class="btnsubmit" type="submit" name="acao" value="Cadastrar">
    </div><!--form-group-->
  </form>
  <a class="A" href="listar-categorias">Categorias Cadastradas</a>
</div><!--box-content-->
