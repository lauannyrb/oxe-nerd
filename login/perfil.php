<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css">
    <title>Document</title>
</head>
<body>

    <header>
        <a href="./index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <a class="" href="../produtos/cadastro_produtos.html"> Novos produtos </a>
            <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
            <!-- <a class="Promoções" href="#promocoes"> Promoções</a> -->
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="../login/index-login.php"><?php echo "Bem-vindo(a), $nome_usuario"; ?></a>
            <a class="" href="../carrinho/index-carrinho.php"> <img class="carrinho" src="../images/carrinho.png" title="carrinho">
                <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </nav>
    </header>






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