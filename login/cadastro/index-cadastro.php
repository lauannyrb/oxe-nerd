<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="style-cadastro.css">
  <link rel="icon" href="../../images/Logo.svg" type="svg">
  <title>Cadastro</title>
</head>

<body>
  <section class="area-login">
    <div class="login">
      <div>
        <img src="./img/logo-sem-fundo.png">
      </div>
      <form method="post" action="processa_cadastro.php">
        <!-- Exibir mensagem de erro, se houver -->
        <?php
        session_start();
        if (isset($_SESSION['cadastro_erro'])) {
          echo '<div class="mensagem-erro">' . $_SESSION['cadastro_erro'] . '</div>';
          unset($_SESSION['cadastro_erro']); // Limpar a mensagem de erro
        }
        ?>

        <label>Nome</label>
        <input type="text" name="nome" placeholder="Digite o seu nome completo" autofocus>
        <label>Informe o seu e-mail</label>
        <input type="email" name="email" placeholder="Digite o seu e-mail">
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Digite sua senha">
        <input type="submit" name= "Cadastrar-se" value="Cadastre-se">
      </form>
    </div>
  </section>
</body>

</html>