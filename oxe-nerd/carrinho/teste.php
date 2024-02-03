<?php
// Conexão com o banco de dados (substitua pelos seus próprios dados)
include '../conexao.php';


// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o produto ID e a quantidade foram enviados
    if(isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Atualiza a quantidade do produto no banco de dados
        $sql = "UPDATE products SET quantidade = quantidade - $quantity WHERE id = $product_id";

        if ($conn->query($sql) === TRUE) {
            echo "Quantidade do produto atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a quantidade do produto: " . $conn->error;
        }
    }
}

// Exibe os produtos disponíveis para compra
$sql = "SELECT id, name, price, old_price, image_path, category, quantidade FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os produtos em uma tabela
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Preço</th><th>Preço Antigo</th><th>Quantidade</th><th>Adicionar ao Carrinho</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["old_price"]."</td>";
        echo "<td>".$row["quantidade"]."</td>";
        echo "<td><form method='post'><input type='hidden' name='product_id' value='".$row["id"]."'><input type='number' name='quantity' value='1'><input type='submit' value='Adicionar ao Carrinho'></form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum produto encontrado.";
}
$conn->close();
?>
