<?php
session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
    exit; // Encerrar o script após o redirecionamento
}

// Verificar se o formulário de compra foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    // Coletar informações do produto do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    // Criar uma array associativa para representar o produto
    $produto = [
        'nome' => $nome,
        'preco' => $preco,
        'imagem' => $imagem,
    ];

    // Verificar se o carrinho já existe na sessão e criar se necessário
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adicionar o produto ao carrinho
    $_SESSION['carrinho'][] = $produto;
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="lista_produtos.css">
</head>
<body>

    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../index.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php'; ?>">
            <?php echo "Bem-vindo(a), $nome_usuario"; ?>
        </a>

        <?php
        // Adicionar link de logout se o usuário estiver logado
        if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
            echo '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>';
        }
        ?>

        <a class="" href="../carrinho/index-carrinho.php">
            <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?>
        </a>
        </nav>
    </header>
    <!-- Fim  -->

    <h1>Lista de Produtos</h1>

    <div class="produtos">
        <?php
        // Conexão com o banco de dados
        $conexao = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

        // Verificar se houve erro na conexão
        if ($conexao->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
        }

        // Consultar os produtos no banco de dados
        $query = "SELECT * FROM produtos";
        $resultado = $conexao->query($query);

        // Verificar se houve erro na consulta
        if (!$resultado) {
            die("Erro na consulta ao banco de dados: " . $conexao->error);
        }

        // Exibir os produtos
        while ($produto = $resultado->fetch_assoc()) {
            ?>
            <div class="produto">
                <img src="<?php echo $produto['imagem']; ?>" alt="Imagem do Produto">
                <h2><?php echo $produto['nome']; ?></h2>
                <p>Preço: R$ <?php echo $produto['preco']; ?></p>
                <form method="post">
                    <input type="hidden" name="nome" value="<?php echo $produto['nome']; ?>">
                    <input type="hidden" name="preco" value="<?php echo $produto['preco']; ?>">
                    <input type="hidden" name="imagem" value="<?php echo $produto['imagem']; ?>">
                    <button class="btn" type="submit" name="comprar">COMPRAR</button>
                </form>
            </div>
            <?php
        }

        // Fechar a conexão com o banco de dados
        $conexao->close();
        ?>
    </div>

    <style>
        /* Estilo para centralizar os elementos na tela */
        .produtos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .produto {
            background-color: #f0f0f0;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .produto img {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }

        .produto h2 {
            margin-bottom: 5px;
        }

        .produto p {
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #B71ABA;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #f890fa;
        }
    </style>

    <!---------------- Fale Conosco inicio ---------------->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!---------------- Fale Conosco fim ---------------->

</body>
</html>