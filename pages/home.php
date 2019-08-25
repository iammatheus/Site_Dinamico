<section class="banner-container">
  <?php
    $sql = MySql::conectar()->prepare('SELECT * FROM `tb_sites.slides` ORDER BY `order_id` ASC LIMIT 5');
    $sql->execute();
    $slides = $sql->fetchAll();
    foreach ($slides as $key => $value){
  ?>
    <div class="banner-single"><input type="image" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['slide']; ?>" /></div>
  <?php } ?>
  <div class="overlay"></div>
  <div class="center">

    <form method="post" action="Contato.php" class="ajax-form">
      <h2>Qual o seu melhor email?</h2>
      <input type="email" name="email" placeholder="exemplo@hotmail.com" required>
      <input type="hidden" name="identificador" value="form_cadastro">
      <input type="submit" name="acao" value="Cadastrar!">
    </form>
  </div><!--center-->
  <div class="bullets"></div><!--bullets-->
</section><!--banner-container-->

<section class="descricao-autor">
  <div class="center">
    <div class="w100 left">
      <h2 class="txt-center"><img src="<?php INCLUDE_PATH ?>images/foto.jpg"/><?php echo $infoSite['nome_autor']; ?></h2>
      <p><?php echo $infoSite['descricao']; ?></p>
    </div><!--w50-->
    <div class="clear"></div>
  </div><!--center-->
</section><!--descricao-autor-->

<section class="especialidades">
  <div class="center">
    <h2 class="title">Especialidades</h2>
    <div class="box-especialidade w33 left">
      <h3><i class="<?php echo $infoSite['icone1']; ?>"></i></h3>
      <h4>CSS3</h4>
      <p><?php echo $infoSite['descricao1']; ?></p>
    </div><!--box-especialidade-->
    <div class="box-especialidade w33 left">
      <h3><i class="<?php echo $infoSite['icone2']; ?>"></i></h3>
      <h4>HTML5</h4>
      <p><?php echo $infoSite['descricao2']; ?></p>
    </div><!--box-especialidade-->
    <div class="box-especialidade w33 left">
      <h3><i class="<?php echo $infoSite['icone3']; ?>"></i></h3>
      <h4>JavaScript</h4>
      <p><?php echo $infoSite['descricao3']; ?></p>
    </div><!--box-especialidade-->
    <div class="clear"></div>
  </div><!--center-->
</section><!--especialidades-->

<section class="extras">
  <div class="center">
    <div class="w50 left depoimentos-container" id="depoimentos">
      <h2 class="title">Depoimentos dos nossos clientes</h2>
      <?php
        $sql = MySql::conectar()->prepare('SELECT * FROM `tb_site.depoimentos` ORDER BY `order_id` ASC LIMIT 3');
        $sql->execute();
        $depoimento = $sql->fetchAll();
        foreach ($depoimento as $key => $value){
      ?>
      <div class="depoimento-single">
        <p class="depoimento-descricao"><?php echo $value['depoimento']; ?></p>
        <p class="nome-autor"><?php echo $value['nome']; ?> - <?php echo $value['data']; ?></p>
      </div><!--depoimento-single-->
      <?php } ?>
    </div><!--w50-->

    <div class="w50 left servicos-container" id="servicos">
      <h2 class="title">Serviços</h2>
      <div class="servicos">
        <ul>
          <?php
            $sql = MySql::conectar()->prepare('SELECT * FROM `tb_site.servicos` ORDER BY `order_id` ASC LIMIT 3');
            $sql->execute();
            $servicos = $sql->fetchAll();
            foreach ($servicos as $key => $value){
          ?>
          <li><?php echo $value['servico']; ?></li>
          <?php } ?>
        </ul>
      </div><!--servicos-->
    </div><!--w50-->
    <div class="clear"></div>
  </div><!--center-->
</section><!--extras-->
