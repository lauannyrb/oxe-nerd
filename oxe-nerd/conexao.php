<?php
 $conn = new mysqli("mysql", "oxe-nerd", "oxe-nerd", "db_oxe-nerd");
// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function sessao(){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
function logout(){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
        // Encerrar a sessão
        session_unset();
        session_destroy();
        header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
    }
}
function formularioComprar(){
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
    }
}
function painelDeControleAdm(){
    if (isset($_SESSION['type_user'])) {
        if ($_SESSION['type_user'] == 'adm') {
            echo '<a class="" href="../administrador/admin-home.php"> Painel de Controle Adminstrador </a>';
        } else {
            echo 'User type: ' . $_SESSION['type_user'];
        }
    }
}
function exibirLinksUsuario() {
    $linkPerfil = isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php';
    $mensagemBoasVindas = isset($_SESSION['usuario_logado']) ? 'Bem-vindo, ' . $_SESSION['usuario_logado']['nome'] : 'Faça login';
    $linkLogout = isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado']) ? '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>' : '';
    $quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;

    echo <<<HTML
        <a class="Login" href="{$linkPerfil}">
            {$mensagemBoasVindas}
            {$linkLogout}
        </a>
        <a class="" href="../carrinho/index-carrinho.php">
            <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            {$quantidadeCarrinho}
        </a>
    HTML;
}
function exibirProdutosPromocao4() {
    global $conn; // Adicionar essa linha para acessar a variável $conn dentro da função
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
}
function exibirProdutosPromocao() {
    global $conn; // Adicionar essa linha para acessar a variável $conn dentro da função
    $sql = "SELECT * FROM products WHERE category = 'Promoção'";
    $result = $conn->query($sql);
    // Verificar se há produtos na categoria "Promoção"
    if ($result->num_rows > 0) {
        // Loop através dos resultados da consulta e exibir os produtos
        while ($row = $result->fetch_assoc()) {
            echo '<section class="divisao">';
            echo '<section class="container">';
            echo '<img class="venda" src="../' . $row['image_path'] . '" alt="' . $row['name'] . '">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
            echo '<p class="preco"><strong>R$ ' . $row['price'] . '</strong></p>';
            echo '<p>Quantidade disponível: ' . $row['quantidade'] . '</p>'; // Display quantity
            echo '<p>À vista no PIX</p>';
            echo '<form method="post">';
            echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
            echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
            echo '<input type="hidden" name="imagem" value="../' . $row['image_path'] . '">';
            echo '<button class="btn" type="submit" name="comprar">COMPRAR</button>';
            echo '</form>';
            echo '</section>';
            echo '</section>';
        }
    } else {
        // Se não houver produtos na categoria "Promoção"
        echo "<p>Nenhum produto encontrado.</p>";
    }
}
?>