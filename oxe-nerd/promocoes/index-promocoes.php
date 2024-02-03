<?php
// Inicie a sessão aqui
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

// Incluir o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para selecionar todos os produtos da categoria "Promoção"
$sql = "SELECT * FROM products WHERE category = 'Promoção'";
$result = $conn->query($sql);

// Verificar se o formulário de compra foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    // Verificar se o carrinho existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    // Adicionar o produto ao carrinho
    $produto = [
        'nome' => $_POST['nome'],
        'preco' => $_POST['preco'],
        'imagem' => $_POST['imagem'],
        'quantidade' => 1 // Definir quantidade inicial como 1
    ];
    $_SESSION['carrinho'][] = $produto;
    // Redirecionar de volta para a página anterior
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-promocoes.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Promoções</title>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <!-- Adicione o link para o perfil do usuário -->
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php'; ?>">
                <?php 
                if (isset($_SESSION['usuario_logado'])) {
                   echo 'Bem-vindo, ' . $_SESSION['usuario_logado']['nome'];
                } else {
                    echo 'Faça login';
                }
                ?>
                <?php
                // Adicionar link de logout se o usuário estiver logado
                if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
                    echo '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>';
                }
                ?>
            </a>
            <a class="" href="../carrinho/index-carrinho.php">
                <img class="carrinho" src="../images/carrinho.png" title="carrinho">
                <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>

            </a>
        </nav>
    </header>
    <!-- Fim do cabeçalho -->

    <!-- Título das Promoções -->
    <nav class="titulo"><strong>Promoções<hr></strong></nav>

    <!-- Carrossel de Produtos -->
    <section class="carrossel">
        <?php
        // Verificar se há produtos na categoria "Promoção"
        if ($result->num_rows > 0) {
            // Loop através dos resultados da consulta e exibir os produtos
            while ($row = $result->fetch_assoc()) {
        ?>
                <section class="divisao">
                    <section class="container">
                        <img class="venda" src="../<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>">
                        <h2><?= $row['name'] ?></h2>
                        <p><s>R$ <?= $row['old_price'] ?></s></p>
                        <p class="preco"><strong>R$ <?= $row['price'] ?></strong></p>
                        <p>Quantidade disponível: <?= $row['quantidade'] ?></p> <!-- Display quantity -->
                        <p>À vista no PIX</p>
                        <form method="post">
                            <input type="hidden" name="nome" value="<?= $row['name'] ?>">
                            <input type="hidden" name="preco" value="<?= $row['price'] ?>">
                            <input type="hidden" name="imagem" value="../<?= $row['image_path'] ?>">
                            <button class="btn" type="submit" name="comprar">COMPRAR</button>
                        </form>
                    </section>
                </section>
        <?php
            }
        } else {
            // Se não houver produtos na categoria "Promoção"
            echo "<p>Nenhum produto encontrado.</p>";
        }
        ?>

    </section>
    <!-- Fim do Carrossel de Produtos -->

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
    <!-- Fim do Fale Conosco -->

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
