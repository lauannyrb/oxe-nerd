<?php
session_start();

// Inclua o arquivo de conexão com o banco de dados
include '../../conexao.php';

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Cadastrar-se'])) {

    // Obtenha os dados do formulário
    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a senha
    $consenha = $_POST["consenha"];

    // Verificar se algum campo está vazio
    if (empty($nome) || empty($apelido) || empty($email) || empty($senha_hashed) || empty($consenha)) {
        $_SESSION['cadastro_erro'] = "Por favor, preencha todos os campos.";
        header("Location: index-cadastro.php");
        exit;
    }

    // Verificar se as senhas são iguais
    if ($senha !== $consenha) {
        $_SESSION['cadastro_erro'] = "As senhas precisam ser iguais.";
        header("Location: index-cadastro.php");
        exit;
    }

    $sql_create_table = "CREATE TABLE IF NOT EXISTS `user` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `nickname` VARCHAR(50),
        `email` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `user_type` VARCHAR(50) NOT NULL DEFAULT 'normal'
    )";
    
    if ($conn->query($sql_create_table) === TRUE) {
        echo "Tabela 'user' criada ou já existente.";
    } else {
        echo "Erro ao criar a tabela 'user': " . $conn->error;
    }


    // Verificar se o email já está cadastrado (evite emails duplicados)
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['cadastro_erro'] = "Este email já está cadastrado.";
        header("Location: index-cadastro.php");
        exit;
    }

    // Inserir os dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `user_type`) VALUES (?, ?, ?, ?, 'normal')");
    $stmt->bind_param("ssss", $nome, $apelido, $email, $senha_hashed);
    
    // Inserir os dados no banco de dados
    /*$stmt = $conn->prepare("INSERT INTO `user` (`name`, `nickname`, `email`, `password`, `date`, `type_user`) VALUES (?, ?, ?, ?, NOW(), 'normal')");
    $stmt->bind_param("ssss", $nome, $apelido, $email, $senha_hashed);*/


    if ($stmt->execute()) {
        // Redirecionar para a página inicial após o cadastro
        $_SESSION['usuario_logado'] = ['nome' => $nome, 'email' => $email];
        header("Location: ../../index.php");
        exit;
    } else {
        $_SESSION['cadastro_erro'] = "Ocorreu um erro ao cadastrar. Por favor, tente novamente.";
        $_SESSION['cadastro_erro'] .= " Erro: " . $stmt->error;
        header("Location: index-cadastro.php");
        exit;
    }
} else {
    // Redirecionar para a página de cadastro se o formulário não foi enviado
    header("Location: index-cadastro.php");
    exit();
}
?>
