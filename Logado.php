<?php
session_start();
require_once "vendor/autoload.php";

use databases\FunctionsDAO;
use model\Usuario;
$usuario = new Usuario();

if(isset($_SESSION['logado'])){
    echo "bem vindo ".$_SESSION['usuarioNome'];
    echo "<img src='imagems\\".FunctionsDAO::RetornaImg()."'/>";
}else{
    header('Location: index.php');
}
