<?php 
session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}


$nome_usuario = $_SESSION['usuario_logado']['nome'];
$email_usuario = $_SESSION['usuario_logado']['email'];


if (!isset($_SESSION['usuario_logado'])) {
    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: ../login/index-login.php");
    exit;
}

$nome_usuario = $_SESSION['usuario_logado']['nome'];
$email_usuario = $_SESSION['usuario_logado']['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Editar'])) {
    // Processar as alterações

    // Inicializar variáveis para as novas informações
    $novo_nome = $nome_usuario;
    $novo_email = $_SESSION['usuario_logado']['email'];
    $nova_senha = isset($_SESSION['usuario_logado']['senha']) ? $_SESSION['usuario_logado']['senha'] : '';

// Verificar se o campo foi preenchido e atualizar as variáveis correspondentes
    if (!empty($_POST['novo_nome'])) {
        $novo_nome = $_POST['novo_nome'];
    }

    if (!empty($_POST['novo_email'])) {
        $novo_email = $_POST['novo_email'];
    }

    if (!empty($_POST['nova_senha'])) {
        $nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT); // Hash da nova senha
    }
    // Validar os campos conforme necessário

    // Atualizar as informações do usuário na sessão
    $_SESSION['usuario_logado']['nome'] = $novo_nome;
    $_SESSION['usuario_logado']['email'] = $novo_email;
    if (!empty($_POST['nova_senha'])) {
        $_SESSION['usuario_logado']['senha'] = $nova_senha;
    }

    // Redirecionar de volta para a página de perfil após a edição
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="perfil.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd" ></a>
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
                <h1>Editar Perfil</h1>
                <label for="novo_nome">Novo Nome:</label>
                <input type="text" id="novo_nome" name="novo_nome">

                <label for="novo_email">Novo Email:</label>
                <input type="email" id="novo_email" name="novo_email">

                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha">

                <input type="submit" name="Editar" value="Editar">
            </form>
        </div>
    </div>
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
