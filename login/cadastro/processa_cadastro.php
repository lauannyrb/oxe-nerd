<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"]; // Agora você deve pegar o campo senha

    // Verifique se algum campo está vazio
    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['cadastro_erro'] = "Por favor, preencha todos os campos.";
        header("Location: index-cadastro.php");
        exit;
    }
    // Verifica se a sessão já está definida
    if (!isset($_SESSION['usuarios'])) {
        $_SESSION['usuarios'] = [];
    }

    // Verifica se o email já está cadastrado
    $usuarios = $_SESSION['usuarios'];
    foreach ($usuarios as $usuario) {
        if ($usuario['email'] == $email) {
            $_SESSION['cadastro_erro'] = "Este email já está cadastrado.";
            header("Location: index-cadastro.php");
            exit;
        }
    }

    // Armazena o novo usuário no array de usuários
    $_SESSION['usuarios'][] = ['nome' => $nome, 'email' => $email, 'senha' => $senha];

    // Define a variável de sessão para indicar que o usuário está logado
    $_SESSION['usuario_logado'] = $nome;

    // Redireciona para a página inicial
    header("Location: ../../index.php");
    exit;
}
?>
