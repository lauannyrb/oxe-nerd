<?php
session_start();

include '../conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifique se algum campo está vazio
    if (empty($email) || empty($senha)) {
        $_SESSION['login_erro'] = "Por favor, preencha todos os campos.";
        header("Location: index-login.php");
        exit;
    }

    // Verifique as credenciais do usuário no banco de dados
    $stmt = $conn->prepare("SELECT * FROM `usuario` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['password'])) {
            // Credenciais corretas, redirecione para a página inicial
            $_SESSION['usuario_logado'] = [
                'nome' => $usuario['name'],
                'email' => $usuario['email']
            ];
            header("Location: ../index.php");
            exit;
        }
    }

    // Se as credenciais estiverem erradas, redirecione de volta para o login
    $_SESSION['login_erro'] = "Credenciais inválidas.";
    header("Location: index-login.php");
    exit;
}
?>
