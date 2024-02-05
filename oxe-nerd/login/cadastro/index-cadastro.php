<?php
include '../../conexao.php';
sessao();
?>

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

          <?php erroMsg(); ?>

        <label>Nome completo</label>
        <input type="text" name="nome" placeholder="Digite o seu nome completo" autofocus>
        
        <label>Como você gostaria de ser chamado(a)?</label>
        <input type="text" name="apelido" placeholder="Informe o seu apelido">
        
        <label>Informe o seu e-mail</label>
        <input type="email" name="email" placeholder="Digite o seu e-mail">
        
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Digite sua senha">
        
        <label>Confime sua senha</label>
        <input type="password" name="consenha" placeholder="Confirme sua senha">
        
        <input type="submit" name= "Cadastrar-se" value="Cadastre-se">
      </form>
    </div>
  </section>
</body>

</html>
