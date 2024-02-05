<?php
include "./conexao.php";
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
    <link rel="stylesheet" href="./lista-usuarios.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title> Administrador </title>

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
    <h2 style="margin: 30px auto; width: 80%;">Listagem de Usuarios</h2>
    <section class="lista">
        <div class="lista">
            <div class="esquerda">
                <span class="black" style="width: 10%;">ID: 01</span>
                <span style="width: 70%;">Nome: Cayc Custodio</span>
                <span class="black" style="width: 20%">Senha: 123456</span>
                <div class="direita">
                    <button> <img class="img" src="../images/img_admin/Edit.png" title="Editar"> </button> 
                    <button> <img class="img" src="../images/img_admin/Delete.png" title="Deletar"></button>
                </div>  
            </div>
        </div>
        <div class="lista">
            <div class="esquerda">
                <span class="black" style="width: 10%;">ID: 02</span>
                <span style="width: 70%;">Nome: Leticia Tamarindo</span>
                <span class="black" style="width: 20%">Senha: 543210</span>
                <div class="direita">
                    <button> <img class="img" src="../images/img_admin/Edit.png" title="Editar"> </button> 
                    <button> <img class="img" src="../images/img_admin/Delete.png" title="Deletar"> </button>
                </div>  
            </div>
        </div>
        <div class="lista">
            <div class="esquerda">
                <span class="black" style="width: 10%;">ID: 03</span>
                <span style="width: 70%;">Nome: Elias Neves</span>
                <span class="black" style="width: 20%">Senha: 348759</span>
                <div class="direita">
                    <button> <img class="img" src="../images/img_admin/Edit.png" title="Editar"> </button> 
                    <button> <img class="img" src="../images/img_admin/Delete.png" title="Deletar"> </button>
                </div>  
            </div>
        </div>
        <div class="return">
            <a class="av" href="./admin-home.php"> Voltar </a>
        </div>
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
<!------------- Fale Conosco fim ---------------->
    </body>
</html>