<?php
// Informações de conexão com o banco de dados
$dbservername = "localhost"; // Nome do servidor MySQL
$dbusername = "root"; // Nome de usuário do banco de dados
$dbpassword = ""; // Senha do banco de dados
$dbdatabase = "silupabelma"; // Nome do banco de dados

// Criar uma conexão com o banco de dados
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Agora você pode executar consultas e operações no banco de dados usando a variável $conn.
?>