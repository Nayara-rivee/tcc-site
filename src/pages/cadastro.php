<?php
require '../database/config.php';

$mensagem_status = ''; // Variável para armazenar mensagens de erro ou sucesso
$mensagem_class = ''; // Variável para definir a classe CSS da mensagem

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Coleta dos novos campos
    $nome = trim($_POST["nome"]);
    $email = trim(strtolower($_POST["email"]));
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];
    $cpf = trim($_POST["cpf"]) ?? null; // Novo
    $rg = trim($_POST["rg"]) ?? null; // Novo
    $telefone = $_POST["telefone"] ?? null;
    $data_nascimento = $_POST["data_nascimento"] ?? null;
    $genero = $_POST["genero"] ?? null;

    if ($senha !== $confirmar_senha) {
        $mensagem_status = "As senhas não coincidem!";
        $mensagem_class = 'alert-danger';
    } else {
        // Criptografar senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // A Tabela agora inclui 'cpf' e 'rg'
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, cpf, rg, telefone, data_nascimento, genero, data_criacao) 
                                   VALUES (:nome, :email, :senha, :cpf, :rg, :telefone, :data_nascimento, :genero, NOW())");

            $stmt->execute([
                'nome' => $nome,
                'email' => $email,
                'senha' => $hash,
                'cpf' => $cpf, // Novo
                'rg' => $rg, // Novo
                'telefone' => $telefone,
                'data_nascimento' => $data_nascimento,
                'genero' => $genero
            ]);

            $mensagem_status = "Cadastro realizado com sucesso! Faça login abaixo.";
            $mensagem_class = 'alert-success';
        } catch (PDOException $e) {
            // Verifica se o erro é de violação de UNIQUE (ex: e-mail ou CPF já cadastrado)
            if ($e->getCode() === '23000') {
                $mensagem_status = "Erro: E-mail ou CPF já cadastrado no sistema.";
            } else {
                $mensagem_status = "Erro ao cadastrar: " . $e->getMessage();
            }
            $mensagem_class = 'alert-danger';
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <!-- end libras -->
    <button id="accessibility-toggle-btn" class="floating-btn" aria-expanded="false" aria-controls="accessibility-panel" aria-label="Abrir Menu de Acessibilidade">
        <i class="bi bi-universal-access-circle"></i> Acessibilidade
    </button>

    <div id="accessibility-panel" class="panel hidden" role="dialog" aria-modal="false" aria-labelledby="panel-title">
        <h3 id="panel-title" class="panel-title">Menu de Acessibilidade</h3>
        <button id="close-panel-btn" class="close-panel-btn" aria-label="Fechar Painel">
            <i class="bi bi-x-lg"></i>
        </button>

        <h4 class="control-section-title">Controle de Fonte</h4>
        <div class="control-group">
            <button class="control-btn" data-action="increase-font" aria-label="Aumentar Tamanho da Fonte">
                <i class="bi bi-fonts"></i><span>Tamanho de fonte (A+)</span>
            </button>
            <button class="control-btn" data-action="decrease-font" aria-label="Diminuir Tamanho da Fonte">
                <i class="bi bi-fonts"></i><span>Tamanho de fonte (A-)</span>
            </button>
            <button class="control-btn" data-action="increase-line-height" aria-label="Aumentar Espaço entre Linhas">
                <i class="bi bi-text-height"></i><span>Espaço entre linhas (+)</span>
            </button>
            <button class="control-btn" data-action="decrease-line-height" aria-label="Diminuir Espaço entre Linhas">
                <i class="bi bi-text-height"></i><span>Espaço entre linhas (-)</span>
            </button>
            <button class="control-btn" data-action="increase-letter-spacing" aria-label="Aumentar Espaço entre Letras">
                <i class="bi bi-text-spacing"></i><span>Espaço entre letras (+)</span>
            </button>
            <button class="control-btn" data-action="decrease-letter-spacing" aria-label="Diminuir Espaço entre Letras">
                <i class="bi bi-text-spacing"></i><span>Espaço entre letras (-)</span>
            </button>
        </div>

        <h4 class="control-section-title">Controle de cor</h4>
        <div class="control-group">
            <button class="control-btn" data-action="toggle-contrast" aria-label="Contraste de cores (Alto Contraste)">
                <i class="bi bi-circle-half"></i><span>Contraste de cores</span>
            </button>
            <button class="control-btn" data-action="colorblind-protanopia" aria-label="Simulação de Protanopia">
                <i class="bi bi-palette"></i><span>Protanopia (Vermelho)</span>
            </button>
            <button class="control-btn" data-action="colorblind-deuteranopia" aria-label="Simulação de Deuteranopia">
                <i class="bi bi-palette"></i><span>Deuteranopia (Verde)</span>
            </button>
            <button class="control-btn" data-action="colorblind-tritanopia" aria-label="Simulação de Tritanopia">
                <i class="bi bi-palette"></i><span>Tritanopia (Azul)</span>
            </button>
        </div>

        <button id="restore-btn" class="restore-btn" aria-label="Restaurar todas as configurações de acessibilidade">
            <i class="bi bi-arrow-clockwise me-1"></i>Restaurar recursos
        </button>
    </div>

    <a href="https://wa.me/5511974557734" target="_blank" class="position-fixed bottom-0 end-0 m-3 whatsapp"
        style="z-index: 22222;">
        <img src="../img/logo/whatsapp.png" alt="WhatsApp" class="img-fluid rounded-circle shadow whatsapp-hover"
            style="width: clamp(60px, 10vw, 70px); height: auto;">
    </a>

    <div id="content-wrapper" class="main-content-wrapper">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="row w-100 justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4">Cadastre-se</h4>

                            <?php if (!empty($mensagem_status)): ?>
                                <div class="alert <?= $mensagem_class; ?> alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($mensagem_status); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php if ($mensagem_class === 'alert-success'): ?>
                                        <div class="mt-2"><a href='login.php' class="alert-link font-weight-bold">Clique aqui para
                                                fazer login.</a></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <form method="post" class="myform">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nome completo</label>
                                        <input type="text" class="form-control" name="nome" placeholder="Ex: Maria Silva"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="exemplo@email.com" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>CPF</label>
                                        <input type="text" class="form-control cpf-mask" name="cpf" placeholder="999.999.999-99"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>RG (Opcional)</label>
                                        <input type="text" class="form-control rg-mask" name="rg" placeholder="99.999.999-9">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Senha</label>
                                        <input type="password" class="form-control" name="senha" placeholder="password"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Confirmar senha</label>
                                        <input type="password" class="form-control" name="confirmar_senha"
                                            placeholder="password" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Telefone / WhatsApp</label>
                                        <input type="text" class="form-control number-mask" name="telefone"
                                            placeholder="(99) 99999-9999">
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

                            <div class="login-link-container">
                                Já tem uma conta? <a href="login.php">Fazer Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="../js/masks.js"></script>
    <!-- JSs -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="../js/acessibilidade.js"></script>
</body>

</html>