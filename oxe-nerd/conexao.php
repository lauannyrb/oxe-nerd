<?php

$conn = new mysqli("mysql", "oxe-nerd", "oxe-nerd", "db_oxe-nerd");
// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function sessao(){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
function logout(){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
        // Encerrar a sessão
        session_unset();
        session_destroy();
        header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
    }
}
function formularioComprar(){
    // Verificar se o formulário de compra foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
        // Verificar se o carrinho existe na sessão
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        // Adicionar o produto ao carrinho
        $produto = [
            'nome' => $_POST['nome'],
            'preco' => $_POST['preco'],
            'imagem' => $_POST['imagem'],
            'quantidade' => 1 // Definir quantidade inicial como 1
        ];
        $_SESSION['carrinho'][] = $produto;
        // Redirecionar de volta para a página anterior
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
function painelDeControleAdm(){
    if (isset($_SESSION['type_user'])) {
        if ($_SESSION['type_user'] == 'adm') {
            echo '<a class="" href="../administrador/admin-home.php"> Painel de Controle Adminstrador </a>';
        } else {
            echo 'User type: ' . $_SESSION['type_user'];
        }
    }
}
function exibirLinksUsuario() {
    $linkPerfil = isset($_SESSION['usuario_logado']) ? '../perfil/perfil.php' : '../login/index-login.php';
    $mensagemBoasVindas = isset($_SESSION['usuario_logado']) ? 'Bem-vindo, ' . $_SESSION['usuario_logado']['nome'] : 'Faça login';
    $linkLogout = isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado']) ? '<a class="" href="?logout=true"> <img class="sair" src="../images/sair-branco.png"> </a>' : '';
    $quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;

    echo <<<HTML
        <a class="Login" href="{$linkPerfil}">
            {$mensagemBoasVindas}
            {$linkLogout}
        </a>
        <a class="" href="../carrinho/index-carrinho.php">
            <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            {$quantidadeCarrinho}
        </a>
    HTML;
}
function exibirProdutosPromocao4() {
    global $conn; // Adicionar essa linha para acessar a variável $conn dentro da função
    $sql = "SELECT * FROM products WHERE category = 'Promoção'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count >= 4) {
                break;
            }
                echo '<section class="container">';
                echo '<img class="venda" src="' . $row['image_path'] . '" alt="Imagem de venda">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
                echo '<p class="preco"> <strong>R$ ' . $row['price'] . '</strong></p>';
                echo '<p>Quantidade disponível: ' . $row['quantidade'] . '</p>'; // Display quantity
                echo '<p>À vista no PIX</p>';
                echo '<div class="carrossel">';
                echo '<form method="post">';
                echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
                echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="imagem" value="' . $row['image_path'] . '">';
                echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
                echo '</form>';
                echo '</div>';
                echo '</section>';

            $count++;
        }
    } else {
        echo "Nenhum produto em promoção no momento.";
    }
    $conn->close();
}
function exibirProdutosPromocao() {
    global $conn; // Adicionar essa linha para acessar a variável $conn dentro da função
    $sql = "SELECT * FROM products WHERE category = 'Promoção'";
    $result = $conn->query($sql);
    // Verificar se há produtos na categoria "Promoção"
    if ($result->num_rows > 0) {
        // Loop através dos resultados da consulta e exibir os produtos
        while ($row = $result->fetch_assoc()) {
            echo '<section class="divisao">';
            echo '<section class="container">';
            echo '<img class="venda" src="../' . $row['image_path'] . '" alt="' . $row['name'] . '">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
            echo '<p class="preco"><strong>R$ ' . $row['price'] . '</strong></p>';
            echo '<p>Quantidade disponível: ' . $row['quantidade'] . '</p>'; // Display quantity
            echo '<p>À vista no PIX</p>';
            echo '<form method="post">';
            echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
            echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
            echo '<input type="hidden" name="imagem" value="../' . $row['image_path'] . '">';
            echo '<button class="btn" type="submit" name="comprar">COMPRAR</button>';
            echo '</form>';
            echo '</section>';
            echo '</section>';
        }
    } else {
        // Se não houver produtos na categoria "Promoção"
        echo "<p>Nenhum produto encontrado.</p>";
    }
}
function exibirNovosProdutos() {
    // Consulta SQL para selecionar os produtos da categoria "Novos Produto"
    global $conn; // Adicionar essa linha para acessar a variável $conn dentro da função
    $sql = "SELECT * FROM products WHERE category = 'Novos Produtos'";
    $result = $conn->query($sql);

    // Verifica se há produtos
    if ($result->num_rows > 0) {
        // Loop através dos resultados da consulta
        while ($row = $result->fetch_assoc()) {
            // Exibição dinâmica dos produtos
            echo '<section class="cinza">';
            echo '<section class="container">';
            echo '<img class="venda" src="../images/' . $row["image_path"] . '" alt="' . $row["name"] . '">';
            echo '<h2>' . $row["name"] . '</h2>';
            echo '<p><s>R$ ' . $row["old_price"] . '</s></p>';
            echo '<p class="preco"><strong>R$ ' . $row["price"] . '</strong></p>';
            echo '<p>Quantidade disponível: ' . $row["quantidade"] . '</p>'; // Display quantity
            echo '<p>À vista no PIX</p>';
            echo '<div class="carrossel">';
            echo '<form method="post">';
            echo '<input type="hidden" name="nome" value="' . $row["name"] . '">';
            echo '<input type="hidden" name="preco" value="' . $row["price"] . '">';
            echo '<input type="hidden" name="imagem" value="' . $row["image_path"] . '">';
            echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
            echo '</form>';
            echo '</div>';
            echo '</section>';
            echo '</section>';
        }
    } else {
        echo "Nenhum produto encontrado.";
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
}
function erroMsg(){
    if (isset($_SESSION['login_erro'])) {
        echo '<div class="mensagem-erro">';
        echo '<span class="error-icon">❌</span>';
        echo $_SESSION['login_erro'];
        echo '</div>';
        unset($_SESSION['login_erro']);
    }
}
function retornar(){
    if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'adm') {
        // Se o usuário não for um administrador, redirecioná-lo para a página de login
        header("Location: ../login/index-login.php");
        exit;
    }
}
function verificarAdm(){
    // if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'adm') {
    //     // Se o usuário não for um administrador, redirecioná-lo para a página de login
    //     header("Location: ../login/index-login.php");
    //     exit;
    // }
}

   

