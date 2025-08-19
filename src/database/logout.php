<?php

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Se desejar apagar o cookie da sessão também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou início
header("Location: ../pages/login.php"); // ou use "index.php" se preferir
?>