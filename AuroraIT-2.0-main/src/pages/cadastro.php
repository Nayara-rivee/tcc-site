<?php
require_once '../database/auth.php';
require_once '../database/config.php';

$erro = null;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Filtra e valida os inputs
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Validações
    if(empty($nome) || empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem!";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres";
    } else {
        // Se a validação for um sucesso...
        // Armazena os dados da primeira etapa na sessão
        $_SESSION['cadastro']['nome'] = $nome;
        $_SESSION['cadastro']['email'] = $email;
        $_SESSION['cadastro']['senha'] = password_hash($senha, PASSWORD_DEFAULT); // Armazena a senha já com hash

        // Redireciona para a próxima etapa
        header('Location: cadastro_etapa2.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurorability | Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css-pages/login.css">
    <link rel="shortcut icon" href="../img/favicon/favicon.png" type="image/x-icon">

</head>

<body>

    <div class="container">
        <div class="login-box">
            <h3 class="text-center mb-4" style="color:#2c234d;">Cadastre-se</h3>
            <!-- Mensagens -->
            <?php if($erro): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
            <?php endif; ?>
            <form action="../pages/cadastro.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha"
                        placeholder="Confirmar Senha" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">

                </div>
                <button type="submit" class="btn btn-login w-100"
                    style="background-color: #00C9B1;">Cadastre-se</button>
                <div>
                    <div class="text-center">
                        <small style="color:#6c757d;">Já possui uma conta?
                            <a href="./login.php " class=" fw-bold" style="text-decoration: none;">Entrar</a>
                        </small>

                    </div>
                </div>


            </form>
        </div>
    </div>

</body>

</html>