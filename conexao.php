<?php
// Arquivo de conexão com o banco de dados
// Este arquivo é incluído (include) em todas as páginas que precisam acessar o banco

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'biblioteca_claude';

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
}

mysqli_set_charset($conexao, 'utf8mb4');
