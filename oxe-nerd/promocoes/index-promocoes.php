<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para selecionar todos os produtos da categoria "Promoção"
$sql = "SELECT * FROM products WHERE category = 'Promoção'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-promocoes.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Promoções</title>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>        
        <nav>
            <a class="" href="../promocoes/index-promocoes.php"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
            <a class="Login" href="../login/index-login.php">Faça login</a>
            <a class="" href="../carrinho/index-carrinho.php">
                <img class="carrinho" src="../images/carrinho.png" title="carrinho">
            </a>
        </nav>
    </header>
    <!-- Fim do cabeçalho -->

    <!-- Título das Promoções -->
    <nav class="titulo"><strong>Promoções<hr></strong></nav>

    <!-- Carrossel de Produtos -->
    <section class="carrossel">
        <?php
        // Verificar se há produtos na categoria "Promoção"
        if ($result->num_rows > 0) {
            // Loop através dos resultados da consulta e exibir os produtos
            while ($row = $result->fetch_assoc()) {
        ?>
                <section class="divisao">
                    <section class="container">
                        <img class="venda" src="../<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>">
                        <h2><?= $row['name'] ?></h2>
                        <p><s>R$ <?= $row['old_price'] ?></s></p>
                        <p class="preco"><strong>R$ <?= $row['price'] ?></strong></p>
                        <p>À vista no PIX</p>
                        <form method="post">
                            <input type="hidden" name="nome" value="<?= $row['name'] ?>">
                            <input type="hidden" name="preco" value="<?= $row['price'] ?>">
                            <input type="hidden" name="imagem" value="../<?= $row['image_path'] ?>">
                            <button class="btn" type="submit" name="comprar">COMPRAR</button>
                        </form>
                    </section>
                </section>
        <?php
            }
        } else {
            // Se não houver produtos na categoria "Promoção"
            echo "<p>Nenhum produto encontrado.</p>";
        }
        ?>

    </section>
    <!-- Fim do Carrossel de Produtos -->

    <!-- Fale Conosco -->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!-- Fim do Fale Conosco -->

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
