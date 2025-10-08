<?php
require_once '../database/config.php';
require_once '../database/auth.php';

if (!estaLogado()) {
    http_response_code(401);
    echo json_encode(['Erro' => 'Usuário não autorizado']);
    exit;
}

$servicoId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$servicoId) {
  http_response_code(400);
  echo json_encode(['erro' => 'ID inválido']);
  exit;  
}

// Verifica se pertence ao usuário logado
$stmt = $pdo->prepare("SELECT usuario_id FROM servico WHERE id = ?");
$stmt->execute([$servicoId]);
$servico = $stmt->fetch(PDO::FETCH_ASSOC);

$usuarioLogadoId = $_SESSION['usuario']['id'];
$nivel = $_SESSION['usuario']['nivel'];

if (!$servico || ($servico['usuario_id'] != $usuarioLogadoId && $nivel != 1)) {
    http_response_code(403);
    echo json_encode(['erro' => 'Permissão negada']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM servico WHERE id = ?");
    $stmt->execute([$servicoId]);
    echo json_encode(['sucesso' => true]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao cancelar o servico: ' . $e->getMessage()]);
}
?>