<?php
ob_start();

session_start();

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ./index.php"); // Redirecionar para a página inicial após o logout
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>

<header>
    <img class="logo-oxe-nerd" src="images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>

    <?php
if(session_status() == PHP_SESSION_NONE) {
    // session has not started
    session_start();
}



$servername = "mysql";
$username = "oxe-nerd"; 
$password = "oxe-nerd"; 
$dbname = "db_oxe-nerd";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT type_user FROM user WHERE type_user='adm'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $_SESSION['type_user'] = $row["type_user"];
  }
} else {
  
}
$conn->close();

if(isset($_SESSION['type_user'])) {
    if($_SESSION['type_user'] == 'adm') {
        echo '<a class="" href="./produtos/cadastro_produtos.php"> Novos produtos </a>';
    } else {
        echo 'User type: ' . $_SESSION['type_user'];
    }
}
?>

        <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
        <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? './perfil/perfil.php?perfil' : './login/index-login.php'; ?>">
            <?php echo "Bem-vindo(a), $nome_usuario"; ?>
        </a>

        <?php
        // Adicionar link de logout se o usuário estiver logado
        if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
            echo '<a class="" href="?logout=true"> <img class="sair" src="images/sair-branco.png"> </a>';
        }
        ?>

        <a class="" href="./carrinho/index-carrinho.php">
            <img class="carrinho" src="images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?>
        </a>
    </nav>
</header>



    <section class="promo">
        <img src="images\PROMOÇÃO2.png" alt="Imagem da Promoção">
    </section>


    <!-- Anúncios -->
    <section class="carrossel">
        
        <div class="container">
            <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun1.png" alt="Anúncio de Ofeitas de Eletrônicos" title="Anúncio 1"></a>
        </div>
        <div class="container">
            <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun2.png" alt="Monte o seu PC gamer" title="Anúncio 2"></a>
        </div>
        <div class="container">
            <a href="./personalizados/index-personalizados.php"><img class="anuncio" src="images/anun3.png" alt="Monte a sua Coleção de bonecos" title="Anúncio 3"></a>
        </div>
    
    </section>
    <!-------------------------------->

    <!-- Containers com as promoções-->

    <nav class="titulo">
        <strong>Promoções</strong>
        <a href="./promocoes/index-promocoes.php">Ver Mais</a>
    </nav>

    <section id="promocoes" class="carrossel">
        <section class="container">
            <img class="venda" src="./images/tecladin_removebg_preview_8.png" alt="Imagem de venda">
            <h2>Conjunto camisa namorados GAMER</h2>
            <p><s>R$ 65,50</s></p>
            <p class="preco"> <strong>R$ 45,50</strong></p>
            <p>À vista no PIX</p>
            <div class="carrossel"> <!-- Adicionando no carrinho -->
                <form method="post">
                    <input type="hidden" name="nome" value="Conjunto camisa namorados GAMER">
                    <input type="hidden" name="preco" value="45.50"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/tecladin_removebg_preview_8.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </div>
        </section>

        <section class="container">
            <img class="venda" src="./images/vestido.png" alt="Imagem de venda">
            <h2>Star Guardian Orianna Cosplay Traje League of Legends</h2>
            <p><s>R$ 320,45</s></p>
            <p class="preco"> <strong>R$ 215,50</strong></p>
            <p>À vista no PIX</p>
            <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Star Guardian Orianna Cosplay Traje League of Legends">
                        <input type="hidden" name="preco" value="215.50"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/vestido.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
        </section>

        <section class="container">
            <img class="venda" src="images/rtx.png" alt="Imagem de venda">
            <h2>Placa de Vídeo PNY GeForce RTX 4090 XLR8</h2>
            <p><s>R$ 7.000,39</s></p>
            <p class="preco"> <strong>R$5.000,39</strong></p>
            <p>À vista no PIX</p>
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Placa de Vídeo PNY GeForce RTX 4090 XLR8">
                        <input type="hidden" name="preco" value="5000.39"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/rtx.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>            
        </section>

        <section class="container">
            <img class="venda" src="images/Caneca.png" alt="Imagem de venda">
            <h2>Caneca GAMER personalizada<br><strong>imperdível</strong></h2>
            <p><s>R$ 25,99</s></p>
            <p class="preco"> <strong>R$ 15,99</strong></p>
            <p>À vista no PIX</p>
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Caneca GAMER personalizada">
                        <input type="hidden" name="preco" value="15.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/Caneca.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>            
        </section>
    
    </section>

    <!---------------- Fale Conosco ---------------->
    <h2 class="contato">Fale Conosco</h2>

    <section class="contato"> 
        <img class="contato" src="images/whats_roxo.png" alt="Whatsapp"><p class="contato">82 99714-3090</p>
        <img class="contato" src="images/insta_roxo.png" alt="Instagram"><p class="contato">@oxe_nerd</p>
        <img class="contato" src="images/mail_roxo.png" alt="E-Mail"><p class="contato">oxenerdbr@outlook.com</p>
    </section>

    <footer class="roda">
        <strong>OXE NERD<BR>Todos os direitos reservados</strong> 
    </footer>
</body>

</html>
