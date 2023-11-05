<?php
session_start(); // Inicia a sessão para trabalhar com variáveis de sessão

if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['produtos'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
}

if(isset($_POST['editar'])){
    echo $_POST['indice']; // Exibe o índice do usuário que está sendo editado
    header('Location: editprodt.php?id='.$_POST['indice']); // Redireciona para a página "editarUsuario.php" com o ID do usuário que será editado na URL
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
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

<?php
if (isset($_SESSION['produtos'])) {
    echo "<h1>Lista de Produtos</h1>";

    foreach ($_SESSION['produtos'] as $key => $produto) {
        

        echo "<form action='' method='post'>";
        
        echo "<div>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";

        echo "<td><input type='submit' name ='editar' value='E'/></td>"; // Botão para editar o usuário
        echo "<td><input type='submit' name ='deletar' value='D'/></td>"; // Botão para excluir o usuário
        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do usuário

        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum produto cadastrado ainda.</p>";
}
?>

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
