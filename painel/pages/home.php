<?php
  $usuariosOnline = Painel::listarUsuariosOnline();

  $visitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
  $visitasHoje->execute(array(date('Y-m-d')));
  $visitasHoje = $visitasHoje->rowCount();

  $visitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
  $visitasTotais->execute();
  $visitasTotais = $visitasTotais->rowCount();

  if(isset($_GET['excluir']) && pegaCargo($_SESSION['cargo']) === 'Administrador'){
    $idExcluir = intval($_GET['excluir']);
    $selectUser = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
    $selectUser->execute(array($_GET['excluir']));
    $imagem = $selectUser->fetch()['img'];
    Usuario::deletarImagem($imagem);
    Painel::deletar('tb_admin.usuarios',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL);
  }
  $usuarioPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
  $usuarioPainel->execute();
  $usuarioPainel = $usuarioPainel->fetchAll();
?>

<div class="box-content w100">
  <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>

  <div class="box-metricas">
    <div class="box-metrica-single">
      <div class="box-metrica-wraper">
        <h2>Usuários Online</h2>
        <p><?php echo count($usuariosOnline); ?></p>
      </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="box-metrica-single">
      <div class="box-metrica-wraper">
        <h2>Total de Visitas</h2>
        <p><?php echo $visitasTotais; ?></p>
      </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="box-metrica-single">
      <div class="box-metrica-wraper">
        <h2>Visitas Hoje</h2>
        <p><?php echo $visitasHoje; ?></p>
      </div><!--box-metrica-wraper-->
    </div><!--box-metrica-single-->
    <div class="clear"></div>
  </div><!--box-metricas-->
</div><!--box-content-->

<div class="box-content">
  <h2><i class="fas fa-globe"></i> Usuários online no site</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-green">
        <td>IP</td>
        <td>Última Ação</td>
      </tr>
      <?php
        foreach($usuariosOnline as $key => $value){
      ?>
      <tr>
        <td><?php echo $value['ip'];?></td>
        <td><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao']));?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>

<div class="box-content">
  <h2><i class="fas fa-users"></i> Usuários do Painel</h2>
  <div class="wraper-table">
    <table>
      <tr class="bg-green">
        <td>Nome</td>
        <td>Cargo</td>
        <td>Excluir</td>
      </tr>
      <?php
        foreach($usuarioPainel as $key => $value){
      ?>
      <tr>
        <td><?php echo $value['user']; ?></td>
        <td><?php echo pegaCargo($value['cargo']); ?></td>
        <?php if(pegaCargo($_SESSION['cargo']) === 'Administrador'){ ?>
          <td>&nbsp;&nbsp;&nbsp;<a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>?excluir=<?php echo $value['id'];?>"><i class="fas fa-times"></i></a></td>
        <?php }else{echo '<td>Permissão insuficiente.</td>';} ?>
      </tr>
      <?php } ?>
    </table>
  </div><!--wraper-table-->
</div><!--box-content-->
