<?php
session_start();

if (isset($_SESSION['produtos'])) {
    echo "<h1>Lista de Produtos</h1>";

    foreach ($_SESSION['produtos'] as $key => $produto) {
        echo "<div class='produto'>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        echo "<form action='adicionar_carrinho.php' method='post'>";
        echo "<input type='hidden' name='produto_key' value='$key'>";
        echo "<button type='submit' name='add_to_cart'>Adicionar ao Carrinho</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum produto cadastrado ainda.</p>";
}

?>