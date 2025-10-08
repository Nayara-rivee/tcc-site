<?php

require_once 'config.php';
require_once 'auth.php';

header('Content-Type: application/json');

// Garante que apenas administradores logados possam editar serviços
if (!estaLogado() || $_SESSION['usuario']['nivel'] !== 1) {
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado.']);
    exit;
}

// Pega os dados enviados pelo JavaScript
$id_servico = filter_input(INPUT_POST, 'id_servico', FILTER_VALIDATE_INT);
$novo_tipo_id = filter_input(INPUT_POST, 'tipoServicoId', FILTER_VALIDATE_INT);
$nova_data_termino = filter_input(INPUT_POST, 'dataTermino', FILTER_SANITIZE_STRING);

// Validação básica
if (!$id_servico || empty($novo_tipo_id) || empty($nova_data_termino)) {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos ou incompletos.']);
    exit;
}

try {
    // Prepara e executa a consulta para atualizar o serviço
    $stmt = $pdo->prepare('
        UPDATE servico
        SET tipo_servico_id = :tipo_servico_id, data_termino = :data_termino
        WHERE id = :id_servico
    ');
    
    $stmt->execute([
        ':tipo_servico_id' => $novo_tipo_id,
        ':data_termino' => $nova_data_termino,
        ':id_servico' => $id_servico,
    ]);

    echo json_encode(['sucesso' => true]);

} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
}

?>