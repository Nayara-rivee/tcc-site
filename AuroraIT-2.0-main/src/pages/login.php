<?php
require_once '../database/config.php';
require_once '../database/auth.php';

$erro = null;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    
    if(logarUsuario($email, $senha)) {
        $redirect = $_SESSION['redirect_url'] ?? '../../index.php';
        unset($_SESSION['redirect_url']);
        header("Location: $redirect");
        exit();
    } else {
        $erro = 'Credenciais inválidas. Por favor, tente novamente.';
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css-pages/login.css">
    <link rel="shortcut icon" href="../img/favicon/favicon.png" type="image/x-icon">
</head>

<body>

    <div class="container">
        <div class="login-box">
            <h3 class="text-center mb-4" style="color:#2c234d;">Entrar</h3>
            <?php if($erro): ?>
            <div class="alert alert-danger mb-4"><?=htmlspecialchars($erro)?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe" style="color:#6c757d;">Me lembre</label>
                    </div>
                    <a href="#" class="text-decoration-none" style="color:#00C9B1;">Esqueceu?</a>

                </div>
                <button type="submit" class="btn btn-login w-100" style="background: #00C9B1;">Entrar</button>
                <div>
                    <div class="text-center">
                        <small style="color:#6c757d;">Não possui uma conta?
                            <a href="./cadastro.php " class=" fw-bold" style="text-decoration: none;">Cadastre-se</a>
                        </small>

                    </div>
                </div>

            </form>
        </div>
    </div>

</body>

</html>