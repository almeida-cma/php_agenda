<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require 'db.php'; // Inclui a conexão ao banco de dados

// Inicializando variáveis
$descricao = '';
$data = '';
$id = null;

// Verifica se estamos editando um compromisso
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM compromissos WHERE id = ?");
    $stmt->execute([$id]);
    $compromisso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($compromisso) {
        $descricao = $compromisso['descricao'];
        $data = $compromisso['data'];
    }
}

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];

    if ($id) {
        // Editar compromisso
        $stmt = $pdo->prepare("UPDATE compromissos SET descricao = ?, data = ? WHERE id = ?");
        $stmt->execute([$descricao, $data, $id]);
    } else {
        // Adicionar compromisso
        $stmt = $pdo->prepare("INSERT INTO compromissos (data, descricao) VALUES (?, ?)");
        $stmt->execute([$data, $descricao]);
    }
    
    // Redireciona para a agenda
    header('Location: agenda.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $id ? 'Editar Compromisso' : 'Adicionar Compromisso'; ?></title>
</head>
<body>
    <h1><?php echo $id ? 'Editar Compromisso' : 'Adicionar Compromisso'; ?></h1>
    <form action="add_edit_compromisso.php<?php echo $id ? '?id=' . $id : ''; ?>" method="post">
        <label for="data">Data:</label>
        <input type="date" name="data" value="<?php echo htmlspecialchars($data); ?>" required>
        
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($descricao); ?>" required>
        
        <button type="submit"><?php echo $id ? 'Salvar Alterações' : 'Adicionar Compromisso'; ?></button>
        <a href="agenda.php" class="btn">Cancelar</a>
    </form>
</body>
</html>
