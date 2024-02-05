<?php
include "../conexao.php";
sessao();
logout();
verificarAdm();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin-home.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title> Administrador Home </title>

    <!-- <title>Equipamentos e Eletrônicos</title> -->
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

    <main>
        <div class="menu-admin"> 
                <h1> Administrador </h1>

                <div class="profile-admin"> 
                    <img class="profile" src="../images/img_admin/profile.png" alt="Imagem de perfil">
                    <p class="nick"> admin-admin <p>
                </div>

                <div class="sections">
                    <div class="box">
                        <a class="" href="../produtos/cadastro_produtos.php">
                        <img class="img" src="../images/img_admin/cadastroprodutos.png" alt="Cadastro de produtos"> </a>
                        <h3> Cadastrar novo <br> produto </h3>
                    </div>

                    <div class="box">
                        <a class="" href="../produtos/edit.php"> 
                        <img class="img" src="../images/img_admin/listprodutos.png" alt="Listar produtos"> </a>
                        <h3> Listar produtos </h3> 
                    </div>
                    
                    <div class="box">
                        <a class="" href="../administrador/lista-usuarios.php"> 
                        <img class="img" src="../images/img_admin/listprofiles.png" alt="Listar usuários"> </a>
                        <h3> Listar usuários </h3> 
                    </div>
                </div>
                
                <a class="" href="../login/index-login.php"> <h2> Sair </h2> </a>
                
        </div>
    </main>
 </body>
 <!---------------- Fale Conosco incio ----------------
 <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
</footer>
------------- Fale Conosco fim ---------------->
</html>