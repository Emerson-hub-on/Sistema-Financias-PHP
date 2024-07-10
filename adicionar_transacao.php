<?php
// Conexão com o banco de dados (exemplo básico, ajuste conforme suas configurações)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transacoes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Coleta dados do formulário
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];

// Insere os dados na tabela transacoes
$sql = "INSERT INTO transacoes (tipo, descricao, valor, data)
        VALUES ('$tipo', '$descricao', '$valor', '$data')";

if ($conn->query($sql) === TRUE) {
    echo "Transação adicionada com sucesso!";
} else {
    echo "Erro ao adicionar transação: " . $conn->error;
}

$conn->close();
?>
