<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $fabricante = $_POST['fabricante'];
    $qtd = $_POST['qtd'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda = $_POST['preco_venda'];
    $imagem = $_FILES['imagem']['name'];

    $target_dir = "imagens/";
    $target_file = $target_dir . basename($imagem);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);

    $sql = "INSERT INTO produtos (descricao, fabricante, qtd, preco_custo, preco_venda, imagem)
            VALUES ('$descricao', '$fabricante', $qtd, $preco_custo, $preco_venda, '$imagem')";

    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Cadastrar Novo Produto</h1>

    <form method="POST" action="" enctype="multipart/form-data">
        <label>Descrição:</label><br>
        <input type="text" name="descricao" required><br>
        <label>Fabricante:</label><br>
        <input type="text" name="fabricante" required><br>
        <label>Quantidade:</label><br>
        <input type="number" name="qtd" required><br>
        <label>Preço de Custo:</label><br>
        <input type="number" step="0.01" name="preco_custo" required><br>
        <label>Preço de Venda:</label><br>
        <input type="number" step="0.01" name="preco_venda" required><br>
        <label>Imagem:</label><br>
        <input type="file" name="imagem" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>

    <a href="index.php">Voltar para a lista de produtos</a>
</body>
</html>

<?php $conn->close(); ?>
