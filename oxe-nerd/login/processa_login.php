<?php
include '../conexao.php'; // Arquivo de conexão com o banco de dados

sessao();

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
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if ($senha === $usuario['password']) {

            // Credenciais corretas, redirecione para a página inicial
            $_SESSION['usuario_logado'] = [
                'nome' => $usuario['name'],
                'email' => $usuario['email'],
                'type_user' => $usuario['type_user'] // Adicionando o tipo de usuário
            ];
            header("Location: ../index.php");
            exit;
        } else {
            // Se as credenciais estiverem erradas, redirecione de volta para o login
            $_SESSION['login_erro'] = "Credenciais inválidas.";
            header("Location: index-login.php");
            exit;
        }
    } else {
        // Se o usuário não for encontrado, redirecione de volta para o login
        $_SESSION['login_erro'] = "Credenciais inválidas.";
        header("Location: index-login.php");
        exit;
    }
}

$type_user = $_SESSION['usuario_logado']['type_user'];
return $type_user;
