<?php
  class Usuario{
    public function atualizarUsuario($nome,$senha,$imagem){
      $sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?,password = ?,img = ? WHERE user = ?");
      if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
        return true;
      }else{
        return false;
      }
    }

    public static function imagemValida($imagem){
      if($imagem['type'] == 'image/jpeg' ||
         $imagem['type'] == 'image/jpg' ||
         $imagem['type'] == 'image/png')
      {
        $tamanho = intval($imagem['size']/1024);
        if($tamanho <= 300){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }

    public static function uploadImagem($file){
      $formatoArquivo = explode('.',$file['name']);
      $imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
      if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome)){
        return $imagemNome;
      }else{
        return false;
      }
    }

    public static function deletarImagem($file){
      @unlink('uploads/'.$file);
    }

    public static function loginExists($user){
      $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user = ?");
      $sql->execute(array($user));
      if($sql->rowCount() == 1){
        return true;
      }else{
        return false;
      }
    }

    public static function cadastrarUsuario($user,$senha,$imagem,$nome,$cargo){
      $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES(null,?,?,?,?,?)");
      $sql->execute(array($user,$senha,$imagem,$nome,$cargo));
    }
  }

?>
