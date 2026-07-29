<?php
// Este arquivo espera que a variável $titulo_pagina já esteja definida
// e que a sessão já tenha sido iniciada (feito em verifica_login.php)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' - ' : ''; ?>Sistema de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/estilo.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>dashboard.php">📚 Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>livros/listar.php">Livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>clientes/listar.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>emprestimos/listar.php">Empréstimos</a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item">
                        <span class="navbar-text text-light me-lg-3">
                            Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="<?php echo BASE_URL; ?>logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
