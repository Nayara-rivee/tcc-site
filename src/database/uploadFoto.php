<?php
require_once 'config.php';
require_once 'auth.php';

if (!estaLogado()) {
    header("Location: ../pages/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $foto = $_FILES['foto'];

    if ($foto['error'] === 0) {
        $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid('foto_') . '.' . strtolower($extensao);
        $destino = '../uploads/' . $novoNome;

        // Cria a pasta uploads se não existir
        if (!is_dir('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        if (move_uploaded_file($foto['tmp_name'], $destino)) {
            // Atualiza no banco
            $stmt = $pdo->prepare("UPDATE usuarios SET foto = :foto WHERE id = :id");
            $stmt->execute(['foto' => $novoNome, 'id' => $usuario_id]);

            // Atualiza sessão
            $_SESSION['usuario']['foto'] = $novoNome;

            header("Location: ../pages/perfil.php?sucesso=1");
            exit;
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Erro no upload.";
    }
} else {
    echo "Nenhum arquivo enviado.";
}
