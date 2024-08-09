<?php
include 'db.php';

// Filtrando produtos
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM produtos WHERE descricao LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Loja de Produtos</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h1>Lista de Produtos</h1>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Pesquisar..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Buscar</button>
    </form>

    <table border="1">
        <tr>
            <th>Imagem</th>
            <th>Descrição</th>
            <th>Fabricante</th>
            <th>Quantidade</th>
            <th>Preço Custo</th>
            <th>Preço Venda</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='imagens/" . $row['imagem'] . "' width='100'></td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['fabricante'] . "</td>";
                echo "<td>" . $row['qtd'] . "</td>";
                echo "<td>" . $row['preco_custo'] . "</td>";
                echo "<td>" . $row['preco_venda'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
        }
        ?>
    </table>

    <a href="cadastrar.php">Cadastrar Novo Produto</a>
</body>

</html>

<?php $conn->close(); ?>