<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Cadastrar-se'])){
    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $consenha = $_POST["consenha"];

    // Verifique se algum campo está vazio
    if (empty($nome)|| empty($apelido) || empty($email) || empty($senha) || empty($consenha)) {
        $_SESSION['cadastro_erro'] = "Por favor, preencha todos os campos.";
        header("Location: index-cadastro.php");
        exit;
    }

    // Verifique se o email já está cadastrado (simulação)
    $usuarios_cadastrados = isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : [];
    
    foreach ($usuarios_cadastrados as $usuario) {
        if ($usuario['email'] === $email) {
            $_SESSION['cadastro_erro'] = "Este email já está cadastrado.";
            header("Location: index-cadastro.php");
            exit;
        }
    }

    // Verifique se as senhas são iguais
    if ($senha !== $consenha) {
        $_SESSION['cadastro_erro'] = "As senhas precisam ser iguais.";
        header("Location: index-cadastro.php");
        exit;
    }

    // Cadastra o novo usuário
    $usuarios_cadastrados[] = ['nome' => $nome, 'email' => $email, 'senha' => $senha];
    $_SESSION['usuarios'] = $usuarios_cadastrados;

    // Redireciona para a página inicial
    $_SESSION['usuario_logado'] = ['nome' => $nome, 'email' => $email];
            header("Location: ../../index.php");


    exit;
}
    
?>
