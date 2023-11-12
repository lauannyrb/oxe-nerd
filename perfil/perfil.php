<?php
session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comprar'])) {
        // Coletar informações do produto do formulário
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $imagem = $_POST['imagem'];

        // Criar uma array associativa para representar o produto
        $produto = [
            'nome' => $nome,
            'preco' => $preco,
            'imagem' => $imagem,
        ];

        // Verificar se o carrinho já existe na sessão e criar se necessário
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adicionar o produto ao carrinho
        $_SESSION['carrinho'][] = $produto;
    }
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}
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
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <a class="" href="../produtos/cadastro_produtos.html"> Novos produtos </a>
            <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '#' : '../login/index-login.php'; ?>">
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