<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../database/config.php';
require '../database/auth.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Usa a função do auth.php
    if (logarUsuario($email, $senha)) {
        header("Location: perfil.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../css/css-pages/login.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-2">
                    <p class="text-center mb-3 mt-2">Login</p>

                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger text-center"><?= $erro ?></div>
                    <?php endif; ?>

                    <form method="post" class="myform">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Manter conectado</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 text-right">
                                <a href="esqueci-senha.php">Esqueci minha senha</a>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">
                                <small><i class="far fa-user pr-2"></i> Entrar</small>
                            </button>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <P>Não tem uma conta?</P>
                                </div>
                                <div class="col-md-6 col-12 text-right">
                                    <a href="cadastro.php">Cadastre-se</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>