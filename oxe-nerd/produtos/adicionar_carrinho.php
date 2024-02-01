<?php
session_start();

if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'adm') {
    // Se o usuário não for um administrador, redirecioná-lo para a página de login
    header("Location: ../login/index-login.php");
    exit;
}

if (isset($_POST['add_to_cart']) && isset($_POST['produto_key'])) {
    $produto_key = $_POST['produto_key'];

    // Adicione o produto ao carrinho (use um array de sessão para armazenar os itens do carrinho)
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adicione o produto ao carrinho usando o índice obtido do formulário
    $_SESSION['carrinho'][] = $_SESSION['produtos'][$produto_key];
}

header("Location: lista_produtos_add_produto.php");

?>