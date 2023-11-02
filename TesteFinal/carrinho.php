<?php
session_start();

if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['carrinho'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
}

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    echo "<h1>Seu Carrinho de Compras</h1>";

    foreach ($_SESSION['carrinho'] as $key => $produto) {
       
        echo "<form action='' method='post'>"; 

        echo "<div class='item-carrinho'>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        echo "<td><input type='submit' name ='deletar' value='D'/></td>";// Botão para excluir o produto
        
        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do usuário

        echo "</div>";

        echo "</form>";

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