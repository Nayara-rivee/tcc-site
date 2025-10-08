<?php
require_once '../database/config.php';
require_once '../database/auth.php';

if (!estaLogado()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/perfil.php');
    exit;
}

try {
    $usuario_id = $_SESSION['usuario']['id'];
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $numero = trim($_POST['numero'] ?? '');

    if (empty($nome) && empty($email) && empty($numero)) {
        header('Location: ../pages/perfil.php?msg=Erro: Preencha pelo menos um dos campos (Nome ou Email).');
        exit;
    }
    $campos = [];
    $valores = []; 
    
    if (!empty($nome)) {
        $campos[] = "nome = ?";
        $valores[] = $nome;
    }
    if (!empty($email)) {
        $campos[] = "email = ?";
        $valores[] = $email;
    }
    if (!empty($numero)) {
        $campos[] = "numero = ?";
        $valores[] = $numero;
    }

    $setString = implode(', ', $campos);
    $sql = "UPDATE usuarios SET $setString WHERE id = ?";
    $valores[] = $usuario_id;
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute($valores)) {
        header('Location: ../pages/perfil.php?msg=Sucesso: Dados alterados com sucesso!');
        exit;
    } else {
        header('Location: ../pages/perfil.php?msg=Erro: Não foi possível alterar os dados.');
        exit;
    }

} catch (PDOException $e) {
    header('Location: ../pages/perfil.php?msg=Erro: Ocorreu um problema no servidor, tente novamente mais tarde.');
    exit; 
}
?>