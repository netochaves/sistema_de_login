<?php
include_once "model\Usuario.php";
$usuario = new model\Usuario();
$usuario->Cadastrar();
$nome = isset( $_POST['nome'] ) ? $_POST['nome'] :'';
$email = isset( $_POST['email'] ) ? $_POST['email'] :'';
$descricao = isset( $_POST['descricao'] ) ? $_POST['descricao'] :'';
?>
<html>
  <head>
    <title> Cadastro </title>
    <meta http-equiv="content-type" content="text/php" charset="utf-8">
    <link href="css/css.css" rel="stylesheet">
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="box">
      <label for="nome">
        <span> Nome Completo * </span>
        <input class="input_text" type="text" name="nome" value="<?php echo htmlentities($nome); ?>">
      </label>
      <label for="senha">
        <span> Senha *</span>
        <input class="input_text" type="password" name="senha">
      </label>
      <label for="reSenha">
        <span> Confirme a senha *</span>
        <input class="input_text" type="password" name="reSenha">
      </label>
      <label for="email">
        <span> Email *</span>
        <input class="input_text" type="text" name="email" value="<?php echo htmlentities($email); ?>">
      </label>
      <label for="descricao">
        <span> Descricao do usuario </span>
        <textarea class="descricao" name="descricao"><?php echo htmlentities($descricao); ?></textarea>
      </label>
      <label>
        <span> Imagem </span>
        <input class="image" type="file" name="image">
      </label>
      <label for="botao">
        <span> Cadastrar </span>
        <input type="submit" name="botao">
      </label>
      <label for="erro">
        <?php echo isset($erro) ? $erro : ''; ?>
      </label>
    </div>
    </form>
  </body>
</html>
