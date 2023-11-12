<?php
session_start();
if (isset($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado'];
} else {
    $nome_usuario = "Faça login";
}

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: index-login.php");
    exit;
}

$nome_usuario = $_SESSION['usuario_logado']['nome'];
$email_usuario = $_SESSION['usuario_logado']['email'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="./perfil.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>
    <header>
        <a href="./index.php"><img class="logo-oxe-nerd" src="images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <a class="" href="./produtos/cadastro_produtos.html"> Novos produtos </a>
            <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
            <!-- <a class="Promoções" href="#promocoes"> Promoções</a> -->
            <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="./login/index-login.php"><?php echo "Bem-vindo(a), $nome_usuario"; ?></a>
            <a class="" href="./carrinho/index-carrinho.php"> <img class="carrinho" src="images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </nav>
    </header>

    <form action="" method="post">

        <h1>Perfil do Usuário</h1>
        <p>Nome: <?= $nome_usuario ?></p>
        <p>Email: <?= $email_usuario ?></p>
        <!-- Outras informações do perfil aqui -->

        <a href="editperfil.php" name ='editar'>Edite seu Perfil</a>
        <a href="logout.php">Sair</a>

    </form>
    <!---------------- Fale Conosco ---------------->
    <h2 class="contato">Fale Conosco</h2>

    <section class="contato">
        <section class="box">82 99714-3090</section>
        <section class="box">@oxe_nerd</section>
        <section class="box">oxenerdbr@outlook.com</section>
    </section>
    <footer class="roda">
        <strong>OXE NERD<BR>Todos os direitos reservados</strong>
    </footer>
</body>

</html>