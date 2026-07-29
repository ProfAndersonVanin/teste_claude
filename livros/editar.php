<?php
require_once '../includes/verifica_login.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conexao, 'SELECT * FROM livros WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$livro = mysqli_fetch_assoc($resultado);

if (!$livro) {
    header('Location: listar.php');
    exit;
}

$erro = '';
$titulo = $livro['titulo'];
$autor = $livro['autor'];
$isbn = $livro['isbn'];
$quantidade = $livro['quantidade'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $isbn = trim($_POST['isbn']);
    $quantidade = (int) $_POST['quantidade'];
    $emprestados = $livro['quantidade'] - $livro['disponivel'];

    if ($quantidade < $emprestados) {
        $erro = "Não é possível definir uma quantidade menor que $emprestados (exemplares já emprestados).";
    } else {
        $disponivel = $quantidade - $emprestados;

        $stmt = mysqli_prepare($conexao, 'UPDATE livros SET titulo = ?, autor = ?, isbn = ?, quantidade = ?, disponivel = ? WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'sssiii', $titulo, $autor, $isbn, $quantidade, $disponivel, $id);
        mysqli_stmt_execute($stmt);

        header('Location: listar.php?sucesso=Livro atualizado com sucesso!');
        exit;
    }
}

$titulo_pagina = 'Editar Livro';
require '../includes/cabecalho.php';
?>

<h2 class="mb-4">Editar Livro</h2>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<form method="POST" action="editar.php?id=<?php echo $id; ?>" class="col-lg-6">
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
