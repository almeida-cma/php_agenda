<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require 'db.php'; // Inclui a conexão ao banco de dados

// Busca os compromissos
$stmt = $pdo->query("SELECT * FROM compromissos");
$compromissos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se um compromisso foi excluído
if (isset($_GET['excluir'])) {
    $idExcluir = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM compromissos WHERE id = ?");
    $stmt->execute([$idExcluir]);
    header('Location: agenda.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Minha Agenda</title>
</head>
<body>
    <h1>Agenda de <?php echo $_SESSION['usuario']; ?></h1>
    <p><a href="logout.php">Sair</a></p>

    <h2>Meus Compromissos</h2>
    <a href="add_edit_compromisso.php" class="btn">Adicionar Compromisso</a>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($compromissos)): ?>
                <tr>
                    <td colspan="3">Nenhum compromisso agendado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($compromissos as $compromisso): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($compromisso['data']); ?></td>
                        <td><?php echo htmlspecialchars($compromisso['descricao']); ?></td>
                        <td>
                            <a href="add_edit_compromisso.php?id=<?php echo $compromisso['id']; ?>" class="btn">Editar</a>
                            <a href="?excluir=<?php echo $compromisso['id']; ?>" class="btn btn-excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
