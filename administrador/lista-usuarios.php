<?php
session_start();

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
    <link rel="stylesheet" href="./lista-usuarios.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png" >
    <title> Administrador </title>

</head>

<body>
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../produtos/cadastro_produtos.php"> Novos produtos </a>
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