<?php
  if(isset($_GET['excluir']) && pegaCargo($_SESSION['cargo']) === 'Administrador'){
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.categorias',$idExcluir);
    $noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));
    $noticias = $noticias->fetchAll();
    foreach ($noticias as $key => $value) {
      $imgDelete = $value['capa'];
      Usuario::deletarImagem($imgDelete);
    }
    $noticias = MySql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-categorias');
  }else if(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('tb_site.categorias',$_GET['order'],$_GET['id']);
  }
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $porPagina = 5;

  $categoria = Painel::selectAll('tb_site.categorias',($paginaAtual - 1) * $porPagina,$porPagina);
?>
<div class="box-content">
  <h2><i class="far fa-list-alt"></i> Categorias Cadastradas</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-blue">
        <td>Nome</td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>Editar</td>
        <td>Excluir</td><?php } ?>
        <td>Subir</td>
        <td>Descer</td>
      </tr>
      <?php
        foreach ($categoria as $key => $value) {
      ?>
      <tr>
        <td><?php echo $value['nome']; ?></td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
          <td>&nbsp;&nbsp;<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-categoria?id=<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></td>
          <td>&nbsp;&nbsp;&nbsp;<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-categorias?excluir=<?php echo $value['id'];?>"><i class="fas fa-times"></i></a></td>
        <?php } ?>
        <td>&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-categorias?order=up&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-up"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-categorias?order=down&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-down"></i></a></td>
      </tr>
    <?php } ?>
    </table>
  </div><!--wraper-table-->

  <div class="paginacao">
    <?php
      $totalPaginas = ceil(count(Painel::selectAll('tb_site.categorias')) / $porPagina);

      for($i = 1; $i <= $totalPaginas; $i++){
        if($i == $paginaAtual)
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-categorias?pagina='.$i.'" class="page-selected">'.$i.'</a>';
        else
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-categorias?pagina='.$i.'">'.$i.'</a>';
      }
    ?>
  </div><!--paginacao-->
</div><!--box-content-->
