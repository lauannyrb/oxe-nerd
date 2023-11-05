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
      <form method="post">
        <span>Nome de usuário</span>
        <input type="text" name="nome" placeholder="Digite o seu nome" autofocus>
        <span>Informe o seu e-mail</span>
        <input type="email" name="email" placeholder="Digite o seu e-mail" > 
        <span>Senha</span>
        <input type="password" senha="senha" placeholder="Digite sua senha">
        <input type="password" senha="senha" placeholder="Confirme a sua senha">
        <input type="submit" value="cadastre-se" onclick="redirecionar(event)">
      </form>
    </div>
  </section>
  <script>
    function redirecionar(event) {
      event.preventDefault(); // Impede o envio do formulário
      window.location.href = "../../index.php";
    }
  </script>
</body>
</html>
