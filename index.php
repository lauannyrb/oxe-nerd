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
            <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
            <!-- <a class="Promoções" href="#promocoes"> Promoções</a> -->
            <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="./login/index-login.php"> Login </a>
            <a class="" href="./carrinho/index-carrinho.php"> <img class="carrinho" src="images/carrinho.png" title="carrinho">
            <?php echo count($_SESSION['carrinho']) ?> </a>
        </nav>
    </header>
    <section class="promo">
        <img src="images\PROMOÇÃO2.png" alt="Imagem da Promoção">
    </section>


    <!-- Anúncios -->
    <section class="carrossel">
        
        <div class="container">
            <a href=""><img class="anuncio" src="images/anun1.png" alt="Anúncio de Ofeitas de Eletrônicos" title="Anúncio 1"></a>
        </div>
        <div class="container">
            <a href=""><img class="anuncio" src="images/anun2.png" alt="Monte o seu PC gamer" title="Anúncio 2"></a>
        </div>
        <div class="container">
            <a href=""><img class="anuncio" src="images/anun3.png" alt="Monte a sua Coleção de bonecos" title="Anúncio 3"></a>
        </div>
    
    </section>
    <!-------------------------------->

    <!-- Containers com as promoções-->
    <nav class="titulo"><strong>Promoções</strong></nav>

    <section id="promocoes" class="carrossel">
        <section class="container">
            <img class="venda" src="images\tecladin_removebg_preview_8.png" alt="Imagem de venda">
            <h2>Conjunto camisa namorados GAMER</h2>
            <p><s>R$ 65,50</s></p>
            <p class="preco"> <strong>R$ 45,50</strong></p>
            <p>À vista no PIX</p>
            <div class="carrossel"> <!-- Adicionando no carrinho -->
                <form method="post">
                    <input type="hidden" name="nome" value="Conjunto camisa namorados GAMER">
                    <input type="hidden" name="preco" value="45.50"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="images\tecladin_removebg_preview_8.png""> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </div>
        </section>

        <section class="container">
            <img class="venda" src="images/vestido.png" alt="Imagem de venda">
            <h2>Star Guardian Orianna Cosplay Traje League of Legends</h2>
            <p><s>R$ 65,50</s></p>
            <p class="preco"> <strong>R$ 45,50</strong></p>
            <p>À vista no PIX</p>
            <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Star Guardian Orianna Cosplay Traje League of Legends">
                        <input type="hidden" name="preco" value="45.50"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="images/vestido.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
        </section>

        <section class="container">
            <img class="venda" src="images/rtx.png" alt="Imagem de venda">
            <h2>Placa de Vídeo PNY GeForce RTX 4090 XLR8</h2>
            <p><s>R$ 10.000,50</s></p>
            <p class="preco"> <strong>R$6.999,99</strong></p>
            <p>À vista no PIX</p>
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Placa de Vídeo PNY GeForce RTX 4090 XLR8">
                        <input type="hidden" name="preco" value="6999.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="images/rtx.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>            
        </section>

        <section class="container">
            <img class="venda" src="./images/Caneca.png" alt="Imagem de venda">
            <h2>Caneca GAMER personalizada<br><strong>imperdível</strong></h2>
            <p><s>R$ 25,99</s></p>
            <p class="preco"> <strong>R$ 15,99</strong></p>
            <p>À vista no PIX</p>
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Caneca GAMER personalizada">
                        <input type="hidden" name="preco" value="15.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="/images/Caneca.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>            
        </section>
    
    </section>

    <!---------------- Fale Conosco ---------------->
    <h2 class="contato">Fale Conosco</h2>

    <section class="contato"> 
        <section class="box">82 99714-3090</section>
        <section class="box">@oxe_nerd</section>
        <section class="box">oxenerdbr@outlook.com</section>
    </section>

    <footer class="roda">
        <strong>OXE NERD<BR>Todos os direitos reservados</strong> 
    </footer>
</body>

</html>
