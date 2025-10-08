<?php
require_once '../database/config.php';

$idUsuario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$idUsuario) {
    http_response_code(400);
    echo json_encode(['error'=>'ID do usuário inválido ou não fornecido']);
    exit;
}
try {
    $stmt = $pdo->prepare('SELECT s.*, ts.nome_tipo, ts.valor FROM servico s JOIN tipos_servico ts ON s.tipo_servico_id = ts.id WHERE s.usuario_id = :usuario_id');
    $stmt->execute([':usuario_id' => $idUsuario]);
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($consultas);
}catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar serviços: ' . $e->getMessage()]);
    exit;
}
?>