<?php
namespace model;
use model\FunctionsUser;
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
    public function Cadastrar(){
      return FunctionsUser::Cadastrar();
    }
    public function Logar(){
      return FunctionsUser::Logar();
    }
}
