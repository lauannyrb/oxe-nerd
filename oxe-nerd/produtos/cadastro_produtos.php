<?php
include "../conexao.php";
sessao();
logout();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_produtos.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
    <title>Cadastro de produtos</title>
</head>

<body>

    <!-- Header  -->
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
    <!-- Fim  -->

    <div class="cadastro">
    <form action="processar_cadastro.php" method="post" enctype="multipart/form-data">
        <h1> Nome: <input type="text" name="nome"><br> </h1>
        <h1> Preço: <input type="text" name="preco"><br> </h1>
        <h1> Preço Antigo: <input type="text" name="preco_antigo"><br> </h1>
        <h1> Quantidade: <input type="text" name="quantidade"><br> </h1>
        <h1> Categoria: 
            <select name="categoria">
                <option value="Eletrônicos">Eletrônicos</option>
                <option value="Promoção">Promoção</option>
                <option value="Personalizados">Personalizados</option>
                <option value="Novos Produtos">Novos Produtos</option>
            </select><br>
        </h1>
        <h1> Imagem: <input type="file" name="imagem" accept="image/*"><br><br> </h1>
        <button type="submit">Cadastrar Produto</button><br>
        <a class="btn2" href="../produtos/edit.php"> Lista de produtos </a>
    </form>   
</div>


    <style>
    
    </style>

    <!-- Fale Conosco -->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!-- Fim Fale Conosco -->
</body>
</html>
