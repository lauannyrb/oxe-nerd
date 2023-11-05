<?php
session_start();

if(isset($_POST['editar'])){
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    echo $nome;

    // Verifique se uma imagem foi enviada
    if (isset($_FILES['imagem'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
            $imagem = $targetFile;
        }
    }

    
        $produto['nome'] = $nome;
        $produto['preco'] =$preco;
        $produto['imagem'] = $imagem;
        $_SESSION['produtos'][$_GET['id']] = $produto;

}



if(isset($_GET['id'])){     
    $produto = $_SESSION['produtos'][$_GET['id']];//vai jogar dentro do key do produtos
}else{
    die('Acesso incompativel');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" value= "<?php echo $produto['nome'] ?>"/><br>
        Preço: <input type="text" name="preco" value="<?php echo $produto['preco']?>"><br>
        Imagem: <input type="file" name="imagem" accept="image/*" <?php echo $produto['imagem']?>><br>
        <input type="submit" value="editar" name ='editar'/>
    </form>    
</body>
</html>