<?php
require_once 'includes/verifica_login.php';

$titulo_pagina = 'Painel';
require 'includes/cabecalho.php';
?>

<h2 class="mb-4">Painel</h2>
<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Livros</h5>
                <p class="card-text">Cadastre e gerencie o acervo de livros.</p>
                <a href="livros/listar.php" class="btn btn-primary">Gerenciar livros</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text">Cadastre e gerencie os clientes da biblioteca.</p>
                <a href="clientes/listar.php" class="btn btn-primary">Gerenciar clientes</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Empréstimos</h5>
                <p class="card-text">Registre empréstimos e devoluções de livros.</p>
                <a href="emprestimos/listar.php" class="btn btn-primary">Gerenciar empréstimos</a>
            </div>
        </div>
    </div>

</div>

<?php require 'includes/rodape.php'; ?>
