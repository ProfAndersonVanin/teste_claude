<?php
require_once '../includes/verifica_login.php';

$erro = '';
$nome = '';
$email = '';
$telefone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    $stmt = mysqli_prepare($conexao, 'INSERT INTO clientes (nome, email, telefone) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $nome, $email, $telefone);
    mysqli_stmt_execute($stmt);

    header('Location: listar.php?sucesso=Cliente cadastrado com sucesso!');
    exit;
}

$titulo_pagina = 'Novo Cliente';
require '../includes/cabecalho.php';
?>

<h2 class="mb-4">Novo Cliente</h2>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<form method="POST" action="novo.php" class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" class="form-control" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
</form>

<?php require '../includes/rodape.php'; ?>
