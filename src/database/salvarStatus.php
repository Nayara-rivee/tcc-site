<?php
require_once 'config.php';
require_once 'auth.php';

header('Content-Type: application/json; charset=utf-8');

if (!estaLogado() || $_SESSION['usuario']['nivel'] !== 1) {
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['sucesso' => false, 'erro' => 'Método não permitido.']);
    exit;
}

$id_servico = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$novo_status = $_POST['status'] ?? null;

// Simplificando a validação do ID
if ($id_servico === false) {
    echo json_encode(['sucesso' => false, 'erro' => 'ID do serviço inválido.']);
    exit;
}

$status_permitidos = ['Em Andamento', 'Concluído', 'Cancelado'];
if (!in_array($novo_status, $status_permitidos)) {
    echo json_encode(['sucesso' => false, 'erro' => 'Status inválido.']);
    exit;
}

try {
    $stmt = $pdo->prepare('UPDATE servico SET status = :status WHERE id = :id');
    $stmt->execute([
        ':status' => $novo_status,
        ':id' => $id_servico
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['sucesso' => true]);
    } else {
        // Se a consulta foi executada mas nenhuma linha foi afetada
        echo json_encode(['sucesso' => false, 'erro' => 'Nenhum serviço foi atualizado.']);
    }

} catch (PDOException $e) {
    error_log('Erro ao atualizar status: ' . $e->getMessage());
    echo json_encode(['sucesso' => false, 'erro' => 'Erro no banco de dados.']);
}
?>