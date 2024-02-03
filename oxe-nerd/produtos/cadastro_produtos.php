<?php
session_start();


// if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'adm') {
//     // Se o usuário não for um administrador, redirecioná-lo para a página de login
//     header("Location: ../login/index-login.php");
//     exit;
// }

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comprar'])) {
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
}
// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_produtos.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
    <title>Cadastro de produtos</title>
</head>

<body>

    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="#"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
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

    <div class="cadastro">
    <form action="processar_cadastro.php" method="post" enctype="multipart/form-data">
        <h1> Nome: <input type="text" name="nome"><br> </h1>
        <h1> Preço: <input type="text" name="preco"><br> </h1>
        <h1> Preço Antigo: <input type="text" name="preco_antigo"><br> </h1>
        <h1> Quantidade: <input type="text" name="quantidade"><br> </h1>
        <h1> Categoria: 
            <select name="categoria">
                <option value="Eletrônicos">Eletrônicos</option>
                <option value="Promoção">Promoção</option>
                <option value="Personalizados">Personalizados</option>
                <option value="Novos Produtos">Novos Produtos</option>
            </select><br>
        </h1>
        <h1> Imagem: <input type="file" name="imagem" accept="image/*"><br><br> </h1>
        <button type="submit">Cadastrar Produto</button><br>
        <a class="btn2" href="../produtos/lista_produtos_add_produto.php"> Lista de produtos </a>
    </form>   
</div>


    <style>
    .cadastro .btn2 {
        background-color: #fff(94, 94, 139);
        text-align: center;
        color: purple;
        padding: 10px 10px; /* Ajuste do preenchimento */
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        display:block;
        font-size: 15px;
    }
    </style>

    <!-- Fale Conosco -->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!-- Fim Fale Conosco -->
</body>
</html>
