<?php
require_once '../database/config.php'; 
require_once '../database/auth.php';

 
 if($_SESSION['usuario']['nivel'] !== 1 || !estaLogado()) {
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado.']);
    exit;
 };

$servico_id = filter_input(INPUT_POST, 'servico_id', FILTER_VALIDATE_INT);
$titulo = filter_input(INPUT_POST, 'tituloComentario', FILTER_SANITIZE_STRING);
$comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
$usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);

if (!$servico_id || empty($titulo) || empty($comentario) || !$usuario_id) {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos ou incompletos.']);
    exit;
}

try {
    $stmt = $pdo->prepare('
        INSERT INTO comentarios (servico_id, usuario_id, titulo_comentario, comentario, data_criacao) 
        VALUES (:servico_id, :usuario_id, :titulo, :comentario, NOW())
    ');
    
    $stmt->execute([
        ':servico_id' => $servico_id,
        ':usuario_id' => $usuario_id,
        ':titulo' => $titulo,
        ':comentario' => $comentario,
    ]);
    
    echo json_encode(['sucesso' => true]);

} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>