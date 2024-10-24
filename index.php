<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo à Agenda!</h1>
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Olá, <?php echo $_SESSION['usuario']; ?>! <a href="agenda.php">Ver Agenda</a> | <a href="logout.php">Sair</a></p>
    <?php else: ?>
        <p><a href="login.php">Fazer Login</a></p>
    <?php endif; ?>
</body>
</html>
