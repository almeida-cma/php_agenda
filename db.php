<?php
$host = 'localhost'; // ou o IP do servidor MySQL
$port = '7306'; // Adicione a porta aqui
$db = 'agenda_db';
$user = 'root'; // substitua pelo seu usuário do MySQL
$pass = ''; // substitua pela sua senha do MySQL

try {
    // Inclui a porta na string de conexão
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