function obterInformacoesUsuario() {
    global $conn;
    $nome_usuario = "Faça login";
    $email_usuario = "";    
    $nome = "";

    if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {

        $email_logado = $_SESSION['usuario_logado']['email'];
        $stmt = $conn->prepare("SELECT `name`, `nickname`, `email` FROM `user` WHERE `email` = ?");
        $stmt->bind_param("s", $email_logado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $nome_usuario = $usuario['nickname'];
            $nome = $usuario['name']; // Alteração aqui
            $email_usuario = $usuario['email'];
        }
        
    }

    // Retorna um array com as informações do usuário
    return [
        'nick_usuario' => $nome_usuario,
        'email_usuario' => $email_usuario,
        'nome_usuario' => $nome // Alteração aqui
    ];
}

function usuarioPrecisaLogar(){
    if (!isset($_SESSION['usuario_logado']) || !is_array($_SESSION['usuario_logado'])) {
        // Redirect the user to the login page or display an error message
        header("Location: ../login/index-login.php.php");
        exit;
    }
}

function editarPerfilUsuario() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Editar'])) {
        $nome_usuario = $_SESSION['usuario_logado']['nome'];
        $email_usuario = $_SESSION['usuario_logado']['email'];

        // Inicializar variáveis para as novas informações
        $novo_nome = $nome_usuario;
        $novo_email = $email_usuario;
        $novo_nick = isset($_SESSION['usuario_logado']['nickname']) ? $_SESSION['usuario_logado']['nickname'] : '';
        $nova_senha = isset($_SESSION['usuario_logado']['senha']) ? $_SESSION['usuario_logado']['senha'] : '';

        // Verificar se o campo foi preenchido e atualizar as variáveis correspondentes
        if (!empty($_POST['novo_nome'])) {
            $novo_nome = $_POST['novo_nome'];
        }

        if (!empty($_POST['novo_email'])) {
            $novo_email = $_POST['novo_email'];
        }

        if (!empty($_POST['novo_nick'])) {
            $novo_nick = $_POST['novo_nick'];
        }

        if (!empty($_POST['nova_senha'])) {
            $nova_senha = $_POST['nova_senha'];
        }
        // Validar os campos conforme necessário

        // Verificar se o novo email já está cadastrado no banco de dados
        $stmt_check_email = $conn->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = ?");
        $stmt_check_email->bind_param("s", $novo_email);
        $stmt_check_email->execute();
        $stmt_check_email->bind_result($email_count);
        $stmt_check_email->fetch();
        $stmt_check_email->close();

        if ($email_count > 0) {
            // O novo email já está cadastrado, exiba uma mensagem de erro ou faça o tratamento adequado
            echo "O email já está cadastrado. Por favor, escolha outro.";
            exit;
        }

        // Se o novo email não estiver cadastrado, proceda com a atualização das informações do usuário
        $stmt = $conn->prepare("UPDATE `user` SET `name`=?, `email`=?, `nickname`=?, `password`=? WHERE `email`=?");
        $stmt->bind_param("sssss", $novo_nome, $novo_email, $novo_nick, $nova_senha, $email_usuario);
        $stmt->execute();
        $stmt->close();

        // Atualizar as informações do usuário na sessão
        $_SESSION['usuario_logado']['nome'] = $novo_nome;
        $_SESSION['usuario_logado']['email'] = $novo_email;
        $_SESSION['usuario_logado']['nickname'] = $novo_nick;
        if (!empty($_POST['nova_senha'])) {
            $_SESSION['usuario_logado']['senha'] = $nova_senha;
        }

        // Redirecionar de volta para a página de perfil após a edição
        header("Location: ../perfil/perfil.php");
        exit;
    }
}
?>