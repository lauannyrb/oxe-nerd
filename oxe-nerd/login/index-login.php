<?php
session_start(); // Coloque isso no início do arquivo

// O resto do seu código PHP
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
        <?php
        
        
          if (isset($_SESSION['login_erro'])) {
              echo '<div class="mensagem-erro">';
              echo '<span class="error-icon">❌</span>';
              echo $_SESSION['login_erro'];
              echo '</div>';
              unset($_SESSION['login_erro']);
          }
        ?>

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
