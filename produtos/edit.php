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
    <title> Edição de produtos </title>
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

    <style>
        /* Estilo para centralizar os elementos na tela edit.php */
        .description {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;    
        }

        h1 {
            color: #2d1d55;
            text-align: center;
        }

        img .centralizar {
            width: 350px;
        }

        .centralizar {
            background-color: pink;
            padding: 30px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }

        .btn { /*Botão de editar e deletar produto*/
        display: inline-block;
        padding: 10px 70px;
        background-color: #B71ABA;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-color: #B71ABA;
        margin-right: 10px;
        margin-bottom: 5px; 
        }
        .btn:hover {
        background-color: #f890fa;
        }
    </style>



<?php
if (isset($_SESSION['produtos'])) {
    echo "<h1>Lista de Produtos</h1>";

    foreach ($_SESSION['produtos'] as $key => $produto) {
        
        echo "<div class='description'>";
        echo "<form action='' method='post'>";
        
        echo "<div class='centralizar'>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";

        echo "<td><input type='submit' name ='editar' value='Editar' class='btn' /></td>"; // Botão para editar produto
        echo "<td><input type='submit' name ='deletar' value='Deletar' class='btn' /></td>"; // Botão para excluir produto
        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto

        echo "</form>";
        echo "</div>";
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
