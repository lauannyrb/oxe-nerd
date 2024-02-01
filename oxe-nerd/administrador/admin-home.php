<?php
session_start();

if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'adm') {
    // Se o usuário não for um administrador, redirecioná-lo para a página de login
    header("Location: ../login/index-login.php");
    exit;
}

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comprar'])) {
        // Coletar informações do produto do formulário
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $imagem = $_POST['imagem'];

        // Criar uma array associativa para representar o produto
        $produto = [
            'nome' => $nome,
            'preco' => $preco,
            'imagem' => $imagem,
        ];

        // Verificar se o carrinho já existe na sessão e criar se necessário
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adicionar o produto ao carrinho
        $_SESSION['carrinho'][] = $produto;
    }
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

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
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            // session has not started
            session_start();
        }

        include '../conexao.php'; // Arquivo de conexão com o banco de dados


        // Verificar conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT type_user FROM user WHERE type_user='adm'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $_SESSION['type_user'] = $row["type_user"];
            }
        } else {
        }
        $conn->close();

        if (isset($_SESSION['type_user'])) {
            if ($_SESSION['type_user'] == 'adm') {
                echo '<a class="" href="../admin-home.php"> Painel de Controle Adminstrador </a>';
            } else {
                echo 'User type: ' . $_SESSION['type_user'];
            }
        }
        ?>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="#"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="<?php echo isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php'; ?>">
            <?php echo "Bem-vindo(a), $nome_usuario"; ?>
        </a>

        <?php
        // Adicionar link de logout se o usuário estiver logado
        if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
            echo '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>';
        }
        ?>

        <a class="" href="../carrinho/index-carrinho.php">
            <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            <?php echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0; ?>
        </a>
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
                        <a class="" href="../produtos/-.php"> 
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