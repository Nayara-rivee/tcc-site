<?php

require_once '../database/config.php'; // Arquivo com a conexão PDO
require_once '../database/auth.php';
// Verifica se o usuário está logado
 if(!estaLogado()) {
    header('Location: login.php');
    exit;
 };

 if($_SESSION['usuario']['nivel'] !== 1) {
   die('Apenas adminstradores podem agendar para outros usuários.');
 };


$usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);
$tipoServico = htmlspecialchars($_POST['tipoServico']);
$dataTermino = htmlspecialchars($_POST['dataTermino']);

//Validação Básica
 if (empty($tipoServico) || empty($dataTermino)) {
    die('Todos os campos são obrigatórios.');
 }

 if (!isset($usuario_id)) {
   die('ID do usuário inválido ou não fornecido.');
 }
 //Conecta ao banco e insere os dados
 try {
    $stmt = $pdo->prepare('INSERT INTO servico (usuario_id, tipo_servico, data_termino) VALUES (:usuario_id, :tipo_servico, :data_termino)');
    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':tipo_servico' => $tipoServico,
        ':data_termino' => $dataTermino,
   
    ]);

    header('Location: ../pages/perfil.php');
    exit;

 } catch (PDOException $e) {
    echo 'Erro ao agendar Serviço: ' . $e->getMessage(); 
 }


?>