<?php
require_once '../includes/verifica_login.php';

$id = (int) ($_GET['id'] ?? 0);

// Não permite excluir um cliente que tem empréstimo em aberto
$stmt = mysqli_prepare($conexao, "SELECT COUNT(*) AS total FROM emprestimos WHERE cliente_id = ? AND status = 'emprestado'");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$linha = mysqli_fetch_assoc($resultado);

if ($linha['total'] > 0) {
    header('Location: listar.php?erro=Não é possível excluir um cliente com empréstimos em aberto.');
    exit;
}

$stmt = mysqli_prepare($conexao, 'DELETE FROM clientes WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

header('Location: listar.php?sucesso=Cliente excluído com sucesso!');
exit;
