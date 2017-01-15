<?php
namespace bd;
class ConexaoDAO{
  public static function ConectaBD(){
    try{
      $conectar = new \PDO('mysql:host=localhost;dbname=login', 'root', '');
      $conectar ->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conectar;
    }catch(PDOException $e){
      echo "Erro ao conectar ao banco ";
      echo $e->getMessage();
    }
  }
}

?>
