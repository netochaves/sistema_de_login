<?php
namespace databases;
use model\Usuario;
require_once "vendor/autoload.php";
class functionsDAO{
  //função para colocar os dados do usuario no banco
   public static function CadastrarBD(Usuario $usuario){
       $conexao = new ConexaoDAO();
       $con = $conexao->ConectaBD();
       $cadastrar=$con -> prepare("INSERT INTO cadastro(nome,senha,email,descricao,image) VALUES (?,?,?,?,?)");
       $cadastrar->bindValue(1, $usuario->getNome(), \PDO::PARAM_STR);
       $cadastrar->bindValue(2, $usuario->getSenha(), \PDO::PARAM_STR);
       $cadastrar->bindValue(3, $usuario->getEmail(), \PDO::PARAM_STR);
       $cadastrar->bindValue(4, $usuario->getDescricao(), \PDO::PARAM_STR);
       $cadastrar->bindValue(5, $usuario->getImage(), \PDO::PARAM_LOB);
       $cadastrar->execute();
    }
    //função que verifica os dados do usuario no banco
   public static function LogarBD(Usuario $usuario){
        $conexao = new ConexaoDAO();
        $con = $conexao->ConectaBD();
        $logar = $con -> prepare("SELECT * FROM cadastro WHERE email = ? AND senha = ?");
        $logar->bindValue(1,$usuario->getEmail(),\PDO::PARAM_STR);
        $logar->bindValue(2,$usuario->getSenha(),\PDO::PARAM_STR);
        $logar->execute();

        if($logar->rowCount() == 1){
            $dados = $logar->fetch(\PDO::FETCH_ASSOC);
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $dados['id'];
            $_SESSION['usuarioNome'] = $dados['nome'];
            $_SESSION['usuarioEmail'] = $dados['email'];
            $_SESSION['usuarioSenha'] = $dados['senha'];
            header('Location: Logado.php');
        }
    }
    //Função que verifica se o email ja existe no banco
    public static function verificaEmail(Usuario $usuario){
      $con = new ConexaoDAO();
      $con = ConexaoDAO::ConectaBD();
      $verificar = $con->prepare("SELECT * FROM cadastro WHERE email = ?");
      $verificar->bindValue(1, $usuario->getEmail(), \PDO::PARAM_STR);
      $verificar->execute();
      if($verificar->rowCount() == 1){
          return true;
      }else{
          return false;
      }
    }
    //Função que pega o caminho da imagem no banco de dados
    public static function RetornaImg(){
      $id = $_SESSION['id'];
      $con = new ConexaoDAO();
      $con = ConexaoDAO::ConectaBD();
      $retorna = $con->prepare("SELECT image FROM cadastro WHERE id = ?");
      $retorna->bindParam(1, $id, \PDO::PARAM_INT);
      if ($retorna->execute())
      {
          $foto = $retorna->fetchObject();
          return $foto->image;
      }
    }
}
