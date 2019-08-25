<?php
  $url = explode('/',$_GET['url']);
  if(!isset($url[2])){

  $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
  $categoria->execute(array(@$url[1]));
  $categoria = $categoria->fetch();
?>

<section class="header-noticias">
  <div class="center">
    <h2><i class="far fa-bell"></i></h2>
    <h2>Acompanhe as últimas <b>notícias do portal</b></h2>
  </div><!--center-->
</section>

<section class="container-portal">
  <div class="center">

    <div class="sidebar">
      <div class="box-content-sidebar">
        <h3><i class="fa fa-search"></i> Realizar uma busca:</h3>
        <form method="post">
          <input type="text" name="parametro" placeholder="O que deseja procurar?" required>
          <input type="submit" name="buscar" value="Pesquisar!">
        </form>
      </div><!--box-content-sidebar-->

      <div class="box-content-sidebar">
        <h3><i class="fa fa-list"></i> Selecione a categoria:</h3>
        <form method="post">
          <select name="categoria">
            <option value="todas" selected>Todas</option>
            <?php
              $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
              $categorias->execute();
              $categorias = $categorias->fetchAll();
              foreach ($categorias as $key => $value) {
            ?>
            <option <?php if($value['slug'] == @$url['1']) echo 'selected'; ?> value="<?php echo $value['slug']; ?>"><?php echo $value['nome']; ?></option>
            <?php } ?>
          </select>
        </form>
      </div><!--box-content-sidebar-->

      <div class="box-content-sidebar">
        <h3><i class="fa fa-user"></i> Sobre o autor:</h3>
          <div class="autor-box-portal txt-center">
            <div class="box-img-autor"></div>
            <div class="texto-autor-portal txt-center">
              <?php
                $infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
                $infoSite->execute();
                $infoSite = $infoSite->fetch();
              ?>
              <h3><?php echo $infoSite['nome_autor']; ?></h3>
              <p><?php echo substr($infoSite['descricao'],0,350).'...'; ?></p>
            </div><!--texto-autor-portal-->
          </div><!--autor-box-portal-->
      </div><!--box-content-sidebar-->
    </div><!--sidebar-->

    <div class="conteudo-portal">
      <div class="header-conteudo-portal">
        <?php
          $porPagina = 5;
          $busca = @$_POST['parametro'];

          if(!isset($_POST['parametro'])){
            if($categoria['nome'] == ''){
              echo '<h2>Visualizando todas as notícias</h2>';
            }else{
              echo '<h2>Visualizando notícias de <span>'.$categoria['nome'].'</span></h2>';
            }
          }else{
            echo '<h2><i class="fa fa-check"></i> Busca realizada com sucesso!</h2>';
          }


          $query = "SELECT * FROM `tb_site.noticias` ";
          if($categoria['nome'] != ''){
            $categoria['id'] = (int)$categoria['id'];
            $query.="WHERE categoria_id = $categoria[id]";
          }

          if(isset($_POST['parametro'])){
            if(strstr($query,'WHERE') !== false){
              $query.=" AND titulo LIKE '%$busca%'";
            }else{
              $query.=" WHERE titulo LIKE '%$busca%'";
            }
          }

          $query2 = "SELECT * FROM `tb_site.noticias` ";
          if($categoria['nome'] != ''){
            $categoria['id'] = (int)$categoria['id'];
            $query2.="WHERE categoria_id = $categoria[id]";
          }
          if(isset($_POST['parametro'])){
            if(strstr($query2,'WHERE') !== false){
              $query2.=" AND titulo LIKE '%$busca%'";
            }else{
              $query2.=" WHERE titulo LIKE '%$busca%'";
            }
          }
          $totalPaginas = MySql::conectar()->prepare($query2);
          $totalPaginas->execute();
          $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);

          if(!isset($_POST['parametro'])){
            if(isset($_GET['pagina'])){
              $pagina = (int)$_GET['pagina'];
              if($pagina > $totalPaginas){
                $pagina = 1;
              }
              $queryPg = ($pagina - 1) * $porPagina;
              $query.=" ORDER BY id DESC LIMIT $queryPg,$porPagina";
            }else{
              $pagina = 1;
              $query.=" ORDER BY id DESC LIMIT 0,$porPagina";
            }
          }else{
            $query.=" ORDER BY id DESC";
          }
          $sql = MySql::conectar()->prepare($query);
          $sql->execute();
          $noticias = $sql->fetchAll();
        ?>
      </div><!--header-conteudo-portal-->
      <?php
        foreach($noticias as $key=>$value){
          $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
          $sql->execute(array($value['categoria_id']));
          $categoriaNome = $sql->fetch()['slug'];
      ?>
      <div class="box-single-conteudo">
        <h2><?php echo date('d/m/Y',strtotime($value['data'])); ?> - <?php echo $value['titulo']; ?></h2>
        <p><?php echo substr(strip_tags($value['conteudo']),0,400).'...'; ?></p>
        <a class="txt-center" href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">Leia mais</a>
      </div><!--box-single-conteudo-->
      <?php } ?>

      <?php

      ?>

      <div class="paginator txt-center">
        <?php
          if(!isset($_POST['parametro'])){
            for($i=1; $i <= $totalPaginas; $i++){
              $catStr = ($categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
              if($pagina == $i){
                echo '<a class="active-page" href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
              }else{
                echo '<a href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
              }
            }
          }
        ?>
      </div><!--paginator-->
    </div><!--conteudo-portal-->


    <div class="clear"></div>
  </div><!--center-->
</section><!--container-portal-->
<?php }else{
  include('noticia_single.php');
} ?>
