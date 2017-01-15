<?php
use bd\FunctionsDAO;
require_once("model\Usuario.php");
require_once("databases\FunctionsDAO.php");
$usuario = new model\Usuario;
$usuario->Cadastrar();

if(isset($_SESSION['logado'])){
    echo "bem vindo ".$_SESSION['usuarioNome'];
    echo "<img src='imagems\\".FunctionsDAO::RetornaImg()."'/>";
}else{
    header('Location: Login.php');
}
