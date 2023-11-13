<?php
session_start();
if (isset($_SESSION['usuario_logado'])) {
    
} else {
    $nome_usuario = "Faça login";
    $email_usuario = "";
    $senha_usuario = "";
}

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: index.php");
    exit;


if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['usuario_logado'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
}

if(isset($_POST['editar'])){
    echo $_POST['indice']; // Exibe o índice do usuário que está sendo editado
    header('Location: editperfil.php?id='.$_POST['indice']); // Redireciona para a página "editarUsuario.php" com o ID do usuário que será editado na URL
}    
}
?>  
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>
    <header>
        <a href="./index.php"><img class="logo-oxe-nerd" src="images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <a class="" href="./produtos/cadastro_produtos.html"> Novos produtos </a>
            <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
            <!-- <a class="Promoções" href="#promocoes"> Promoções</a> -->
            <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="./login/index-login.php"><?php echo "Bem-vindo(a), " .$_SESSION['usuario_logado']['nome']; ?></a>
            <a class="" href="./carrinho/index-carrinho.php"> <img class="carrinho" src="images/carrinho.png" title="carrinho">
                <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?> </a>
        </nav>
    </header>

 <?php
if (isset($_SESSION['usuario_logado'])) {
    foreach ($_SESSION['usuario_logado'] as $key => $usuariolg) {
        echo "<form action='' method='post'>";

        echo "<h2>" . $usuariolg['nome'] . "</h2>";
        echo "<h2>" . $usuariolg['email'] . "</h2>";
        echo "<p>Senha: " . $usuariolg['senha'] . "</p>";

        echo "
        <input type='hidden' name='nome' value='{$usuariolg['nome']}'>
        <input type='hidden' name='email' value='{$usuariolg['email']}'>
        <input type='hidden' name='senha' value='{$usuariolg['senha']}'>
        ";
        echo "<td><input type='submit' name ='editar' value='Editar' class='btn' /></td>"; // Botão para editar produto
        echo "<td><input type='submit' name ='deletar' value='Deletar' class='btn' /></td>"; // Botão para excluir produto
        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do produto

        echo "</form>";
    }
}
?>
    <section class="perfil">
        <form action="editperfil.php" method="post">
        <h1>Perfil do Usuário</h1>
        <p>Nome: <?php echo $nome_usuario; ?></p>
        <p>Email: <?php echo $email_usuario; ?></p>

        <a href="editperfil.php">Edite seu Perfil</a>
        <a href="logout.php">Sair</a>   
        </form>
    </section>


    <!---------------- Fale Conosco ---------------->
    <h2 class="contato">Fale Conosco</h2>

    <section class="contato">
        <section class="box">82 99714-3090</section>
        <section class="box">@oxe_nerd</section>
        <section class="box">oxenerdbr@outlook.com</section>
    </section>
    <footer class="roda">
        <strong>OXE NERD<BR>Todos os direitos reservados</strong>
    </footer>
</body>

</html>