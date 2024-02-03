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
    <title>OXE NERD</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>

<header>
    <img class="logo-oxe-nerd" src="images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
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
        <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
        <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
        <!-- Adicione o link para o perfil do usuário -->
        <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? './perfil/perfil.php' : './login/index-login.php'; ?>">
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
        <a class="" href="./carrinho/index-carrinho.php">
            <img class="carrinho" src="images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </a>
    </nav>
</header>

<section class="promo">
    <img src="images\PROMOÇÃO2.png" alt="Imagem da Promoção">
</section>

<!-- Anúncios -->
<section class="carrossel">

    <div class="container">
        <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun1.png" alt="Anúncio de Ofeitas de Eletrônicos" title="Anúncio 1"></a>
    </div>
    <div class="container">
        <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun2.png" alt="Monte o seu PC gamer" title="Anúncio 2"></a>
    </div>
    <div class="container">
        <a href="./personalizados/index-personalizados.php"><img class="anuncio" src="images/anun3.png" alt="Monte a sua Coleção de bonecos" title="Anúncio 3"></a>
    </div>

</section>
<!-------------------------------->

<!-- Containers com as promoções-->

<nav class="titulo">
    <strong>Promoções</strong>
    <a href="./promocoes/index-promocoes.php">Ver Mais</a>
</nav>

<section id="promocoes" class="carrossel">
<?php
include './conexao.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE category = 'Promoção'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        if ($count >= 4) {
            break;
        }
        echo '<section class="container">';
        echo '<img class="venda" src="' . $row['image_path'] . '" alt="Imagem de venda">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
        echo '<p class="preco"> <strong>R$ ' . $row['price'] . '</strong></p>';
        echo '<p>Quantidade disponível: ' . $row['quantidade'] . '</p>'; // Display quantity
        echo '<p>À vista no PIX</p>';
        echo '<div class="carrossel">';
        echo '<form method="post">';
        echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
        echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
        echo '<input type="hidden" name="imagem" value="' . $row['image_path'] . '">';
        echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
        echo '</form>';
        echo '</div>';
        echo '</section>';

        $count++;
    }
} else {
    echo "Nenhum produto em promoção no momento.";
}
$conn->close();
?>

</section>

</section>

<!---------------- Fale Conosco ---------------->
<h2 class="contato">Fale Conosco</h2>

<section class="contato">
    <img class="contato" src="images/whats_roxo.png" alt="Whatsapp"><p class="contato">82 99714-3090</p>
    <img class="contato" src="images/insta_roxo.png" alt="Instagram"><p class="contato">@oxe_nerd</p>
    <img class="contato" src="images/mail_roxo.png" alt="E-Mail"><p class="contato">oxenerdbr@outlook.com</p>
</section>

<footer class="roda">
    <strong>OXE NERD<BR>Todos os direitos reservados</strong>
</footer>
</body>

</html>
