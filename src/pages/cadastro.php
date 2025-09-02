<?php
require '../database/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];
    $telefone = $_POST["telefone"] ?? null;
    $data_nascimento = $_POST["data_nascimento"] ?? null;
    $genero = $_POST["genero"] ?? null;

    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem!";
        exit;
    }

    // Criptografar senha
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, telefone, data_nascimento, genero) 
                               VALUES (:nome, :email, :senha, :telefone, :data_nascimento, :genero)");
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash,
            'telefone' => $telefone,
            'data_nascimento' => $data_nascimento,
            'genero' => $genero
        ]);
        echo "Cadastro realizado com sucesso! <a href='login.php'>Fazer login</a>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../css/css-pages/login.css">
</head>

<body>
    <!-- Formulário -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Cadastre-se</h4>
                        <form method="post" class="myform">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nome completo</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Ex: Maria Silva" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" name="senha" placeholder="password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirmar senha</label>
                                    <input type="password" class="form-control" name="confirmar_senha" placeholder="password" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Telefone / WhatsApp</label>
                                    <input type="text" class="form-control" name="telefone" placeholder="(99) 99999-9999">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Data de Nascimento</label>
                                    <input type="date" class="form-control" name="data_nascimento">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Gênero</label>
                                <select class="form-control" name="genero">
                                    <option value="">Selecione</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="outro">Outro</option>
                                    <option value="nao_informar">Prefiro não informar</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                <i class="far fa-user pr-2"></i> Cadastrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>