<?php
session_start();

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    echo "<h1>Seu Carrinho de Compras</h1>";

    foreach ($_SESSION['carrinho'] as $produto) {
        echo "<div class='item-carrinho'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        echo "</div>";
    }

    // Calcula o total dos itens no carrinho
    $total = 0;
    foreach ($_SESSION['carrinho'] as $produto) {
        $total += $produto['preco'];
    }

    echo "<p>Total: R$ " . $total . "</p>";
} else {
    echo "<p>Seu carrinho de compras está vazio.</p>";
}

?>