<?php

require_once '../database/config.php'; 
require_once '../database/auth.php';



if(!estaLogado()) {
    header('Location: login.php');
    exit;
 };

$usuario_id = $_SESSION['usuario']['id'];

$sql_servicos = "SELECT
    -- Informações básicas
    T1.id AS servico_id,
    T1.data_inicio,
    T1.data_termino,
    T1.status,

    -- Informações do Tipo de Serviço
    T2.nome_tipo AS nome_servico,
    T2.valor AS preco_unitario,

    -- Informações de Comentários (opcional, pode ser útil para o relatório)
    (SELECT COUNT(T3.id) FROM comentarios T3 WHERE T3.servico_id = T1.id) AS total_comentarios
FROM
    servico T1
JOIN
    tipos_servico T2 ON T1.tipo_servico_id = T2.id
WHERE
    T1.usuario_id = :usuario_id
ORDER BY
    T1.data_inicio DESC;";
$stmt = $pdo->prepare($sql_servicos);
$stmt->execute([':usuario_id' => $usuario_id]);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$filename = 'relatorio_servicos_usuario_' . $usuario_id . '_' . date('Ymd_His') . '.csv';


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');


$output = fopen('php://output', 'w');


$delimiter = ',';

fputcsv($output, [
    'Nome do Projeto', 
    'Descricao', 
    'Preco Unitario', 
    'Quantidade', 
    'Subtotal', 
    'Data de Criacao',
    'Status'
], $delimiter);


foreach ($servicos as $row) {
    
    $row['Preco Unitario'] = number_format($row['preco'], 2, ',', '.');
    $row['Subtotal'] = number_format($row['subtotal'], 2, ',', '.');
    
    
    fputcsv($output, [
        $row['nome_projeto'],
        $row['descricao'],
        $row['Preco Unitario'],
        $row['quantidade'],
        $row['Subtotal'],
        $row['data_criacao'],
        $row['status']
    ], $delimiter);
}



fputcsv($output, [''], $delimiter); // Linha em branco
fputcsv($output, ['--- RESUMO DO USUÁRIO ---'], $delimiter); // Título
fputcsv($output, ['Total de Serviços:', $totalServicos ?? 0], $delimiter);
fputcsv($output, ['Serviços em Andamento:', $TotalServicosEmAndamento ?? 0], $delimiter);
fputcsv($output, ['Serviços Concluídos:', $TotalServicosConcluidos ?? 0], $delimiter);
fputcsv($output, ['Investimento Total:', 'R$ ' . $TotalGastoFormatado ?? 'R$ 0,00'], $delimiter);


fclose($output);
exit();
?>