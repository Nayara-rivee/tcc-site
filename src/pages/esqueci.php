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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../css/css-pages/login.css">
</head>

<body>
    <!-- Formulário -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card py-3 px-2">
                    <p class="text-center mb-3 mt-2">Redefinir Senha</p>

                    <form method="post" class="myform">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Nova senha" name="senha" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirmar senha" name="senha" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">
                                <small><i class="far fa-user pr-2"></i>Redefinir Senha</small>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>