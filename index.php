<?php
include_once "model\Usuario.php";
$usuario = new model\Usuario();
$usuario->Logar();
?>
<html>
  <head>
    <title> Login </title>
      <meta content="text/php" charset="utf-8">
      <link href="css/css.css" rel="stylesheet">
  </head>
  <body>
    <form method="post">
      <div class="box">
      <label for="Email">
          <span> Email </span>
          <input class="input_text" name="email" type="text">
      </label>
      <label for="Senha">
          <span> Senha </span>
          <input class="input_text" name="senha" type="password">
      </label>
      <label for="lembrar">
        <span> Manter Logado </span>
          <input type="checkbox" name="lembrar">
      </label>
      <label for="botao">
          <input class=""type="submit" name="logar">
      </label>
      </div>
    </form>
  </body>
</html>
