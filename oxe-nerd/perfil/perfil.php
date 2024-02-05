<?php
include '../conexao.php'; // Arquivo de conexão com o banco de dados
sessao(); // Função que verifica se o usuário está logado
logout(); // Função que realiza o logout
$infoUsuario = obterInformacoesUsuario();
$nome_usuario = $infoUsuario['nome_usuario']; // Define o nome de usuário
$email_usuario = $infoUsuario['email_usuario']; // Define o email do usuário
$nome = $infoUsuario['nome_usuario']; // Define o nome do usuário
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="./perfil.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
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

    <div class="area-login">
        <div class="login">
            <form action="" method="post">

                <h1>Perfil do Usuário</h1>
                <p><span>Nome completo:</span> <?= isset($nome) ? $nome : "Nome não disponível" ?></p>
                <p><span>Apelido:</span> <?= isset($nome_usuario) ? $nome_usuario : "Apelido não disponível" ?></p>
                <p><span>Email:</span> <?= isset($email_usuario) ? $email_usuario : "Email não disponível" ?></p>

                <a href="editperfil.php" name='editar'>Editar</a>

                <?php
                if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
                    echo '<a class="" href="excluir_usuario.php?email=' . $_SESSION['usuario_logado']['email'] . '"> Excluir </a>';
                }
                ?>

            </form>
        </div>
    </div>

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
    <!-- Fale Conosco fim -->
</body>

</html>
