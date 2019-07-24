<?php
  if(isset($_GET['excluir']) && pegaCargo($_SESSION['cargo']) === 'Administrador'){
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.servicos',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
  }else if(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
  }
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $porPagina = 5;

  $servicos = Painel::selectAll('tb_site.servicos',($paginaAtual - 1) * $porPagina,$porPagina);
?>
<div class="box-content">
  <h2><i class="far fa-list-alt"></i> Serviços Cadastrados</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-blue">
        <td>Serviços</td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>Editar</td>
        <td>Excluir</td><?php } ?>
        <td>Subir</td>
        <td>Descer</td>
      </tr>
      <?php
        foreach ($servicos as $key => $value) {
      ?>
      <tr>
        <td><?php echo $value['servico']; ?></td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
        <td>&nbsp;&nbsp;<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="fas fa-pen"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?excluir=<?php echo $value['id'];?>"><i class="fas fa-times"></i></a></td><?php } ?>
        <td>&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=up&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-up"></i></a></td>
        <td>&nbsp;&nbsp;&nbsp;<a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=down&id=<?php echo $value['id'];?>"><i class="fas fa-arrow-down"></i></a></td>
      </tr>
    <?php } ?>
    </table>
  </div><!--wraper-table-->

  <div class="paginacao">
    <?php
      $totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina);

      for($i = 1; $i <= $totalPaginas; $i++){
        if($i == $paginaAtual)
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'" class="page-selected">'.$i.'</a>';
        else
          echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
      }
    ?>
  </div><!--paginacao-->
</div><!--box-content-->
