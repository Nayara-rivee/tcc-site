<?php
require '../database/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Criptografar senha
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash
        ]);
        echo "Cadastro realizado com sucesso! <a href='login.php'>Fazer login</a>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
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
                    <p class="text-center mb-3 mt-2">Cadastre-se</p>

                    <form method="post" class="myform">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">
                                <small><i class="far fa-user pr-2"></i>Cadastrar</small>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>