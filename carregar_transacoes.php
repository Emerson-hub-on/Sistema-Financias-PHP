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

// Consulta para carregar todas as transações
$sql = "SELECT * FROM transacoes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicializa variáveis para calcular saldo e balanço
    $saldo = 0;
    $receitas = 0;
    $despesas = 0;

    // Exibe as transações em uma tabela
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["data"] . "</td>";
        echo "<td>" . $row["descricao"] . "</td>";
        echo "<td>" . ($row["tipo"] == 'R' ? 'Receita' : 'Despesa') . "</td>";
        echo "<td>" . number_format($row["valor"], 2, ',', '.') . "</td>";
        echo "</tr>";

        // Calcula saldo e balanço
        if ($row["tipo"] == 'R') {
            $saldo += $row["valor"];
            $receitas += $row["valor"];
        } else {
            $saldo -= $row["valor"];
            $despesas += $row["valor"];
        }
    }
    echo "<tr>";
    echo "<td colspan='3'><b>Total</b></td>";
    echo "<td><b>" . number_format($saldo, 2, ',', '.') . "</b></td>";
    echo "</tr>";

} else {
    echo "0 resultados";
}

$conn->close();
?>
