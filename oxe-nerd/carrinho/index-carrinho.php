<?php
session_start();

// Função para conectar ao banco de dados (substitua as informações pelo seu próprio banco)
function conectarAoBanco() {
    include '../conexao.php';

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    return $conn;
}

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
    exit(); // Encerrar o script para evitar que o restante do código seja executado
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

// Se o usuário não estiver logado, redirecionar para a página de login
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login/index-login.php");
    exit();
}

// Calcula o total dos itens no carrinho
$total = 0;

// Calcula o frete dos itens no carrinho
$frete = 0;
$valor = "";

// Processamento do formulário de deletar item do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar'])) {
    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['carrinho'][$indice])) {
            unset($_SESSION['carrinho'][$indice]);
            unset($_SESSION['quantidades'][$indice]);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Processamento do formulário de remover 1 unidade do produto do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_1'])) {
    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['carrinho'][$indice])) {
            $_SESSION['quantidades'][$indice] = max(0, $_SESSION['quantidades'][$indice] - 1);
            if ($_SESSION['quantidades'][$indice] == 0) {
                unset($_SESSION['carrinho'][$indice]);
                unset($_SESSION['quantidades'][$indice]);
            }
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Processamento do formulário de aumentar a quantidade do produto no carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aumentar_quantidade'])) {
    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['carrinho'][$indice])) {
            $_SESSION['quantidades'][$indice] = isset($_SESSION['quantidades'][$indice]) ? $_SESSION['quantidades'][$indice] + 1 : 1;
            
            // Atualizar a quantidade no banco de dados
            $conn = conectarAoBanco();
            $quantidade = $_SESSION['quantidades'][$indice];
            $produto_id = isset($_SESSION['carrinho'][$indice]['id']) ? $_SESSION['carrinho'][$indice]['id'] : null;
            if ($produto_id) {
                $sql = "UPDATE produtos SET quantidade = $quantidade WHERE id = $produto_id";
                $result = $conn->query($sql);
                if ($result === TRUE) {
                    // Quantidade atualizada com sucesso
                } else {
                    echo "Erro ao executar a consulta: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Processamento do formulário de calcular frete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcular_frete'])) {
    if (isset($_POST['frete'])) {
        $opcao_frete = $_POST['frete'];
        $opcoes_fretes = [
            'frete1' => 20.00, // Nordeste
            'frete2' => 15.00, // Norte
            'frete3' => 35.00, // Sul
            'frete4' => 50.00, // Sudeste
            'frete5' => 30.00, // Centro-Oeste
        ];
        if (array_key_exists($opcao_frete, $opcoes_fretes)) {
            $_SESSION['frete'] = $opcoes_fretes[$opcao_frete];
        } else {
            $_SESSION['frete'] = 0.00; // Defina o frete como zero se a opção não for encontrada
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Processamento do formulário de calcular pagamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcularpagamento'])) {
    if (isset($_POST['pagamento'])) {
        $opcao = $_POST['pagamento'];
        $opcoes = [
            'cartão' => "Cartão",
            'pix' => "Pix",
            'boleto' => "Boleto",
        ];
        $valor = array_key_exists($opcao, $opcoes) ? $opcoes[$opcao] : null;
        $_SESSION['pagamento'] = $valor;
    }
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
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
            <div><a class="" href="../promocoes/index-promocoes.php"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php'; ?>">
            <?php echo "Bem-vindo(a), $nome_usuario"; ?></a>

            <?php
            // Adicionar link de logout se o usuário estiver logado
            if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
                echo '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>';
            }
            ?>

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

        <a href="../pedido/pedido.php">
            <button class="butao">FINALIZAR COMPRA</button>
        </a>
        </div>
    </main>
</body>

</html>
