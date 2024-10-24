<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simulação de login (normalmente você deve verificar em um banco de dados)
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Validação básica
    if ($usuario == 'admin' && $senha == 'senha') {
        $_SESSION['usuario'] = $usuario;
        header('Location: agenda.php');
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($erro)): ?>
        <p class="erro"><?php echo $erro; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
