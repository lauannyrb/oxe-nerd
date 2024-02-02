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

// Adicionar produto ao carrinho quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    if (isset($_POST['nome'], $_POST['preco'], $_POST['imagem'])) {
        // Obtenha os detalhes do produto do formulário
        $nome_produto = $_POST['nome'];
        $preco_produto = $_POST['preco'];
        $imagem_produto = $_POST['imagem'];

        // Adicione o produto ao carrinho
        $produto = [
            'nome' => $nome_produto,
            'preco' => $preco_produto,
            'imagem' => $imagem_produto,
        ];

        // Inicie a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Inicialize o carrinho se ainda não estiver definido
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adicione o produto ao carrinho
        $_SESSION['carrinho'][] = $produto;

        // Redirecione de volta à página após adicionar o produto ao carrinho
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Restante do código do carrinho...
?>
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

// Adicionar produto ao carrinho quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    if (isset($_POST['nome'], $_POST['preco'], $_POST['imagem'])) {
        // Obtenha os detalhes do produto do formulário
        $nome_produto = $_POST['nome'];
        $preco_produto = $_POST['preco'];
        $imagem_produto = $_POST['imagem'];

        // Adicione o produto ao carrinho
        $produto = [
            'nome' => $nome_produto,
            'preco' => $preco_produto,
            'imagem' => $imagem_produto,
        ];

        // Inicie a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Inicialize o carrinho se ainda não estiver definido
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adicione o produto ao carrinho
        $_SESSION['carrinho'][] = $produto;

        // Redirecione de volta à página após adicionar o produto ao carrinho
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Restante do código do carrinho...
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
        <!-- Seu código do cabeçalho aqui... -->
    </header>
    <!-- Fim  -->

    <main>
        <?php
        // Verifica se o carrinho está vazio
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            // Construção do Carrinho
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

            $total = 0; // Inicializa o total
            foreach ($_SESSION['carrinho'] as $produto) {
                // Exibir detalhes do produto
                echo "<div class='pedido1'>";
                echo "<img class='img-pedido' src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
                echo "<div class='des-produto'>";
                echo "<span class='nome-pedido'>" . $produto['nome'] . "</span>";
                echo "<span class='des-pedido'>Vendido e entregue pela OxeNerd</span>";
                echo "</div>";

                // Calcular subtotal do produto
                $subtotal = $produto['preco'];
                $total += $subtotal; // Adicionar ao total

                // Exibir botão para remover produto do carrinho
                echo "<div class='pedido-direita'>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='indice' value='$key'>";
                echo "<button type='submit' name='deletar'>Remover</button>";
                echo "</form>";
                echo "</div>";

                echo "</div>";
            }

            // Exibir total
            echo "<div class='finalizar'>";
            echo "<span class='totall'>Total</span>";
            echo "<div class='total'>";
            echo "<div class='nome-valores'>";
            echo "<span>Valor Total:</span><br>";
            echo "<span>Forma de Pagamento:</span>";
            echo "</div>";
            echo "<div class='valores'>";
            echo "<span>R$ $total</span>";
            echo "<span>Forma de pagamento selecionada</span>"; // Você precisa adicionar a lógica para mostrar a forma de pagamento selecionada
            echo "</div>";
            echo "</div>";
            echo "</div>";

            // Formulário para calcular frete e escolher a forma de pagamento
            echo "<form action='' method='post'>";
            echo "<label for='frete'>Selecione a região que você mora:</label>";
            echo "<select name='frete' id='frete'>";
            // Opções de frete aqui...
            echo "</select>";
            echo "<input type='submit' name='calcular_frete' value='Calcular Frete'>";
            echo "</form>";

            echo "<label for='pagamento'>Selecione a forma de pagamento:</label>";
            echo "<select name='pagamento' id='pagamento'>";
            // Opções de pagamento aqui...
            echo "</select>";
            echo "<input type='submit' name='calcularpagamento' value='OK'>";
            echo "</form>";

            // Botão para finalizar a compra
            echo "<a href='../pedido/pedido.php'>";
            echo "<button class='butao'>FINALIZAR COMPRA</button>";
            echo "</a>";
        } else {
            // Se o carrinho estiver vazio
            echo "<p>Seu carrinho de compras está vazio.</p>";
        }
        ?>
    </main>
</body>

</html>
