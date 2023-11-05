<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
// Calcula o total dos itens no carrinho
$total = 0;
// Calcula o frete dos itens no carrinho
$frete = 0;
$valor = "-------------";
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
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <div><a class="" href="../index.php"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <!-- <a class="" href=""> Equipamentos </a> -->
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
        if (isset($_POST['deletar'])) {
            //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
            unset($_SESSION['carrinho'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
            header("Location: " . $_SERVER['PHP_SELF']);
        }

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) { //Construção do Carrinho
        echo "<nav class='titulo'><strong>Meu carrinho <hr></strong></nav>
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

            echo "       
                <div class='des-produto'>
                        <span class='nome-pedido'>" . $produto['nome'] . "</span>
                        <span class='des-pedido'>Vendido e entregue pela OxeNerd</span>
                    </div>
                ";

            echo "       
                <div class='pedido-direita'>
                        
                    <td>
                        <input style='border: none; cursor: pointer;'' class='remover' type='submit' name ='deletar' value='Remover'/>         
                           
                    </td>
                    <input type='number' id='myInput' min='0' max='100' step='1'   value='1' oninput='fixValue2(this)' />
                    <span class='preco'>R$ " . $produto['preco'] . "</span>
                    <span class='entrega'>Em Dezembro</span>                
                    </div>
                ";


            echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto
            echo "</div>";
            echo "</form>";
        }

            
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

            if (isset($_POST['calcularpagamento'])) {
                $opcao = $_POST['pagamento'];
                $opcoes = [
                    'cartão' => "Cartão", 
                    'pix' => "Pix", 
                    'boleto' =>"Boleto", 
                ];
                if (array_key_exists($opcao, $opcoes)) {
                    $valor = $opcoes[$opcao];
                } else {
                    $valor= null;
                }
                $_SESSION['pagamento'] = $valor;
            }         

            foreach ($_SESSION['carrinho'] as $produto) {
                $total += $produto['preco'];
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
                            <span>".$valor."</span>
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
                            <span>". $valor ."</span>
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

        <a href="../pedido/pedido.html">
            <button class="butao">FINALIZAR COMPRA</button>
        </a>
        </div>
    </main>
</body>

</html>