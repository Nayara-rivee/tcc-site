<?php
require_once '../database/config.php'; // Arquivo com a conexão PDO
require_once '../database/auth.php';
// Verifica se o usuário está logado
 if(!estaLogado()) {
    header('Location: login.php');
    exit;
 }

$mensagem = '';
$usuario_id = $_SESSION['usuario']['id'];

//Busca os dados atuais do usuário
$sql = 'SELECT nome, email FROM usuarios WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();

//Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($nome)) {
        $mensagem = '<div class="alert alert-danger"> O nome é obrigatório!</div>';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = '<div class="alert alert-danger"> Insira um E-mail válido!</div>';
    } else {
        try {
            //atualiza banco de dados
            $sql = 'UPDATE usuarios SET nome = ?, email = ? WHERE id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $usuario_id]);

            //Atualiza sessão
            $_SESSION['usuario']['nome'] = $nome;
            $_SESSION['usuario']['email'] = $email;

            $mensagem = '<div class="alert alert-success">Dados Atualizados com sucesso!</div>';

            ///recarrega dados do usuário
            $sql = "SELECT nome, email FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario_id]);
            $usuario = $stmt->fetch();
            
        }catch (PDOException $e){
            if ($e->getCode () == 23000) {
                $mensagem = '<div class="alert alert-danger">Este e-mail já está cadastrado!</div>';
                
            } else {
                $mensagem = '<div class="alert alert-danger">Erro ao atualizar' . $e->getMessage() . '</div>';
            }
        }
    }
}
?>