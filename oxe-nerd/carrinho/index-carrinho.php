<?php
session_start();
include '../conexao.php';

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

// Supondo que o usuário clicou em "FINALIZAR COMPRA" e o carrinho não está vazio
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $key => $produto) {
        // Verificar se a chave 'id' está definida no produto
        if (isset($produto['id'])) {
            // Obter o ID do produto
            $produto_id = $produto['id'];

            // Obter a quantidade vendida deste produto do carrinho
            $quantidade_vendida = isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1;

            // Construir e executar a consulta SQL para atualizar a quantidade disponível no banco de dados
            $sql_update = "UPDATE products SET quantidade = quantidade - $quantidade_vendida WHERE id = $produto_id";

            if ($conn->query($sql_update) === TRUE) {
                // Atualização bem-sucedida
                // Você pode adicionar mais lógica aqui, se necessário
            } else {
                // Erro ao atualizar o banco de dados
                echo "Erro ao atualizar o estoque do produto com ID $produto_id: " . $conn->error;
            }
        } else {
            // A chave 'id' não está definida no produto
            echo "Erro: A chave 'id' não está definida para o produto na posição $key.";
        }
    }
}

// Função para aumentar a quantidade de um produto no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aumentar_quantidade'])) {
    $indice = $_POST['indice'];
    if (isset($_SESSION['quantidades'][$indice])) {
        $_SESSION['quantidades'][$indice]++;
    }
}

// Função para diminuir a quantidade de um produto no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['diminuir_quantidade'])) {
    $indice = $_POST['indice'];
    if (isset($_SESSION['quantidades'][$indice]) && $_SESSION['quantidades'][$indice] > 1) {
        $_SESSION['quantidades'][$indice]--;
    }
}

// Função para remover um produto do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_produto'])) {
    $indice = $_POST['indice'];
    unset($_SESSION['carrinho'][$indice]);
    unset($_SESSION['quantidades'][$indice]);
    // Redirecionar para evitar o reenvio do formulário
    header("Location: ./index-carrinho.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-carrinho.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Meu carrinho</title>
</head>

<body>
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
            <nav>
                <?php painelDeControleAdm(); ?>
                <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos </a>
                <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
                <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
                <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
                <?php exibirLinksUsuario(); ?>
            </nav>
    </header>
    <!-- Fim  -->


    <main>

        <?php

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) { //Construção do Carrinho

            echo "
        <nav class='titulo'><strong>Meu carrinho <hr></strong></nav>
        <div class='descricoes1'>
            <span> Produtos</span>
        </div>

        <div class='descricoes'> 
            <div class='descricoes2'>
                <span>Quantidade</span>
                <span style='margin-right: 40px;' >Preço</span>
                <span>Entrega</span>
                <span>Total</span>
            </div>
        </div>";
            foreach ($_SESSION['carrinho'] as $key => $produto) {
                echo "<form action='' method='post'>";
                echo "<div class='pedido1'>";
                echo "<img class='img-pedido' src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";

                echo "       
        <div class='des-produto'>
                <span class='nome-pedido'>" . $produto['nome'] . "</span>
                <span class='des-pedido'>Vendido e entregue pela OxeNerd</span>
            </div>
        ";

                $subtotal = $produto['preco'] * (isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1);
                $quantidade = isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1;
                echo "          
        <div class='pedido-direita'>
            
            <form action='' method='post'>
                <input type='hidden' name='indice' value='$key'/>
                <button type='submit' name='diminuir_quantidade'>-</button>
            </form>
            
            <span class='quantidade' style='text-align: center;
                width: 50px; 
                height: 50px;
                font-size: 30px; 
                margin: 30px;
                border: none;
                font-size: 30px;
                font-weight: 700;'>" .
                    (isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1) . "
            </span>
            
            <form action='' method='post'>
                <input type='hidden' name='indice' value='$key'/>
                <button type='submit' name='aumentar_quantidade'>+</button>
            </form>

            <span class='preco'>R$ " . $produto['preco'] . "</span>
            <span class='entrega'> Em Janeiro </span>   
            <span class='subtotal' style='font-style: normal;
                font-weight: 600;
                font-size: 20px;
                margin-left: 25px;
                margin-right:10px;
                line-height: 23px;
                width: 100px;'>
                    R$ " . number_format($subtotal, 2) . "
            </span>             
        </div>";

                echo "<div class='remover-produto'>
                    <form action='' method='post'>
                        <input type='hidden' name='indice' value='$key'/>
                        <button type='submit' name='remover_produto'>Remover</button>
                    </form>
                </div>";

                echo "</div>";
                echo "</form>";
            }

            foreach ($_SESSION['carrinho'] as $key => $produto) {
                $subtotal = $produto['preco'] * (isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1);
                $total += $subtotal;
            }

            if ($total >= 500) { //Frete gratis a partir de R$500 em compras
                echo "
            <div class='finalizar' style='margin-top: 25px;' > <!--Espaço para fazer o total do carrinho-->
            <span class='totall'  >Total</span>   
            <div class='total'>  
                <div class='nome-valores'>
                    <span>Valor dos produtos:</span><br>
                    <span>Frete:</span><br>
                    <span>Valor Total:</span><br> 
                    <span>Forma de Pagamento:</span>
                </div>
                <div class='valores'>
                    <span>R$ " . $total . "</span>
                    <span>Frete de Graça :D</span>
                    <span>R$ " . $total . "</span>
                    <span>" . $valor . "</span>
                </div>

            </div>
            ";
            } else {
                echo "
            <div class='finalizar' style='margin-top: 25px;'> <!--Espaço para fazer o total do carrinho-->
            <span class='totall' >Total</span>   
            <div class='total'>  
                <div class='nome-valores' >
                    <span>Valor dos produtos:</span><br>
                    <span>Frete:</span><br>
                    <span>Valor Total:</span><br>
                    <span>Forma de Pagamento:</span>
                </div>
                <div class='valores'>
                    <span>R$ " . $total . "</span>";
                if (isset($_SESSION['frete'])) {
                    $frete = $_SESSION['frete'];
                    $total += $_SESSION['frete'];
                }
                echo "
                    <span>R$ " .  $frete . "</span>
                    <span>R$ " . $total . "</span>
                    <span>" . $valor . "</span>
                </div>

            </div>
            ";
            }
        } else {
            echo "<p>Seu carrinho de compras está vazio.</p>";
        }
        ?>

        <form style="margin-top: 15px;" action="" method="post">
            <div style="margin-bottom: 15px;">
                <label for="frete">Selecione a região que você mora:</label>

                <select name="frete" id="frete">
                    <option value="frete1">Nordeste R$20</option>
                    <option value="frete2">Norte R$15</option>
                    <option value="frete3">Sul R$35</option>
                    <option value="frete4">Sudeste R$50</option>
                    <option value="frete5">Centro-Oeste R$30</option>
                </select>
                <input type="submit" name="calcular_frete" value="Calcular Frete">
            </div>

            <label for>Selecione a forma de pagamento:</label>

            <select name="pagamento" id="pagamento">
                <option value="cartão">Cartão</option>
                <option value="pix">Pix</option>
                <option value="boleto">Boleto</option>
            </select>
            <input type="submit" name="calcularpagamento" value="OK">
        </form>

        <a href="../pedido/pedido.php">
            <button class="butao">FINALIZAR COMPRA</button>
        </a>
    </main>
</body>

</html>
