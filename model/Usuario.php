<?php
namespace model;
use bd\functionsDAO;
use bd\ConexaoDAO;
include_once "databases/ConexaoDAO.php";
include_once "databases/FunctionsDAO.php";
include_once "functions.php";
class Usuario{
    protected $nome;
    protected $email;
    protected $senha;
    protected $descricao;
    protected $image;
    protected $id;

    function getNome(){
        return $this->nome;
    }
    function getEmail(){
        return $this->email;
    }
    function getSenha(){
        return $this->senha;
    }
    function getDescricao(){
        return $this->descricao;
    }
    function getImage(){
        return $this->image;
    }
    function setNome($nome){
        $this->nome = $nome;
    }
    function setEmail($email){
        $this->email = $email;
    }
    function setSenha($senha){
        $this->senha = $senha;
    }
    function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    function setImage($image){
      $this->image = $image;
    }
    //Função para cadastrar usuario
    public function Cadastrar(){
      session_start();
        $usuario = new Usuario();
        if(isset($_POST['botao'])){
          //Recolhe e filtra os dados
          $usuario->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
          $usuario->setSenha(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
          $usuario->setEmail(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
          $usuario->setDescricao(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
          $reSenha = $_POST['reSenha'];
          $usuario->setSenha(hashSenha($usuario->getSenha()));

          if(!empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['email'] && !empty($_POST['reSenha']))){
            if(FunctionsDAO::verificaEmail($usuario) == false){
              if($reSenha == $_POST['senha']){
                $usuario->setImage($usuario->CadastraImg($_FILES['image']));
                if($usuario->getImage() != null){
                  FunctionsDAO::CadastrarBD($usuario);
                  header('Location: index.php');
                }
              }else{
                echo  '<div class="box">As senhas não conferem</div>';
              }
            }else{
              echo '<div class="box">Este email já existe</div>';
            }
          }else{
            echo '<div class="box">Os campos com * são obrigatorios</div>';
          }
        }
    }
    //Função para logar o usuario
    public function Logar(){
        session_start();
        $usuario =  new Usuario();
        //verifica se a sessão do usuario ja esta aberta
        if(isset($_SESSION['logadoS'])){
            $usuario->  setEmail($_SESSION['usuarioEmail']);
            $usuario->setSenha($_SESSION['usuarioSenha']);
            functionsDAO::LogarBD($usuario);
        }
        //Se não tiver pede os dados
        if(isset($_POST['logar'])){
            $usuario->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
            $usuario->setSenha(md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)));
            if(functionsDAO::LogarBD($usuario)){
              header('Location: Logado.php');
            }else{
              echo '<div class="box">Senha ou Email errados</div>';
            }
            //verifica se o usuario selecionou o checkbox
            if(isset($_POST['lembrar'])){
                $_SESSION['logadoS'] = true;
            }
        }
    }
    //Função para cadastrar imagem do usuario
    public function CadastraImg($image){
      //verifica se uma imagem foi selecionada
      if(!empty($image['name'])){
          $largura = 180;
          $altura = 180;

          if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $image['type'])) //Verifica o tipo da imagem
          {
            $erro[1] = '<div class="box">Tipo de imagem invalido</div>';
          }
          $dimensoes = getimagesize($image['tmp_name']);

          if($dimensoes[0] > $largura){
            $erro[2] = '<div class="box">a largura da imagem não deve ultrapassar ".$largura."pixels</div>';
          }
          if($dimensoes[1] > $altura){
            $erro[3] = '<div class="box">a altura da imagem não deve ultrapassar ".$altura."pixels</div>';
          }
          //se não deu erro retorna a imagem
          if(!isset($erro)){
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $image["name"], $ext);
            $nome_imagem = md5(uniqid(time())). "." . $ext[1];
            m
            $caminho_imagem = "Imagems\\" . $nome_imagem;
            move_uploaded_file($image['tmp_name'], $caminho_imagem);
            return $nome_imagem;
          //se deu algum erro exibe  o erro e retorna null
          }else{
            foreach($erro as $erros){
                echo $erros ."<br />";
            }
            return null;
          }
      // se o usuario não selecionou uma imagem retorna imagem padrão
      }else{
            $nome_imagem = "profile.png";
            $caminho_imagem = "imagems\\".$nome_imagem;
            return $nome_imagem;
      }
    }
}
