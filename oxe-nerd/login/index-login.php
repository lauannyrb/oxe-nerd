<?php
include "../conexao.php";
sessao();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="style-login.css">
  <link rel="icon" href="../images/Logo.svg" type="svg">
  <title>Login</title>
</head>
<body>
  <section class="area-login">
    <div class="login"> 
      <div> 
        <img src="./img/logo-sem-fundo.png">
      </div>
      
      <form method="post" action="processa_login.php">
        <!-- Exibir mensagem de erro, se houver -->
        <?php   erroMsg()    ?>
        <label for="email">E-mail</label>
        <input type="email" name="email" required placeholder="Digite o seu e-mail" autofocus>
        <label for="senha">Senha</label>
        <input type="password" name="senha" required placeholder="Digite a sua senha">
        <input type="submit" value="Entrar">
      </form>
      <p>Ainda não tem um conta?<a href="./cadastro/index-cadastro.php">Criar conta</a></p> 
    </div>
    <h1>
    </h1>
  </section>

</body>
</html>
