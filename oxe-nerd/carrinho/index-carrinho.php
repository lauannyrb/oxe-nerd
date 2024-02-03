<?php
session_start();

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

// Calcula o total dos itens no carrinho
$total = 0;
// Calcula o frete dos itens no carrinho
$frete = 0;
$valor = "";

if (isset($_POST['deletar'])) {
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['carrinho'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
    header("Location: " . $_SERVER['PHP_SELF']);
}


if (isset($_POST['remover_1'])) {
    $indice = $_POST['indice'];

    // Verifique se o índice existe no carrinho
    if (isset($_SESSION['carrinho'][$indice])) {
        // Reduza a quantidade do produto em 1
        $_SESSION['quantidades'][$indice] = max(0, $_SESSION['quantidades'][$indice] - 1);

        // Se a quantidade chegar a 0, remova o produto do carrinho
        if ($_SESSION['quantidades'][$indice] == 0) {
            unset($_SESSION['carrinho'][$indice]);
            unset($_SESSION['quantidades'][$indice]);
        }
    } else {
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

if (isset($_POST['aumentar_quantidade'])) {
    $indice_produto = $_POST['indice'];

    // Verifique se a quantidade já foi definida na sessão
    if (!isset($_SESSION['quantidades'][$indice_produto])) {
        $_SESSION['quantidades'][$indice_produto] = 1;
    } else {
        $_SESSION['quantidades'][$indice_produto]++;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
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
        'boleto' => "Boleto",
    ];
    if (array_key_exists($opcao, $opcoes)) {
        $valor = $opcoes[$opcao];
    } else {
        $valor = null;
    }
    $_SESSION['pagamento'] = $valor;
}

// Conexão com o banco de dados (substitua pelos seus próprios dados)
include '../conexao.php';

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o carrinho foi submetido
    if (isset($_POST['finalizar_compra'])) {
        // Itera sobre os itens do carrinho
        foreach ($_SESSION['carrinho'] as $key => $produto) {
            if (isset($produto['id'])) { // Verifica se a chave 'id' existe no produto
                $product_id = $produto['id'];
                $quantity = $_SESSION['quantidades'][$key];

                // Atualiza a quantidade do produto no banco de dados
                $sql = "UPDATE products SET quantidade = quantidade - $quantity WHERE id = $product_id";

                if ($conn->query($sql) !== TRUE) {
                    echo "Erro ao atualizar a quantidade do produto: " . $conn->error;
                    // Aqui você pode decidir se deseja parar o processo em caso de erro ou continuar atualizando os outros produtos
                }
            } else {
                echo "ID do produto inválido.";
            }
        }

        // Limpa o carrinho após a compra ser finalizada
        $_SESSION['carrinho'] = array();
        $_SESSION['quantidades'] = array();

        echo "Compra finalizada com sucesso!";
    }
}

// Exiba o carrinho e o formulário de finalização da compra aqui...

$conn->close();

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
        <?php
        if (isset($_SESSION['type_user'])) {
            if ($_SESSION['type_user'] == 'adm') {
                echo '<a class="" href="../administrador/admin-home.php"> Painel de Controle Adminstrador </a>';
            } else {
                echo 'User type: ' . $_SESSION['type_user'];
            }
        }
        ?>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
            <div><a class="" href="../promocoes/index-promocoes.php"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <!-- Adicione o link para o perfil do usuário -->
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : './login/index-login.php'; ?>">
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

            <a class="" href="#"> <img class="carrinho" src="../images/carrinho.png" title="carrinho">
                <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
            </a>

        </nav>
    </header>
    <!-- Fim  -->


    <main>

        <?php

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
            <td>
                <input type='submit' name='aumentar_quantidade' value='+' />                                   
            </td>
            <span class='quantidade' style='text-align: center; /* Centraliza o texto dentro do input */
            width: 50px; /* Define a largura do input */
            height: 50px;
            font-size: 30px; /* Define o tamanho da fonte */
            margin: 30px;
            border: none;
            font-size: 30px;
            font-weight: 700;
          '>" . (isset($_SESSION['quantidades'][$key]) ? $_SESSION['quantidades'][$key] : 1) . "</span>
            <td>
                <input type='submit' name='remover_1' value='-' />
            </td>
            <span class='preco'>R$ " . $produto['preco'] . "</span>
            <span class='entrega'>Em Dezembro</span>   
            <span class='subtotal' style='  font-style: normal;
            font-weight: 600;
            font-size: 20px;
            margin-left: 25px;
            margin-right:10px;
            line-height: 23px;
            width: 100px;'>R$ " . number_format($subtotal, 2) . "</span>             
            </div>

        ";

                // Adicione ou atualize o produto no carrinho
                $_SESSION['carrinho'][$key] = [
                    'nome' => $produto['nome'],
                    'preco' => $produto['preco'],
                    'imagem' => $produto['imagem'],
                    'quantidade' => $quantidade,
                ];


                echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto
                echo "</div>";
                echo "</form>";
            }


            /*            foreach ($_SESSION['carrinho'] as $produto) {
                    $total += $produto['preco'];
                }
+*/
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
        <form method="post">
            <input type="hidden" name="finalizar_compra" value="1">
            <input type="submit" value="Finalizar Compra">
        </form>

        </div>
    </main>
</body>

</html>
