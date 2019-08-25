<?php
  if(isset($_GET['excluir']) && pegaCargo($_SESSION['cargo']) === 'Administrador'){
    $idExcluir = intval($_GET['excluir']);
    $selectImagem = MySql::conectar()->prepare("SELECT capa FROM `tb_site.noticias` WHERE id = ?");
    $selectImagem->execute(array($_GET['excluir']));
    $imagem = $selectImagem->fetch()['capa'];
    Usuario::deletarImagem($imagem);
    Painel::deletar('tb_site.noticias',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-noticias');
  }else if(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('tb_site.noticias',$_GET['order'],$_GET['id']);
  }
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $porPagina = 5;

  $noticias = Painel::selectAll('tb_site.noticias',($paginaAtual - 1) * $porPagina,$porPagina);
?>
<div class="box-content">
  <h2><i class="far fa-list-alt"></i> Notícias Cadastradas</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-blue">
        <td>Título</td>
        <td>Categoria</td>
        <td>Capa</td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>Editar</td>
        <td>Excluir</td><?php } ?>
        <td>Subir</td>
        <td>Descer</td>
      </tr>
      <?php
        foreach ($noticias as $key => $value) {
          $nomeCategoria = Painel::select('tb_site.categorias','id=?',array($value['categoria_id']))['nome'];
      ?>
      <tr>
        <td><?php echo $value['titulo']; ?></td>
        <td><?php echo $nomeCategoria; ?></td>
        <td>&nbsp;&nbsp;<img style="width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['capa']; ?>" /></td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>&nbsp;&nbsp;<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-noticia?id=<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-noticias?excluir=<?php echo $value['id'];?>"><i class="fas fa-times"></i></a></td><?php } ?>
        <td>&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-noticias?order=up&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-up"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-noticias?order=down&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-down"></i></a></td>
      </tr>
    <?php } ?>
    </table>
  </div><!--wraper-table-->

  <div class="paginacao">
    <?php
      $totalPaginas = ceil(count(Painel::selectAll('tb_site.noticias')) / $porPagina);

      for($i = 1; $i <= $totalPaginas; $i++){
        if($i == $paginaAtual)
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-noticias?pagina='.$i.'" class="page-selected">'.$i.'</a>';
        else
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-noticias?pagina='.$i.'">'.$i.'</a>';
      }
    ?>
  </div><!--paginacao-->
</div><!--box-content-->
