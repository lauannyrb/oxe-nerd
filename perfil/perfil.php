<?php
session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

$nome_usuario = "Faça login";
$email_usuario = "";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    include '../conexao.php';

    $email_logado = $_SESSION['usuario_logado']['email'];
    $stmt = $conn->prepare("SELECT `name`, `nickname`, `email` FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email_logado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $nome_usuario = $usuario['nickname']; // Alteração aqui
        $nome = $usuario['name']; // Alteração aqui
        $email_usuario = $usuario['email'];
    }
    
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
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
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

    <div class="area-login">
        <div class="login">
            <form action="" method="post">

                <h1>Perfil do Usuário</h1>
                <p><span>Nome completo:</span> <?= $nome ?></p>
                <p><span>Apelido:</span> <?= $usuario['nickname'] ?></p>
                <p><span>Email:</span> <?= $email_usuario ?></p>

                <a href="editperfil.php" name='editar'>Editar</a>
                
                <?php
                    if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
                        echo '<a class="" href="excluir_usuario.php?email=' . $_SESSION['usuario_logado']['email'] . '"> Excluir </a>';
                    }
                ?>

            </form>
        </div>
    </div>

    <!-- Fale Conosco -->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!-- Fale Conosco fim -->
</body>

</html>
