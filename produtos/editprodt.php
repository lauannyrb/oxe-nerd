<?php
session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
  // Encerrar a sessão
  session_unset();
  session_destroy();
  header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

if(isset($_POST['editar'])){
  // Obtenha os dados do formulário
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];

  echo $nome;

  // Verifique se uma imagem foi enviada
  if (isset($_FILES['imagem'])) {
      $targetDir = "uploads/";
      $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);

      if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
          $imagem = $targetFile;
      }
  }

  $produto['nome'] = $nome;
  $produto['preco'] =$preco;
  $produto['imagem'] = $imagem;
  $_SESSION['produtos'][$_GET['id']] = $produto;

}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}


if(isset($_GET['id'])){     
    $produto = $_SESSION['produtos'][$_GET['id']];//vai jogar dentro do key do produtos
}else{
    die('Acesso incompativel');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editprodt.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
    <title> Editando produtos </title>
</head>
<body>

 <!-- Header  -->
 <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="#"> Eletrônicos </a>
            <!-- <a class="" href="#"> Equipamentos </a> -->
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php'; ?>">
            <?php echo "Bem-vindo(a), $nome_usuario"; ?>
        </a>

        <?php
        // Adicionar link de logout se o usuário estiver logado
        if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
            echo '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>';
        }
        ?>

        <a class="" href="../carrinho/index-carrinho.php">
            <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?>
        </a>
        </a>
        
        </nav>
    </header>
    <!-- Fim  -->

    <div class="cadastro">
        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="text"> 
                Nome: <input type="text" name="nome" value= "<?php echo $produto['nome'] ?>"/><br>
                Preço: <input type="text" name="preco" value="<?php echo $produto['preco']?>"><br>
                Imagem: <input type="file" name="imagem" accept="image/*" <?php echo $produto['imagem']?>><br>
            </div>
            <input type="submit" value="Editar" name ='editar' class='btn' />
            <a class="btn2" href="../produtos/edit.php"> Voltar </a>
            <a class="btn2" href="../produtos/lista_produtos_add_produto.php"> Lista de produtos </a>
        </form>  
    </div>  

<style>

form .text {
    margin-bottom: 30px;
}

.btn { /*Botões*/
  display: flex;
  padding: 10px 70px;
  background-color: #B71ABA;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  border-color: #B71ABA;
  text-align: center;
  font-size: 13.5px;
  margin: 0 auto;  /* Centraliza horizontalmente */

}
.btn:hover {
  background-color: #f890fa;
}

.btn2 { /*Botões*/
  display: inline-block;
  padding: 10px 40px; /* Defina um valor mínimo de largura para os botões */
  min-width: 120px; /* Valor mínimo de largura em pixels (ajuste conforme necessário) */
  background-color: #5094A7;
  color: #fff;
  text-decoration: none;
  text-align: center;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  border-color: #B71ABA;
  margin-top: 20px;
  margin-right: 10px; 
  font-size: 12px;

}
.btn2:hover {
  background-color: #7CBCCE;
}

/* Estilos para centralizar o conteúdo */
.cadastro {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* Estilos para o formulário */
form {
  background-color: #f0f0f0;
  padding: 50px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
  font-size: 15px;
  color: #2d1d55;
}

input {
  border-radius: 10px;
  border-color: #f0f0f0;
}


</style>

    <!---------------- Fale Conosco incio ---------------->
 <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!---------------- Fale Conosco fim ---------------->
</body>
</html>