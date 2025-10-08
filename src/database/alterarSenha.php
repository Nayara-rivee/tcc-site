<?php
require_once '../database/config.php'; 
require_once '../database/auth.php';


if(!estaLogado()) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$senha_atual = $_POST['senha_atual'] ?? '';
$nova_senha = $_POST['nova_senha'] ?? '';
$confirmar_senha = $_POST['confirmar_senha'];


// verificações básicas
 if (empty($senha_atual) || empty($nova_senha) || empty($confirmar_senha)) {
     header('Location: ../pages/perfil.php?msg=Preencha todos os campos.');
    exit;
 }

 
 if ($nova_senha !== $confirmar_senha) {
     header('Location: ../pages/perfil.php?msg=As senhas não coincidem.');
    exit;
 }

  if ($nova_senha === $senha_atual) {
     header('Location: ../pages/perfil.php?msg=A nova senha deve ser diferente da atual.');
    exit;
 }

 //Pegar a senha atual do banco
 $sql = 'SELECT senha FROM usuarios WHERE id = ?';
 $stmt = $pdo->prepare($sql);
 $stmt->execute([$usuario_id]);
 $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

 if(!$usuario || !password_verify($senha_atual, $usuario['senha'])) {
     header('Location: ../pages/perfil.php?msg=Senha atual incorreta.');
 }

 //Atualiza com a nova senha
 $nova_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
 $sql = 'UPDATE usuarios SET senha = ? WHERE id = ?';
 $stmt = $pdo->prepare($sql);
 $stmt->execute([$nova_hash, $usuario_id]);

 header('Location: ../pages/perfil.php?msg=Senha alterada com sucesso.');
 exit;

?>