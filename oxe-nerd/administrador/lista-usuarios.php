<?php
// ...

// Verificar se o formulário de logout foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: ../index.php"); // Redirecionar para a página inicial após o logout
}

// Conexão com o banco de dados
include '../conexao.php';

// Consulta SQL para selecionar todos os usuários
$sql = "SELECT * FROM `user`";
$resultado = $conn->query($sql);

// Array para armazenar os usuários
$usuarios = [];

if ($resultado->num_rows > 0) {
    // Iterar sobre os resultados e armazenar os usuários no array
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();

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
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Administrador</title>
    <script>
        function editarUsuario(id, nome, senha) {
            // Exibir o formulário de edição para o usuário com o ID correspondente
            var form = document.getElementById('formEditar');
            var inputs = form.getElementsByTagName('input');
            inputs[0].value = id; // Definir o valor do campo ID do usuário
            inputs[1].value = nome; // Definir o valor do campo Nome do usuário
            inputs[2].value = senha; // Definir o valor do campo Senha do usuário
            form.style.display = 'block'; // Exibir o formulário
        }

        function confirmarExclusao(id) {
            if (confirm('Tem certeza de que deseja excluir este usuário?')) {
                // Redirecionar para a página de exclusão com o ID do usuário como parâmetro na URL
                window.location.href = 'excluir-usuario.php?id=' + id;
            }
        }
    </script>
</head>

<body>
    <!-- Header  -->
    <header>
        <!-- Seu código de header -->
    </header>
    <h2 style="margin: 30px auto; width: 80%;">Listagem de Usuarios</h2>
    <section class="lista">
        <?php foreach ($usuarios as $usuario) : ?>
            <div class="lista">
                <div class="esquerda">
                    <span class="black" style="width: 10%;">ID: <?php echo $usuario['id']; ?></span>
                    <!-- Substituir as tags <span> pelos campos de edição -->
                    <input type="text" style="width: 70%;" value="<?php echo $usuario['name']; ?>" disabled>
                    <input type="text" class="black" style="width: 20%;" value="<?php echo $usuario['password']; ?>" disabled>
                    <div class="direita">
                        <!-- Botão para editar usuário -->
                        <button onclick="editarUsuario(<?php echo $usuario['id']; ?>, '<?php echo $usuario['name']; ?>', '<?php echo $usuario['password']; ?>')"> <img class="img" src="../images/img_admin/Edit.png" title="Editar"> </button>
                        <!-- Botão para excluir usuário -->
                        <button onclick="confirmarExclusao(<?php echo $usuario['id']; ?>)"> <img class="img" src="../images/img_admin/Delete.png" title="Deletar"> </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Formulário de edição de usuário (inicialmente oculto) -->
        <div id="formEditar" style="display: none;">
            <form action="editperfil.php" method="post">
                <input type="hidden" name="id" value="">
                <input type="text" name="nome" placeholder="Novo nome">
                <input type="password" name="senha" placeholder="Nova senha">
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Seu código de footer -->
    </section>
</body>

</html>
