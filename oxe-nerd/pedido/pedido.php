<?php
include "../conexao.php";
sessao();
logout();
usuarioPrecisaLogar();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/Logo.svg" type="svg">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="style-pedido.css">
    <title>Pedido</title>
</head>
<body>
<header>
    <img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>
        <?php painelDeControleAdm(); ?>
        <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
        <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
        <?php exibirLinksUsuario(); ?>
    </nav>
</header>

    <section>
        <h1 class="oba">Oba, o seu pedido foi confirmado!<hr></h1>
        <div>
            <!-- aa -->
            <img src="../images/img_pedido/Like.png" alt="Like">
            <div class="detalhes">
                 <h2>Data da Compra : 05/02/2024</h2>
                <h2>Situação do Pedido : Pedido Confirmado </h2>
                <h2>Pedido : #2023UN3P</h2>
            </div>                        
    
        </div>
        <h2 class="obrigado">A OxeNerd agradece sua compra, volte sempre!</h2>
        <a href="../index.php"><button><strong>COMPRE MAIS</strong></button></a>





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