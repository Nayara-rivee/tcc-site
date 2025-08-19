<?php
require '../database/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        echo "Login realizado com sucesso! <a href='painel.php'>Ir para o painel</a>";
    } else {
        echo "Email ou senha inválidos!";
    }
}
?>

<!-- Formulário -->
<h2>Login</h2>
<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    <a href="esqueci-senha.php">esqueci senha</a>

    <button type="submit">Entrar</button>
</form>