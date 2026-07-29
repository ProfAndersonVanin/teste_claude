<?php
require_once '../includes/verifica_login.php';

$resultado = mysqli_query($conexao, 'SELECT * FROM clientes ORDER BY nome');

$titulo_pagina = 'Clientes';
require '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Clientes</h2>
    <a href="novo.php" class="btn btn-primary">+ Novo cliente</a>
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
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($resultado) === 0): ?>
                <tr><td colspan="4" class="text-center">Nenhum cliente cadastrado.</td></tr>
            <?php endif; ?>
            <?php while ($cliente = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-secondary">Editar</a>
                        <a href="excluir.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require '../includes/rodape.php'; ?>
