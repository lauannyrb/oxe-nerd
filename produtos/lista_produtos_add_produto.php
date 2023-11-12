<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="lista_produtos.css">
</head>

<?php
session_start();

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
?>
<body>

    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="" href="../login/index-login.php"> Login </a>
            <a class="" href="../carrinho/index-carrinho.php"> <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </nav>
    </header>
    <!-- Fim  -->
    
 
<?php



if (isset($_SESSION['produtos'])) {
    echo "<h1>Lista de Produtos<button><a href='../produtos/edit.php'>Editar Produtos </a></button><button><a href='../produtos/cadastro_produtos.php'>Cadastro de Produtos</a></button></h1>    ";


    foreach ($_SESSION['produtos'] as $key => $produto) {


        echo "<div class='description'>";
        echo "<form action='' method='post'>";
        
        echo "<div class='centralizar'>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='nome' value='{$produto['nome']}'>";
        echo "<input type='hidden' name='preco' value='{$produto['preco']}'>";
        echo "<input type='hidden' name='imagem' value='{$produto['imagem']}'>";
        echo "<button class='bnt' type='submit' name='comprar'>COMPRAR</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";










        // echo "<div class='produto'>";
        // echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        // echo "<h2>" . $produto['nome'] . "</h2>";
        // echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        
        // echo "</form>";
        // echo "</div>";
    }
} else {
    echo "<p>Nenhum produto cadastrado ainda.</p>";
}



?>
 <style>
        /* Estilo para centralizar os elementos na tela edit.php */
        .description {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;    
        }

        h1 {
            color: #2d1d55;
            text-align: center;
        }

        img .centralizar {
            width: 350px;
        }

        .centralizar {
            background-color: pink;
            padding: 30px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }

        .btn { /*Botão de editar e deletar produto*/
        display: inline-block;
        padding: 10px 70px;
        background-color: #B71ABA;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-color: #B71ABA;
        margin-right: 10px;
        margin-bottom: 5px; 
        }
        .btn:hover {
        background-color: #f890fa;
        }
    </style>
     <!---------------- Fale Conosco incio ---------------->
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
