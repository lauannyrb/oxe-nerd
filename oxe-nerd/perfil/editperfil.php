<?php
include '../conexao.php'; // Arquivo de conexão com o banco de dados
sessao(); // Função que verifica se o usuário está logado
logout(); // Função que realiza o logout
usuarioPrecisaLogar();
editarPerfilUsuario()
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="perfil.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>
<header>
    <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>
        <?php painelDeControleAdm(); ?>
        <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
        <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
        <?php exibirLinksUsuario(); ?>
    </nav>
</header>

    <div class="area-login">
        <div class="login">
            <form action="" method="post">
                <h1>Editar Perfil</h1>
                <label for="novo_nome">Novo Nome:</label>
                <input type="text" id="novo_nome" name="novo_nome">

                <label for="novo_email">Novo Email:</label>
                <input type="email" id="novo_email" name="novo_email">

                <label for="novo_nick">Novo Usuário:</label>
                <input type="text" id="novo_nick" name="novo_nick">

                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha">

                <input type="submit" name="Editar" value="Editar">
            </form>
        </div>
    </div>
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
