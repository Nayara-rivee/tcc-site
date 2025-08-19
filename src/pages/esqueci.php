<?php
require '../database/config.php'; // conexão com banco

if (!isset($_GET['token'])) {
    die("Token inválido!");
}

$token = $_GET['token'];

// Verificar se token existe e ainda está válido
$stmt = $pdo->prepare("SELECT id, token_expira FROM usuarios WHERE token = :token");
$stmt->execute(['token' => $token]);
$user = $stmt->fetch();

if (!$user) {
    die("Token inválido!");
}

// Verificar se expirou
if (strtotime($user['token_expira']) < time()) {
    die("Token expirado! Solicite uma nova recuperação.");
}

// Se enviou nova senha
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar"];

    if ($senha !== $confirmar) {
        echo "As senhas não coincidem!";
    } else {
        // Hash seguro da senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        // Atualizar senha e remover token
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha, token = NULL, token_expira = NULL WHERE id = :id");
        $stmt->execute([
            'senha' => $hash,
            'id' => $user['id']
        ]);

        echo "Senha redefinida com sucesso! <a href='login.php'>Faça login</a>";
        exit;
    }
}
?>

<!-- Formulário HTML -->
<h2>Redefinir Senha</h2>
<form method="POST">
    <label>Nova senha:</label><br>
    <input type="password" name="senha" required><br><br>
    
    <label>Confirmar senha:</label><br>
    <input type="password" name="confirmar" required><br><br>
    
    <button type="submit">Redefinir Senha</button>
</form>
