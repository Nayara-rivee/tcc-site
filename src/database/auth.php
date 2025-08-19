<?php
require_once 'config.php';

function registrarUsuario($nome, $email, $senha) {
    global $pdo;

    //Verifica se tem algum campo vazio
    if(empty($nome) || empty($senha) || empty($email)) {
        return ['sucesso' => false, 'message'=> 'Todos os campos são obrigatórios.'];
    };

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['sucesso' => false, 'message' => 'Email inválido!'];
    }

    if(strlen($senha)<6) {
        return ['sucesso' => false, 'message' => 'A senha deve ter o mínimo 6 caractéres.'];
    }

    $sql = 'SELECT id FROM usuarios WHERE email = :email';
    $stmt = $pdo-> prepare(($sql));
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    if($stmt->rowCount() > 0) {
        return ['sucesso' => false, 'message' => 'Email já cadastrado'];
    };

    //Criptografia da senha

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);

    //Inserção no banco
    try {
        $sql = 'INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

        $result = $stmt->execute();

        return [
            'sucesso' => $result,
            'message' => $result ? 'Registro Realizado com Sucesso' : 'Erro ao Registrar'
        ];
        
    } catch (PDOException $e) {
        return['sucesso' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()];
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