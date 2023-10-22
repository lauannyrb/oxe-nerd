<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="style-login.css">
  <link rel="icon" href="../images/Logo.svg" type="svg">
  <title>login</title>
</head>
<body>
  <section class="area-login">
    <div class="login"> 
      <div> 
        <img src="./img/logo-sem-fundo.png">
      </div>
      <form action="" method="post">
        <label>E-mail</label>
        <input type="email" name="email" placeholder="Digite o seu e-mail" autofocus>
        <label>Senha</label>
        <input type="password" senha="senha" placeholder="Digite a sua senha">
        <input type="submit" value="entrar" onclick="redirecionar(event)">
      </form>
      <p>Ainda não tem um conta?<a href="./cadastro/index-cadastro.php">Criar conta</a></p> 
    </div>
    <h1>
      <?php 
        echo "";
      ?> 
    </h1>
  </section>

  <script>
    function redirecionar(event) {
      event.preventDefault(); // Impede o envio do formulário
      window.location.href = "../index.html";
    }
  </script>
</body>
</html>
