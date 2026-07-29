<?php
// Inclua este arquivo no topo de qualquer página que só pode ser acessada
// por quem já fez login no sistema.

require_once __DIR__ . '/../conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}
