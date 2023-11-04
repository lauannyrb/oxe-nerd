<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifique se algum campo está vazio
    if (empty($email) || empty($senha)) {
        $_SESSION['login_erro'] = "Por favor, preencha todos os campos.";
        header("Location: index-login.php");
        exit;
    }

    // Verifica se a sessão de usuários está definida
    if (isset($_SESSION['usuarios'])) {
        $usuarios = $_SESSION['usuarios'];
        $login_sucesso = false;

        foreach ($usuarios as $usuario) {
            if ($usuario['email'] == $email && password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido, redireciona para a página desejada
                $login_sucesso = true;
                header("Location: ../index.html");
                exit;
            }
        }

        if (!$login_sucesso) {
            $_SESSION['login_erro'] = "E-mail ou senha incorretos.";
        }
    } else {
        $_SESSION['login_erro'] = "Nenhum usuário cadastrado.";
    }

    header("Location: index-login.php");
    exit;
}
?>
