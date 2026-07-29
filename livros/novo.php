<?php
require_once '../includes/verifica_login.php';

$erro = '';
$titulo = '';
$autor = '';
$isbn = '';
$quantidade = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $isbn = trim($_POST['isbn']);
    $quantidade = (int) $_POST['quantidade'];

    if ($quantidade < 1) {
        $erro = 'A quantidade deve ser pelo menos 1.';
    } else {
        $stmt = mysqli_prepare($conexao, 'INSERT INTO livros (titulo, autor, isbn, quantidade, disponivel) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sssii', $titulo, $autor, $isbn, $quantidade, $quantidade);
        mysqli_stmt_execute($stmt);

        header('Location: listar.php?sucesso=Livro cadastrado com sucesso!');
        exit;
    }
}

$titulo_pagina = 'Novo Livro';
require '../includes/cabecalho.php';
?>

<h2 class="mb-4">Novo Livro</h2>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<form method="POST" action="novo.php" class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Autor</label>
        <input type="text" class="form-control" name="autor" value="<?php echo htmlspecialchars($autor); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" class="form-control" name="isbn" value="<?php echo htmlspecialchars($isbn); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Quantidade de exemplares</label>
        <input type="number" min="1" class="form-control" name="quantidade" value="<?php echo (int) $quantidade; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
</form>

<?php require '../includes/rodape.php'; ?>
