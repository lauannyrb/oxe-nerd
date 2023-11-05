<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-carrinho.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title>Meu carrinho</title>
</head>

<body>
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <div><a class="" href="../index.html"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="" href="../login/index-login.php"> Login </a>
            <a class="" href=""> <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo count($_SESSION['carrinho']) ?>
        </a>
        
        </nav>
    </header>
    <!-- Fim  -->


    <main>

    <?php
if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['carrinho'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
    header("Location: ".$_SERVER['PHP_SELF']);

}

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    echo "<nav class='titulo'><strong>Meu carrinho <hr></strong></nav>";

    echo "
        <div class='descricoes1'>
            <span> Produtos</span>
        </div>

        <div class='descricoes'> 
            <div class='descricoes2'>
                <span>Quantidade</span>
                <span>Preço</span>
                <span>Entrega</span>
            </div>
        </div>";

    foreach ($_SESSION['carrinho'] as $key => $produto) {
       
        echo "<form action='' method='post'>"; 

        echo "<div class='pedido1'>";
        echo "<img class='img-pedido' src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        
        //echo "<h2 class='nome-pedido'>" . $produto['nome'] . "</h2>";
        //echo "<p>Preço: R$ " . $produto['preco'] . "</p>";

        echo"       
        <div class='des-produto'>
                <span class='nome-pedido'>" . $produto['nome'] . "</span>
                <span class='des-pedido'>Vendido e entregue pela OxeNerd</span>
            </div>
        ";

        echo"       
        <div class='pedido-direita'>
                
            <td>
            <input style='border: none; cursor: pointer;'' class='remover' type='submit' name ='deletar' value='Remover'/>            
            </td>
            <input type='number' id='myInput' min='0' max='100' step='1'   value='1' oninput='fixValue2(this)' />
                <span class='preco'>R$ ". $produto['preco'] . "</span>
                <span class='entrega'>Em Dezembro</span>                
            </div>
        ";


        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto
        echo "</div>";
        echo "</form>";

    }

    // Calcula o total dos itens no carrinho
    $total = 0;

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

    

    if($total >= 500){ //Frete gratis a partir de R$500 em compras
        echo "   
        <div class='finalizar' style='margin-top: 25px;' > <!--Espaço para fazer o total do carrinho-->
        <span class='totall'  >Total</span>   
        <div class='total'>  
            <div class='nome-valores'>
                <span>Valor dos produtos:</span><br>
                <span>Frete:</span><br>
                <span>Valor Total:</span>
            </div>
            <div class='valores'>
                <span>R$ " . $total . "</span>
                <span>Frete de Graça :D</span>
                <span>R$ " . $total . "</span>
            </div>

        </div>
        "; 

        
    }else{
        
        echo "   
        <div class='finalizar' style='margin-top: 25px;'> <!--Espaço para fazer o total do carrinho-->
        <span class='totall' >Total</span>   
        <div class='total'>  
            <div class='nome-valores'>
                <span>Valor dos produtos:</span><br>
                <span>Frete:</span><br>
                <span>Valor Total:</span>
            </div>
            <div class='valores'>
                <span>R$ " . $total . "</span>";
        if (isset($_SESSION['frete'])) {
            $total += $_SESSION['frete'];
        }
        echo "
                <span>R$ ".$_SESSION['frete']."</span>
                <span>R$ " . $total . "</span>
            </div>

        </div>
        "; 
        
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
            <a href="../pedido/pedido.html">
                <button class="butao">FINALIZAR COMPRA</button>
            </a>
    </div>
    </main>
</body>
</html>