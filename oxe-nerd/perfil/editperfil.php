<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Editar'])) {
    include '../conexao.php'; // Inclua aqui seu arquivo de conexão

    $nome_usuario = $_SESSION['usuario_logado']['nome'];
    $email_usuario = $_SESSION['usuario_logado']['email'];

    // Inicializar variáveis para as novas informações
    $novo_nome = $nome_usuario;
    $novo_email = $email_usuario;
    $novo_nick = $_SESSION['usuario_logado']['nickname'];
    $nova_senha = isset($_SESSION['usuario_logado']['senha']) ? $_SESSION['usuario_logado']['senha'] : '';

    // Verificar se o campo foi preenchido e atualizar as variáveis correspondentes
    if (!empty($_POST['novo_nome'])) {
        $novo_nome = $_POST['novo_nome'];
    }

    if (!empty($_POST['novo_email'])) {
        $novo_email = $_POST['novo_email'];
    }

    if (!empty($_POST['novo_nick'])) {
        $novo_nick = $_POST['novo_nick'];
    }

    if (!empty($_POST['nova_senha'])) {
        $nova_senha = $_POST['nova_senha'];
    }
    // Validar os campos conforme necessário

    // Verificar se o novo email já está cadastrado no banco de dados
    $stmt_check_email = $conn->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = ?");
    $stmt_check_email->bind_param("s", $novo_email);
    $stmt_check_email->execute();
    $stmt_check_email->bind_result($email_count);
    $stmt_check_email->fetch();
    $stmt_check_email->close();

    if ($email_count > 0) {
        // O novo email já está cadastrado, exiba uma mensagem de erro ou faça o tratamento adequado
        echo "O email já está cadastrado. Por favor, escolha outro.";
        exit;
    }

    // Se o novo email não estiver cadastrado, proceda com a atualização das informações do usuário
    $stmt = $conn->prepare("UPDATE `user` SET `name`=?, `email`=?, `nickname`=?, `password`=? WHERE `email`=?");
    $stmt->bind_param("sssss", $novo_nome, $novo_email, $novo_nick, $nova_senha, $email_usuario);
    $stmt->execute();
    $stmt->close();

    // Atualizar as informações do usuário na sessão
    $_SESSION['usuario_logado']['nome'] = $novo_nome;
    $_SESSION['usuario_logado']['email'] = $novo_email;
    $_SESSION['usuario_logado']['nickname'] = $novo_nick;
    if (!empty($_POST['nova_senha'])) {
        $_SESSION['usuario_logado']['senha'] = $nova_senha;
    }

    // Redirecionar de volta para a página de perfil após a edição
    header("Location: ../perfil/perfil.php");
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
  <!-- Header  -->
  <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
        <?php
        if (isset($_SESSION['type_user'])) {
            if ($_SESSION['type_user'] == 'adm') {
                echo '<a class="" href="../administrador/admin-home.php"> Painel de Controle Adminstrador </a>';
            } else {
                echo 'User type: ' . $_SESSION['type_user'];
            }
        }
        ?>
            <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
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
    </header>

    <div class="area-login">
        <div class="login">
            <form action="" method="post">
                <h1>Editar Perfil</h1>
                <label for="novo_nome">Novo Nome:</label>
                <input type="text" id="novo_nome" name="novo_nome">

                <label for="novo_email">Novo Email:</label>
                <input type="email" id="novo_email" name="novo_email">

                <label for="novo_nick">Novo Usuário:</label>
                <input type="text" id="novo_nick" name="novo_nick">

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
