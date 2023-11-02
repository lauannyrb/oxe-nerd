<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>Carrinho de Compras</title>
</head>
<body>
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

        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto
        echo "</div>";

        echo "</form>";

    }

    // Calcula o total dos itens no carrinho
    $total = 0;

    /*foreach ($_SESSION['carrinho'] as $produto) {
        $total += $produto['preco'];
    }

    if($total >= 250){ //Frete gratis a partir de R$250 em compras
        echo "<p> Produtos: R$ " . $total . "</p>";
        echo "Frete de Graça :D";

        echo "<p>Total: R$ " . $total . "</p>"; 
    }else{
        echo "<p> Produtos: R$ " . $total . "</p>";
        echo "Frete: R$50";

        $total = $total + 50; //Valor de frete fixo
        echo "<p>Total: R$ " . $total . "</p>";
        
    } */

    // Teste com frete

    if (isset($_POST['calcular_frete'])) {
        $opcao_frete = $_POST['frete'];
    
        // Você pode associar o valor do frete à opção selecionada
        $opcoes_fretes = [
            'frete1' => 20.00, //Nordeste
            'frete2' => 15.00, //Norte
            'frete3' => 35.00, //Sul
            'frete4' => 50.00, //Sudeste
            'frete5' => 30.00, //Centro-Oeste
        ];
    
        // Verifique se a opção de frete selecionada está no array de opções
        if (array_key_exists($opcao_frete, $opcoes_fretes)) {
            $valor_frete = $opcoes_fretes[$opcao_frete];
        } else {
            // Caso a opção de frete não seja encontrada, defina o frete como zero ou outra ação apropriada
            $valor_frete = 0.00;
        }
    
        // Armazene o valor do frete em uma variável de sessão, se necessário
        $_SESSION['frete'] = $valor_frete;
    }
    
    foreach ($_SESSION['carrinho'] as $produto) {
        $total += $produto['preco'];
    }

    

    if($total >= 500){ //Frete gratis a partir de R$250 em compras
        echo "<p> Produtos: R$ " . $total . "</p>";
        echo "Frete de Graça :D";

        echo "<p>Total: R$ " . $total . "</p>"; 
    }else{
        
        echo "<p> Produtos: R$ " . $total . "</p>";
        // Adicione o valor do frete ao total, se estiver definido na sessão
        if (isset($_SESSION['frete'])) {
            $total += $_SESSION['frete'];
        }
        echo "Frete:R$ ".$_SESSION['frete'];
        echo "<p>Total: R$ " . $total . "</p>";
        
    } 

} else {
    echo "<p>Seu carrinho de compras está vazio.</p>";
}
?>

<form action="" method="post">
    <label for="frete">Selecione a região que você mora:</label>
    <select name="frete" id="frete">
        <option value="frete1">Nordeste R$20</option>
        <option value="frete2">Norte R$15</option>
        <option value="frete3">Sul R$35</option> 
        <option value="frete4">Sudeste R$50</option> 
        <option value="frete5">Centro-Oeste R$30</option> 
    </select>
    <input type="submit" name="calcular_frete" value="Calcular Frete">
</form>

</body>
</html>