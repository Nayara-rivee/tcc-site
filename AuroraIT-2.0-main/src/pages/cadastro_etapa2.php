<?php
require_once '../database/auth.php';
require_once '../database/config.php';

$erro = null;
$sucesso = null;
// Verifica se a primeira etapa foi concluída
if (!isset($_SESSION['cadastro']['nome']) || !isset($_SESSION['cadastro']['email']) || !isset($_SESSION['cadastro']['senha'])) {
    header('Location: cadastro.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

   // Filtra e valida os novos campos
    $cpf = htmlspecialchars(trim($_POST['cpf'] ?? ''));
    $rg = htmlspecialchars(trim($_POST['rg'] ?? ''));
    $genero = htmlspecialchars(trim($_POST['genero'] ?? ''));

    // Validações
    if (empty($cpf) || empty($rg) || empty($genero)) {
        $erro = "Todos os campos são obrigatórios!";
    } else {
        // Armazena os novos dados na sessão
        $_SESSION['cadastro']['cpf'] = $cpf;
        $_SESSION['cadastro']['rg'] = $rg;
        $_SESSION['cadastro']['genero'] = $genero;
        
        // Tratamento do upload da foto
        $caminho_foto = null;
        if (isset($_FILES['perfil']) && $_FILES['perfil']['error'] == UPLOAD_ERR_OK) {
            $caminho_uploads = '../img/uploads/';
            $nome_arquivo = uniqid() . '-' . basename($_FILES['perfil']['name']);
            $caminho_destino = $caminho_uploads . $nome_arquivo;

            if (move_uploaded_file($_FILES['perfil']['tmp_name'], $caminho_destino)) {
                $caminho_foto = $caminho_destino;
            } else {
                $erro = "Falha ao mover o arquivo de upload.";
            }
        }

        // Se não houver erro, proceede com o registro completo
        if (is_null($erro)) {
            // Coleta TODOS os dados da sessão, incluindo os da primeira etapa
            $dados_usuario = $_SESSION['cadastro'];
            
            // Adiciona o caminho da foto, se houver
            if ($caminho_foto) {
                $dados_usuario['caminho_foto'] = $caminho_foto;
            }

            // Chama a função de registro com os dados completos
            // A sua função `registrarUsuario` precisará ser modificada para aceitar um array de dados
            $resultado_registro = registrarUsuario($dados_usuario);
            
            // Limpa a sessão após o registro (isso é importante!)
            unset($_SESSION['cadastro']);

            if ($resultado_registro['sucesso']) {
                // Redireciona para o login com uma mensagem de sucesso
                $_SESSION['sucesso'] = $resultado_registro['message'];
                header('Location: login.php');
                exit();
            } else {
                // Se o registro falhar, define a mensagem de erro e permanece na página
                $erro = $resultado_registro['message'];
            }
        }   
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
            <h3 class="text-center mb-4" style="color:#2c234d;">Complete seu Cadastro</h3> <?php if($erro): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?> </div> <?php endif; ?> <form action="" method="POST"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control cpf-mask" name="cpf" id="cpf" placeholder="CPF" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control rg-mask" name="rg" id="rg" placeholder="RG" required>
                </div>
                <div class="mb-3"> <select class="form-control" name="genero" id="genero" required>
                        <option value="">Selecione o Gênero</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                        <option value="prefiro_nao_dizer">Prefiro não dizer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="perfil" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" name="perfil" id="perfil">
                </div>
                <button type="submit" class="btn btn-login w-100" style="background-color: #00C9B1;">Concluir
                    Cadastro
                </button>
                <div class="text-center mt-3">
                    <small style="color:#6c757d;">Já possui uma conta?
                        <a href="./login.php" class="fw-bold" style="text-decoration: none;">Entrar</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="../js/masks.js"></script>
</body>

</html>