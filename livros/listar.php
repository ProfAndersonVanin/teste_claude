<?php
require_once '../includes/verifica_login.php';

$resultado = mysqli_query($conexao, 'SELECT * FROM livros ORDER BY titulo');

$titulo_pagina = 'Livros';
require '../includes/cabecalho.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Livros</h2>
    <a href="novo.php" class="btn btn-primary">+ Novo livro</a>
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
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Qtd. total</th>
                <th>Disponível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($resultado) === 0): ?>
                <tr><td colspan="6" class="text-center">Nenhum livro cadastrado.</td></tr>
            <?php endif; ?>
            <?php while ($livro = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                    <td><?php echo htmlspecialchars($livro['isbn']); ?></td>
                    <td><?php echo (int) $livro['quantidade']; ?></td>
                    <td><?php echo (int) $livro['disponivel']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $livro['id']; ?>" class="btn btn-sm btn-secondary">Editar</a>
                        <a href="excluir.php?id=<?php echo $livro['id']; ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require '../includes/rodape.php'; ?>
