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

    // Verifique as credenciais do usuário
    if (verificarCredenciais($email, $senha, $nome)) {
        // Credenciais corretas, redirecione para a página de perfil
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['login_erro'] = "Credenciais inválidas.";
        header("Location: index-login.php");
        exit;
    }
}

// Função para verificar as credenciais (simulação)
function verificarCredenciais($email, $senha) {
    // Substitua esta simulação pela lógica real de verificação de credenciais
    $usuarios_cadastrados = $_SESSION['usuarios'];
    
    foreach ($usuarios_cadastrados as $usuario) {
        if ($usuario['email'] === $email && $usuario['senha'] === $senha) { 
            $_SESSION['usuario_logado'] = $usuario; 
            return true; // Credenciais válidas
        }
    }
    return false; // Credenciais inválidas
}

?>
