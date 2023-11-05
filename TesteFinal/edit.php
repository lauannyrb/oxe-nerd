<?php
session_start(); // Inicia a sessão para trabalhar com variáveis de sessão

if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['produtos'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
}

if(isset($_POST['editar'])){
    echo $_POST['indice']; // Exibe o índice do usuário que está sendo editado
    header('Location: editprodt.php?id='.$_POST['indice']); // Redireciona para a página "editarUsuario.php" com o ID do usuário que será editado na URL
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_SESSION['produtos'])) {
    echo "<h1>Lista de Produtos</h1>";

    foreach ($_SESSION['produtos'] as $key => $produto) {
        

        echo "<form action='' method='post'>";
        
        echo "<div>";
        echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h2>" . $produto['nome'] . "</h2>";
        echo "<p>Preço: R$ " . $produto['preco'] . "</p>";

        echo "<td><input type='submit' name ='editar' value='E'/></td>"; // Botão para editar o usuário
        echo "<td><input type='submit' name ='deletar' value='D'/></td>"; // Botão para excluir o usuário
        echo "<input type='hidden' name='indice' value='$key'/>"; // Campo oculto com o índice do usuário

        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum produto cadastrado ainda.</p>";
}

//qq tá acontecendo mds do céu

?>



</body>
</html>
