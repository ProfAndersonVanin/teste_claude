<?php
require_once '../includes/verifica_login.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conexao, "SELECT livro_id FROM emprestimos WHERE id = ? AND status = 'emprestado'");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$emprestimo = mysqli_fetch_assoc($resultado);

if ($emprestimo) {
    $stmt = mysqli_prepare($conexao, "UPDATE emprestimos SET status = 'devolvido', data_devolucao = CURDATE() WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $stmt = mysqli_prepare($conexao, 'UPDATE livros SET disponivel = disponivel + 1 WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $emprestimo['livro_id']);
    mysqli_stmt_execute($stmt);

    header('Location: listar.php?sucesso=Devolução registrada com sucesso!');
    exit;
}

header('Location: listar.php');
exit;
