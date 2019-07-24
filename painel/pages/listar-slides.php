<?php
  if(isset($_GET['excluir']) && pegaCargo($_SESSION['cargo']) === 'Administrador'){
    $idExcluir = intval($_GET['excluir']);
    $selectImagem = MySql::conectar()->prepare("SELECT slide FROM `tb_sites.slides` WHERE id = ?");
    $selectImagem->execute(array($_GET['excluir']));
    $imagem = $selectImagem->fetch()['slide'];
    Usuario::deletarImagem($imagem);
    Painel::deletar('tb_sites.slides',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
  }else if(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('tb_sites.slides',$_GET['order'],$_GET['id']);
  }
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $porPagina = 5;

  $slides = Painel::selectAll('tb_sites.slides',($paginaAtual - 1) * $porPagina,$porPagina);
?>
<div class="box-content">
  <h2><i class="fas fa-images"></i> Slides Cadastrados</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-blue">
        <td>Nome</td>
        <td>Imagem</td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>Editar</td>
        <td>Excluir</td><?php } ?>
        <td>Subir</td>
        <td>Descer</td>
      </tr>
      <?php
        foreach ($slides as $key => $value) {
      ?>
      <tr>
        <td><?php echo $value['nome']; ?></td>
        <td>&nbsp;&nbsp;<img style="width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['slide']; ?>" /></td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>&nbsp;&nbsp;<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-slide?id=<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?excluir=<?php echo $value['id'];?>"><i class="fas fa-times"></i></a></td><?php } ?>
        <td>&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=up&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-up"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=down&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-down"></i></a></td>
      </tr>
    <?php } ?>
    </table>
  </div><!--wraper-table-->

  <div class="paginacao">
    <?php
      $totalPaginas = ceil(count(Painel::selectAll('tb_sites.slides')) / $porPagina);

      for($i = 1; $i <= $totalPaginas; $i++){
        if($i == $paginaAtual)
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'" class="page-selected">'.$i.'</a>';
        else
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
      }
    ?>
  </div><!--paginacao-->
</div><!--box-content-->
