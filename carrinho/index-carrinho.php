<?php     
    // Iniciar a sessão
session_start();

    // Array de produtos (substitua com seus próprios produtos)
    $produtos = [
        [
            'id' => 1,
            'nome' => 'Caneca GAMER personalizada',
            'preco' => 19.99,
            'imagem' => '.\img\caneco.png'
        ],
        [
            'id' => 2,
            'nome' => 'MEMORIA  RAM  T-FORCE  DELTA RGB, 8GB DDR4, 3000MHZ',
            'preco' => 24.99,
            'imagem' => '.\img\memoria.png'
        ],
        [
            'id' => 3,
            'nome' => 'MEMORIA  RAM  T-FORCE  DELTA RGB, 16GB DDR4, 3000MHZ',
            'preco' => 49.99,
            'imagem' => '.\img\memoria.png'
        ]
    ];
    

    // Função para adicionar um produto ao carrinho
function adicionarAoCarrinho($produtoId, $quantidade) {
    // Inicialize o carrinho de compras se ainda não existir
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifique se o produto já está no carrinho
    if (isset($_SESSION['carrinho'][$produtoId])) {
        // Se o produto já estiver no carrinho, atualize a quantidade
        $_SESSION['carrinho'][$produtoId] += $quantidade;
    } else {
        // Caso contrário, adicione o produto ao carrinho
        $_SESSION['carrinho'][$produtoId] = $quantidade;
    }
}

// Função para exibir o carrinho
function exibirCarrinho() {
    if (!empty($_SESSION['carrinho'])) {
        $total = 0;
        foreach ($_SESSION['carrinho'] as $produtoId => $quantidade) {
            $produto = buscarProdutoPorId($produtoId);
            if ($produto) {
                $subtotal = $quantidade * $produto['preco'];
                $total += $subtotal;
                echo "Produto: " . $produto['nome'] . "<br>";
                echo "Quantidade: " . $quantidade . "<br>";
                echo "Preço: $" . $produto['preco'] . "<br>";
                echo "Imagem: <img src='" . $produto['imagem'] . "' alt='Imagem do Produto'><br>";
                echo "Subtotal: $" . $subtotal . "<br>";
                // Adicionar botão para adicionar mais
                echo '<form method="post">';
                echo '<input type="hidden" name="produto_id" value="' . $produto['id'] . '">';
                echo '<input type="hidden" name="acao" value="adicionar">';
                echo '<input type="submit" value="Adicionar Mais">';
                echo '</form>';
                // Adicionar botão para remover um
                echo '<form method="post">';
                echo '<input type="hidden" name="produto_id" value="' . $produto['id'] . '">';
                echo '<input type="hidden" name="acao" value="remover">';
                echo '<input type="submit" value="Remover Um">';
                echo '</form>';
                echo "<hr>";
            }
        }
        echo "Total: $" . $total;
    } else {
        echo "Carrinho vazio";
    }
}

// Função para buscar um produto por ID
function buscarProdutoPorId($produtoId) {
    global $produtos;
    foreach ($produtos as $produto) {
        if ($produto['id'] == $produtoId) {
            return $produto;
        }
    }
    return null;
}



// Verificar se um produto foi adicionado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['produto_id'])) {
        $produtoId = $_POST['produto_id'];
        if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar') {
            adicionarAoCarrinho($produtoId, 1);
        } elseif (isset($_POST['acao']) && $_POST['acao'] === 'remover') {
            if (isset($_SESSION['carrinho'][$produtoId]) && $_SESSION['carrinho'][$produtoId] > 1) {
                $_SESSION['carrinho'][$produtoId] -= 1;
            } else {
                unset($_SESSION['carrinho'][$produtoId]);
            }
        }
    }
}
    ?>


<!DOCTYPE html>
<html lang="en">

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
        <a href="../index.html"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <div><a class="" href="../index.html"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.html"> Eletrônicos </a>
            <!-- <a class="" href=""> Equipamentos </a> -->
            <a class="" href="../personalizados/index-personalizados.html"> Personalizados </a>
            <a class="" href="../login/index-login.html"> Login </a>
            <a class="" href=""> <img class="carrinho" src="../images/carrinho.png" title="carrinho"> </a>
        </nav>
    </header>
    <!-- Fim  -->

    <h1>Lista de Produtos</h1>

    <ul>
        <?php foreach ($produtos as $produto): ?>
            <li>
                <img src="<?php echo $produto['imagem']; ?>" alt="Imagem do <?php echo $produto['nome']; ?>">
                <h2><?php echo $produto['nome']; ?></h2>
                <p>Preço: $<?php echo $produto['preco']; ?></p>
                <!-- Formulário para adicionar produtos ao carrinho -->
                <form method="post">
                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                    <input type="hidden" name="acao" value="adicionar">
                    <input type="submit" value="Adicionar ao Carrinho">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Carrinho</h2>
    <?php exibirCarrinho(); ?>

    <main>
        <nav class="titulo"><strong>Meu carrinho <hr></strong></nav>
        
        <div class="descricoes1">
            <span> Produtos</span>
        </div>

        <div class="descricoes"> 
            <div class="descricoes2">
                <span>Quantidade</span>
                <span>Preço</span>
                <span>Entrega</span>
            </div>
        </div>


        <div class="pedido1">
            <div class="img-pedido"> 
                <img src="./img/caneco.png" alt="Caneca game"></div>
            <div class="des-produto">
                <span class="nome-pedido">Caneca GAMER personalizada</span>
                <span class="des-pedido">Vendido e Entregue pela OxeNerd</span>
            </div>
            <div class="pedido-direita">
                <span class="remover">Remover</span>
                <input type="number" id="myInput" min="0" max="100" step="1" value="2" oninput="fixValue(this)" />
                <span class="preco">31,98</span>
                <span class="entrega">Entre 14 e 19 de Junho</span>                
            </div>

        </div>

        <!-- ----------------PEdido 2:------------------>

        <div class="pedido2">
            <div class="img-pedido"> 
                <img src="./img/memoriaa.png" alt="memoria"></div>
            <div class="des-produto">
                <span class="nome-pedido2">MEMORIA  RAM  T-FORCE  DELTA RGB, 8GB
                    DDR4, 3000MHZ</span>
                <span class="des-pedido">Vendido e Entregue pela OxeNerd</span>
            </div>
            <div class="pedido-direita2">
                <span class="remover">Remover</span>
                <input type="number" id="myInput" min="0" max="100" step="1" value="1" oninput="fixValue2(this)" />
                <span class="preco">99,99</span>
                <span class="entrega">Entre 14 e 19 de Junho</span>                
            </div>

        </div>
    <div class="finalizar">
        <span class="totall">Total</span>   
        <div class="total">
             
            <div class="nome-valores">
                <span>Valor dos produtos:</span><br>
                <span>Frete:</span><br>
                <span>Valor Total:</span>
            </div>
            <div class="valores">
                <span>R$ 31,98</span>
                <span>R$99,99</span>
                <span>R$131,97</span>
            </div>

        </div>
      
            <a href="../pedido/pedido.html">

                <button class="butao">FINALIZAR COMPRA</button>
            </a>
    </div>
<body>
    
</body>
</html>