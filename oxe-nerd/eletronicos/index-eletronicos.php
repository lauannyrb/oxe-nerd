<?php
session_start();

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-eletronicos.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title>Eletrônicos</title>

    <!-- <title>Equipamentos e Eletrônicos</title> -->
</head>

<body>
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="#"> Eletrônicos </a>
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

    <!-- Containers dos Eletrônicos -->
    <nav class="titulo"><strong>Eletrônicos<hr></strong></nav>

    <section class="carrossel"> <!--Primeira linha de produtos-->
        <section class="cinza"> 
            <section class="container">
                <img class="venda" src="../images/img_eletro/RAM.png" alt="Imagem de uma memória Ram"> 
                <h2>RAM RGB, 8GB x 2, 16GB, 32GB, 3200MHz, Memória DDR4 DIMM</h2>
                <p><s>R$ 210,99</s></p>
                <p class="preco"> <strong>R$ 130,99</strong></p>
                <p>À vista no PIX</p>

                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="RAM RGB, 8GB x 2, 16GB, 32GB, 3200MHz, Memória DDR4 DIMM">
                        <input type="hidden" name="preco" value="130.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/RAM.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/gabinete.png" alt="Imagem de uma memória Ram">
                <h2>Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico</h2>
                <p><s>R$ 453,99</s></p>
                <p class="preco"> <strong>R$ 279,99</strong></p>
                <p>À vista no PIX</p>

                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Gabinete Gamer Aerocool Bolt Preto RGB Lateral Acrílico">
                        <input type="hidden" name="preco" value="279.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/gabinete.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/rosa.png" alt="Imagem de uma memória Ram">
                <h2>Gabinete Gamer Lion Rosa USB 3.0 c/ 1 Cooler ARGBMCA-LION/PK</h2>
                <p><s>R$ 453,99</s></p>
                <p class="preco"> <strong>R$ 279,99</strong></p>
                <p>À vista no PIX</p>

                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Gabinete Gamer Lion Rosa USB 3.0 c/ 1 Cooler ARGBMCA-LION/PK">
                        <input type="hidden" name="preco" value="279.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/rosa.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/branco.png" alt="Imagem de uma memória Ram">
                <h2>Gabinete Gamer RGB Neologic Branco - NL-C301W Unica</h2>
                <p><s>R$ 453,99</s></p>
                <p class="preco"> <strong>R$ 279,99</strong></p>
                <p>À vista no PIX</p>

                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Gabinete Gamer RGB Neologic Branco - NL-C301W Unica">
                        <input type="hidden" name="preco" value="279.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/branco.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>
    </section>

    <section class="carrossel"> <!--Segunda linha de produtos-->
        <section class="cinza"> 
            <section class="container">
                <img class="venda" src="../images/img_eletro/monitor.png" alt="Imagem de uma memória Ram"> 
                <h2>Monitor Extream 21,5", Full HD, Led, 75hz, HDMI/VGA, VESA, Flicker Free</h2>
                <p><s>R$ 999,99</s></p>
                <p class="preco"> <strong>R$ 499,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Monitor Extream 21,5, Full HD, Led, 75hz, HDMI/VGA, VESA, Flicker Free">
                        <input type="hidden" name="preco" value="499.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/monitor.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/monitor1.png" alt="Imagem de uma memória Ram">
                <h2>Monitor Led 19,5" 1080p Hdmi Vga Widescreen 16:9 19.5 polegadas Fox</h2>
                <p><s>R$ 999,99</s></p>
                <p class="preco"> <strong>R$ 399,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Monitor Led 19,5 1080p Hdmi Vga Widescreen 16:9 19.5 polegadas Fox">
                        <input type="hidden" name="preco" value="399.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/monitor1.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/monitor2.png" alt="Imagem de uma memória Ram">
                <h2>Monitor Gamer 20" Full HD LED  75Hz HDMI HQ Moba 20GHQ75 Preto e vermelho</h2>
                <p><s>R$ 999,99</s></p>
                <p class="preco"> <strong>R$ 499,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Monitor Gamer 20 Full HD LED  75Hz HDMI HQ Moba 20GHQ75 Preto e vermelho">
                        <input type="hidden" name="preco" value="499.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/monitor2.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza">
            <section class="container">
                <img class="venda" src="../images/img_eletro/rtx.png" alt="Imagem de uma memória Ram">
                <h2>GPU NV RTX3060 12GB 1-CLICK OC GDDR6 192BITS Galax 36NOL7MD1VOC</h2>
                <p><s>R$ 3.199,99</s></p>
                <p class="preco"> <strong>R$ 2.279,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="GPU NV RTX3060 12GB 1-CLICK OC GDDR6 192BITS Galax 36NOL7MD1VOC">
                        <input type="hidden" name="preco" value="2279.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/rtx.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>
    </section>

    <section class="carrossel"> <!--terceira linha de produtos-->
        <section class="cinza"> <!--CPU -->
            <section class="container">
                <img class="venda" src="../images/img_eletro/cpuryzen.png" alt="Imagem de Um Processador AMD Ryzen 5"> 
                <h2>Processador AMD RYZEN Cooler Wraith Stealth RYZEN 5 5500 3.6GHz </h2>
                <p><s>R$ 1.399,99</s></p>
                <p class="preco"> <strong>R$ 549,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Processador AMD RYZEN Cooler Wraith Stealth RYZEN 5 5500 3.6GHzv">
                        <input type="hidden" name="preco" value="549.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/cpuryzen.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza"> <!--Teclado -->
            <section class="container"> 
                <img class="venda" src="../images/img_eletro/teclado.png" alt="Imagem de kit teclado e mouse rosas">
                <h2>Combo Kit Teclado Mouse Gamer E Fone Headset Rosa Rgb Pink </h2>
                <p><s>R$ 630,00</s></p>
                <p class="preco"> <strong>R$ 450,90</strong></p>
                <p>À vista no PIX</p>

                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Combo Kit Teclado Mouse Gamer E Fone Headset Rosa Rgb Pink">
                        <input type="hidden" name="preco" value="450.90"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/teclado.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza"> <!--Teclado -->
            <section class="container">
                <img class="venda" src="../images/img_eletro/teclado1.png" alt="Imagem de kit teclado e mouse">
                <h2>Kit teclado e mouse GAMER exbom USB LED colorido semi mecânino</h2>
                <p><s>R$ 449,99</s></p>
                <p class="preco"> <strong>R$ 199,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="Kit teclado e mouse GAMER exbom USB LED colorido semi mecânino">
                        <input type="hidden" name="preco" value="199.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/teclado1.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
            </section>
        </section>

        <section class="cinza"><!-- SSD -->
            <section class="container">
                <img class="venda" src="../images/img_eletro/SSD.png" alt="Imagem de SOLID STATE DRIVE">
                <h2>SSD 240 GB Kingston A400, SATA, 500MB/s , 350MB/s - SA400S37/240G </h2>
                <p><s>R$ 349,99</s></p>
                <p class="preco"> <strong>R$ 129,99</strong></p>
                <p>À vista no PIX</p>
                
                <div class="carrossel"> <!-- Adicionando no carrinho -->
                    <form method="post">
                        <input type="hidden" name="nome" value="SSD 240 GB Kingston A400, SATA, 500MB/s , 350MB/s - SA400S37/240G">
                        <input type="hidden" name="preco" value="129.99"> <!-- Substitua pelo preço do produto -->
                        <input type="hidden" name="imagem" value="../images/img_eletro/SSD.png"> <!-- Substitua pelo caminho da imagem do produto -->
                        <button class="btn" type="submit" name="comprar">COMPRAR </button>
                    </form>
                </div>
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