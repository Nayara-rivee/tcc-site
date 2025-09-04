<?php
require_once '../database/config.php';
require_once '../database/auth.php';

if (!estaLogado() || $_SESSION['usuario']['nivel'] != 1) {
    // Se não estiver, redireciona para a página de login e encerra a execução
    header('Location: login.php');
    exit;
}

$termo = isset($_GET['termo']) ? trim($_GET['termo']) : '';

try {
    $stmt = $pdo->prepare('SELECT id, nome, email, nivel, data_criacao FROM usuarios WHERE nome LIKE ? OR email LIKE ? ORDER BY nome ASC');
    $stmt->bindValue(':termo', "%$termo%");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

      header('Content-Type: application/json');
    echo json_encode($usuarios);
} catch(PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}



?>