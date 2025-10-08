<?php
require_once 'config.php';

function registrarUsuario($dados) {
    global $pdo;

    // Extrai e limpa os dados do array
    $nome = trim($dados['nome'] ?? '');
    $email = trim($dados['email'] ?? '');
    $senha_hash_final = $dados['senha'] ?? '';
    $cpf = $dados['cpf'] ?? null;
    $rg = $dados['rg'] ?? null;
    $genero = $dados['genero'] ?? null;
    $numero = $dados['numero'] ?? null;
    $caminho_foto = $dados['caminho_foto'] ?? null;

    if (empty($nome) || empty($email) || empty($senha_hash_final)) {
        return ['sucesso' => false, 'message' => 'Nome, e-mail e senha são obrigatórios.'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['sucesso' => false, 'message' => 'Formato de e-mail inválido!'];
    }

    // --- VERIFICAÇÃO DE E-MAIL DUPLICADO ---
    $sql_check = 'SELECT id FROM usuarios WHERE email = :email';
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([':email' => $email]);
    
    if ($stmt_check->fetch()) {
        return ['sucesso' => false, 'message' => 'Este endereço de e-mail já está cadastrado.'];
    }

    // --- PREPARAÇÃO E INSERÇÃO NO BANCO ---
    try {
        $sql = 'INSERT INTO usuarios (nome, email, numero, senha, cpf, rg, genero, caminho_foto) 
                VALUES (:nome, :email, :numero, :senha, :cpf, :rg, :genero, :caminho_foto)';
                
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':numero' => $numero,
            ':senha' => $senha_hash_final, 
            ':cpf' => $cpf,
            ':rg' => $rg,
            ':genero' => $genero,
            ':caminho_foto' => $caminho_foto
        ]);

        return [
            'sucesso' => $result,
            'message' => $result ? 'Cadastro realizado com sucesso!' : 'Ocorreu um erro ao registrar.'
        ];
        
    } catch (PDOException $e) {
       
        return ['sucesso' => false, 'message' => 'Erro no banco de dados. Por favor, tente mais tarde.'];
    }
}

//Função para logar usuário
function logarUsuario($email, $senha) {
    global $pdo;

    //Busca usuário pelo email
    $sql = 'SELECT * FROM usuarios WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //Verifica a senha
        if(password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);

            //Remove a senha antes de salvar na sessão
            unset($usuario['senha']);
            $_SESSION['usuario'] = $usuario;
            $_SESSION['ultimo_acesso'] = time();
            return true;
        }
    }
    return false; //credienciais falsas
}

//Verifica se o usuário esta logado
function estaLogado() {
    return isset($_SESSION['usuario']) && (time() - ($_SESSION['ultimo_acesso'] ?? 0)) < 3600;
}

//Atualiza o tempo de acesso ativo
function renovarSessao() {
    if(isset($_SESSION['usuario'])) {
        $_SESSION['ultimo_acesso'] = time();
    }
}

//Funcção para redirecionar usuário não logados
function verificarLogin($redirect = '../../index.php') {
    if(!estaLogado()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: $redirect");
        exit(); 
    } else {
        renovarSessao();
    }
}
?>