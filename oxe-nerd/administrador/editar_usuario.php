<?pinclude '../conexao.php';


ssessao();
logout();


// Verifique se o ID do usuário foi passado
if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Consulta SQL para obter os dados do usuário com base no ID
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se encontrou o usuário
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Atribua os dados do usuário às variáveis
        $nome_usuario = $usuario['name'];
        $email_usuario = $usuario['email'];
        $senha_usuario = $usuario['password'];  // Adicione esta linha para obter a senha
        // Adicione outras variáveis conforme necessário
    } else {
        // Usuário não encontrado, lide com isso conforme necessário
        echo "Usuário não encontrado";
        exit;
    }

    $stmt->close();
} else {
    // ID do usuário não fornecido, lide com isso conforme necessário
    echo "ID do usuário não fornecido";
    exit;
}

// Processamento do formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Editar'])) {
    // Verifique se os campos necessários estão presentes no formulário
    if (isset($_POST['novo_nome']) && isset($_POST['novo_email']) && isset($_POST['nova_senha'])) {
        // Obtenha os novos valores dos campos
        $novo_nome = $_POST['novo_nome'];
        $novo_email = $_POST['novo_email'];
        $nova_senha = $_POST['nova_senha'];

        // Atualize os dados do usuário no banco de dados
        $stmt = $conn->prepare("UPDATE user SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $novo_nome, $novo_email, $nova_senha, $usuario_id);
        $stmt->execute();
        $stmt->close();

        // Redirecione para a página de perfil após a edição
        header("Location: ./lista-usuarios.php");
        exit;
    } else {
        // Campos necessários não presentes, lide com isso conforme necessário
        echo "Campos necessários não preenchidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./editar_usuario.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Edita Perfil</title>
</head>

<body>
<header>
    <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>
        <?php painelDeControleAdm(); ?>
        <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
        <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
        <?php exibirLinksUsuario(); ?>
    </nav>
</header>

<div class="area-login">
    <div class="login">
        <form action="" method="post">
            <h1>Editar Usuário</h1>
            <label for="novo_nome">Novo Nome:</label>
            <input type="text" id="novo_nome" name="novo_nome" value="<?php echo $nome_usuario; ?>">

            <label for="novo_email">Novo Email:</label>
            <input type="email" id="novo_email" name="novo_email" value="<?php echo $email_usuario; ?>">

            <label for="nova_senha">Nova Senha:</label>
            <input type="text" id="nova_senha" name="nova_senha" value="<?php echo $senha_usuario; ?>">

            <input type="submit" name="Editar" value="Editar">

            <input type="button" value="Cancelar" class="cancelar-btn" onclick="window.location.href='./lista-usuarios.php';">

        </form>
    </div>
</div>


<footer>
    <h2>Fale Conosco</h2>
    <div>
        <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
        <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
        <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
    </div>
    <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p>
</footer>
</body>
</html>