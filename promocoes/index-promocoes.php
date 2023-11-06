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
    <link rel="stylesheet" href="./style-promocoes.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title>Promoções</title>

</head>

<body>
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../produtos/cadastro_produtos.html"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="" href="../login/index-login.php"> Login </a>
            <a class="" href="../carrinho/index-carrinho.php"> <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </nav>
    </header>
    <!-- Fim  -->
    
    <!-- Containers dos Promoções -->
    <nav class="titulo"><strong>Promoções<hr></strong></nav>

    <section class="carrossel"> <!--Primeira linha de produtos-->
        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/camisa.png" alt="Imagem de Camisas"> 
                <h2>Conjunto camisa namorados GAMER</h2>
                <p><s>R$ 65,50</s></p>
                <p class="preco"> <strong>R$45,50</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                        <input type="hidden" name="nome" value="Conjunto camisa namorados GAMER">
                        <input type="hidden" name="preco" value="55.50"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img-promo/camisa.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/camisa_homem_aranha.png" alt="Imagem de Camisa"> 
                <h2>Camiseta Homem Aranha Venoms</h2>
                <p><s>R$ 45,00</s></p>
                <p class="preco"> <strong>R$36,99</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Camiseta Homem Aranha Venoms">
                    <input type="hidden" name="preco" value="35.99"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/camisa_homem_aranha.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/placa_video.png" alt="Imagem da placa"> 
                <h2>Placa de Vídeo PNY GeForce RTX 4090 XLR8</h2>
                <p><s>R$ 7.000,39</s></p>
                <p class="preco"> <strong>R$5.000,39</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Placa de Vídeo PNY GeForce RTX 4090 XLR8">
                    <input type="hidden" name="preco" value="5000.39"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img_perso/Caneca.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/gabinete.png" alt="Imagem de gabinete"> 
                <h2>Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico</h2>
                <p><s>R$ 453,02</s></p>
                <p class="preco"> <strong>R$288,81</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico">
                    <input type="hidden" name="preco" value="288.81"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/gabinete.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>
    </section>

    <section class="carrossel"> <!--Segunda linha de produtos-->
        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/vestido.png" alt="Imagem de vestido"> 
                <h2>Star Guardian Orianna Cosplay Traje League of Legends</h2>
                <p><s>R$ 320,45</s></p>
                <p class="preco"> <strong>R$215,50</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Star Guardian Orianna Cosplay Traje League of Legends">
                    <input type="hidden" name="preco" value="215.50"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/vestido.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/capa2.png" alt="Imagem de capa"> 
                <h2>Capinha para celular GAME ZONE Merilin Cases</h2>
                <p><s>R$ 39,90</s></p>
                <p class="preco"> <strong>R$21,90</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Capinha para celular GAME ZONE Merilin Cases">
                    <input type="hidden" name="preco" value="21.90"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/capa2.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/Caneca.png" alt="Imagem de uma caneca"> 
                <h2>Caneca de GAMER personalizada imperdível</h2>
                <p><s>R$ 25,99</s></p>
                <p class="preco"> <strong>R$15,19</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Caneca de GAMER personalizada imperdível">
                    <input type="hidden" name="preco" value="15.19"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/Caneca.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>

        <section class="divisao"> 
            <section class="container">
                <img class="venda" src="../images/img-promo/Caneca-play-game.png" alt="Imagem de uma caneca"> 
                <h2>Caneca PLAY GAME controle personalizada</h2>
                <p><s>R$ 33,75</s></p>
                <p class="preco"> <strong>R$21,99</strong></p>
                <p>À vista no PIX</p>
                <form method="post">
                    <input type="hidden" name="nome" value="Caneca PLAY GAME controle personalizada">
                    <input type="hidden" name="preco" value="21.99"> <!-- Substitua pelo preço do produto -->
                    <input type="hidden" name="imagem" value="../images/img-promo/Caneca-play-game.png"> <!-- Substitua pelo caminho da imagem do produto -->
                    <button class="btn" type="submit" name="comprar">COMPRAR </button>
                </form>
            </section>
        </section>
    </section>

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