<?php
session_start();

if(isset($_POST['editar'])){
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    echo $nome;

    // Verifique se uma imagem foi enviada
    if (isset($_FILES['imagem'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
            $imagem = $targetFile;
        }
    }

    
        $produto['nome'] = $nome;
        $produto['preco'] =$preco;
        $produto['imagem'] = $imagem;
        $_SESSION['produtos'][$_GET['id']] = $produto;

}



if(isset($_GET['id'])){     
    $produto = $_SESSION['produtos'][$_GET['id']];//vai jogar dentro do key do produtos
}else{
    die('Acesso incompativel');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editprodt.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
    <title>Document</title>
    <title>Document</title>
</head>
<body>

 <!-- Header  -->
 <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../index.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <!-- <a class="" href="#"> Equipamentos </a> -->
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="" href="../login/index-login.php"> Login </a>
            <a class="" href="../carrinho/index-carrinho.php"> <img class="carrinho" src="../images/carrinho.png" title="carrinho"> </a>
        </nav>
    </header>
    <!-- Fim  -->

    <form action="" method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" value= "<?php echo $produto['nome'] ?>"/><br>
        Preço: <input type="text" name="preco" value="<?php echo $produto['preco']?>"><br>
        Imagem: <input type="file" name="imagem" accept="image/*" <?php echo $produto['imagem']?>><br>
        <input type="submit" value="editar" name ='editar'/>
    </form>    

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