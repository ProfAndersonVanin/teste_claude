<?php
require_once '../includes/verifica_login.php';

$sql = "SELECT emprestimos.id, livros.titulo, clientes.nome,
               emprestimos.data_emprestimo, emprestimos.data_prevista_devolucao,
               emprestimos.data_devolucao, emprestimos.status
        FROM emprestimos
        JOIN livros ON livros.id = emprestimos.livro_id
        JOIN clientes ON clientes.id = emprestimos.cliente_id
        ORDER BY emprestimos.status ASC, emprestimos.data_prevista_devolucao ASC";
$resultado = mysqli_query($conexao, $sql);

$titulo_pagina = 'Empréstimos';
require '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Empréstimos</h2>
    <a href="novo.php" class="btn btn-primary">+ Novo empréstimo</a>
</div>

<?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['sucesso']); ?></div>
<?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['erro']); ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped align-middle bg-white">
        <thead>
            <tr>
                <th>Livro</th>
                <th>Cliente</th>
                <th>Empréstimo</th>
                <th>Devolução prevista</th>
                <th>Devolução</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($resultado) === 0): ?>
                <tr><td colspan="7" class="text-center">Nenhum empréstimo registrado.</td></tr>
            <?php endif; ?>
            <?php while ($emprestimo = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($emprestimo['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($emprestimo['nome']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($emprestimo['data_emprestimo'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($emprestimo['data_prevista_devolucao'])); ?></td>
                    <td><?php echo $emprestimo['data_devolucao'] ? date('d/m/Y', strtotime($emprestimo['data_devolucao'])) : '-'; ?></td>
                    <td>
                        <?php if ($emprestimo['status'] === 'emprestado'): ?>
                            <span class="badge bg-warning text-dark">Emprestado</span>
                        <?php else: ?>
                            <span class="badge bg-success">Devolvido</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($emprestimo['status'] === 'emprestado'): ?>
                            <a href="devolver.php?id=<?php echo $emprestimo['id']; ?>" class="btn btn-sm btn-secondary"
                               onclick="return confirm('Confirmar a devolução deste livro?');">Registrar devolução</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require '../includes/rodape.php'; ?>
