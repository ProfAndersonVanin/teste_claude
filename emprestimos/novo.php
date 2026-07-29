<?php
require_once '../includes/verifica_login.php';

$erro = '';
$livro_id = '';
$cliente_id = '';
$data_prevista_devolucao = date('Y-m-d', strtotime('+7 days'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = (int) $_POST['livro_id'];
    $cliente_id = (int) $_POST['cliente_id'];
    $data_prevista_devolucao = $_POST['data_prevista_devolucao'];

    // Só cria o empréstimo se o livro ainda tiver exemplar disponível
    $stmt = mysqli_prepare($conexao, 'UPDATE livros SET disponivel = disponivel - 1 WHERE id = ? AND disponivel > 0');
    mysqli_stmt_bind_param($stmt, 'i', $livro_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) === 0) {
        $erro = 'Este livro não possui exemplares disponíveis no momento.';
    } else {
        $stmt = mysqli_prepare($conexao, 'INSERT INTO emprestimos (livro_id, cliente_id, data_emprestimo, data_prevista_devolucao, status)
                                           VALUES (?, ?, CURDATE(), ?, "emprestado")');
        mysqli_stmt_bind_param($stmt, 'iis', $livro_id, $cliente_id, $data_prevista_devolucao);
        mysqli_stmt_execute($stmt);

        header('Location: listar.php?sucesso=Empréstimo registrado com sucesso!');
        exit;
    }
}

$livros = mysqli_query($conexao, 'SELECT id, titulo FROM livros WHERE disponivel > 0 ORDER BY titulo');
$clientes = mysqli_query($conexao, 'SELECT id, nome FROM clientes ORDER BY nome');

$titulo_pagina = 'Novo Empréstimo';
require '../includes/cabecalho.php';
?>

<h2 class="mb-4">Novo Empréstimo</h2>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<?php if (mysqli_num_rows($livros) === 0): ?>
    <div class="alert alert-warning">Não há livros com exemplares disponíveis no momento.</div>
<?php endif; ?>

<?php if (mysqli_num_rows($clientes) === 0): ?>
    <div class="alert alert-warning">
        Nenhum cliente cadastrado. <a href="<?php echo BASE_URL; ?>clientes/novo.php">Cadastre um cliente</a> antes de registrar um empréstimo.
    </div>
<?php endif; ?>

<form method="POST" action="novo.php" class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Livro</label>
        <select class="form-select" name="livro_id" required>
            <option value="">Selecione...</option>
            <?php while ($livro = mysqli_fetch_assoc($livros)): ?>
                <option value="<?php echo $livro['id']; ?>" <?php echo ($livro_id == $livro['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($livro['titulo']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Cliente</label>
        <select class="form-select" name="cliente_id" required>
            <option value="">Selecione...</option>
            <?php while ($cliente = mysqli_fetch_assoc($clientes)): ?>
                <option value="<?php echo $cliente['id']; ?>" <?php echo ($cliente_id == $cliente['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cliente['nome']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Devolução prevista</label>
        <input type="date" class="form-control" name="data_prevista_devolucao"
               value="<?php echo htmlspecialchars($data_prevista_devolucao); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrar empréstimo</button>
    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
</form>

<?php require '../includes/rodape.php'; ?>
