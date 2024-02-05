<?php
sessao();
logout();
// Conexão com o banco de dados
include '../conexao.php';

// Consulta SQL para selecionar todos os usuários
$sql = "SELECT * FROM user";
$resultado = $conn->query($sql);

// Array para armazenar os usuários
$usuarios = [];

if ($resultado->num_rows > 0) {
    // Iterar sobre os resultados e armazenar os usuários no array
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();

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
    <link rel="stylesheet" href="./lista-usuarios.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Administrador</title>
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
    <h2 style="margin: 30px auto; width: 80%;">Listagem de Usuarios</h2>
    <section class="lista">
        <?php foreach ($usuarios as $usuario) : ?>
            <div class="lista">
                <div class="esquerda">
                    <span class="black" style="width: 10%;">ID: <?php echo $usuario['id']; ?></span>
                    <div style="width: 70%;">
                        <label for="nome">Nome: </label>
                        <?php echo $usuario['name']; ?>
                    </div>
                    <div style="width: 70%;">
                        <label for="email">E-mail: </label>
                        <?php echo $usuario['email']; ?>
                    </div>
                    <div class="black" style="width: 20%;">
                        <label for="senha">Senha: </label>
                        <?php echo $usuario['password']; ?>
                    </div>
                    <div class="direita">
                        <!-- Formulário para editar usuário -->
                        <form action="editar_usuario.php" method="GET">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                            <button type="submit"> <img class="img" src="../images/img_admin/Edit.png" title="Editar"> </button>
                        </form>

                        <!-- Formulário para excluir usuário -->
                        <form action="./excluir_usuario.php" method="POST">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                            <button type="submit"> <img class="img" src="../images/img_admin/Delete.png" title="Deletar"> </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

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