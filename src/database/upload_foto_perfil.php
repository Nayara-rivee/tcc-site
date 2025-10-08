<?php
require_once 'auth.php'; // Caminho ajustado
require_once 'config.php'; // Caminho ajustado

if (!estaLogado()) {
    header('Location: ../pages/login.php'); // Redireciona para o login se não estiver logado
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$destino_base = '../../img/uploads/perfil/'; // Ajuste o caminho conforme sua estrutura
$status = 'erro';
$mensagem = '';

// Garante que o diretório de destino existe
if (!is_dir($destino_base)) {
    mkdir($destino_base, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])) {
    $foto = $_FILES['foto_perfil'];

    // 1. Validação de Erro
    if ($foto['error'] !== UPLOAD_ERR_OK) {
        $mensagem = "Erro no upload. Código: " . $foto['error'];
    }
    
    // 2. Validação de Tamanho (Ex: Max 5MB)
    elseif ($foto['size'] > 5 * 1024 * 1024) {
        $mensagem = "A imagem é muito grande. O limite é 5MB.";
    }

    // 3. Validação de Tipo
    else {
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($foto['type'], $tipos_permitidos)) {
            $mensagem = "Apenas arquivos JPG, PNG e WEBP são permitidos.";
        } else {
            // 4. Salvar o arquivo
            $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
            // Nome de arquivo único e seguro (ex: 1_Nayara_timestamp.png)
            $nome_arquivo = $usuario_id . '_' . urlencode($_SESSION['usuario']['nome']) . '_' . time() . '.' . $extensao;
            $destino = $destino_base . $nome_arquivo;
            
            // Move o arquivo temporário para o destino final
            if (move_uploaded_file($foto['tmp_name'], $destino)) {
                
                // 5. Atualizar o caminho no banco de dados
                $caminho_salvar = 'img/uploads/perfil/' . $nome_arquivo; // Caminho relativo que o HTML usará
                
                // Opcional: Deletar foto antiga do disco antes de atualizar o banco
                // Primeiro, pegue o caminho antigo para deletar
                $stmtFotoAntiga = $pdo->prepare('SELECT caminho_foto FROM usuarios WHERE id = :usuario_id');
                $stmtFotoAntiga->execute([':usuario_id' => $usuario_id]);
                $caminhoAntigo = $stmtFotoAntiga->fetchColumn();

                if ($caminhoAntigo && $caminhoAntigo !== $caminho_salvar) {
                    $caminhoAbsolutoAntigo = '../../' . $caminhoAntigo; // Ajuste o caminho absoluto
                    if (file_exists($caminhoAbsolutoAntigo)) {
                        unlink($caminhoAbsolutoAntigo);
                    }
                }
                
                // Atualiza o banco
                $stmtUpdate = $pdo->prepare('UPDATE usuarios SET caminho_foto = :caminho_foto WHERE id = :usuario_id');
                $stmtUpdate->execute([
                    ':caminho_foto' => $caminho_salvar,
                    ':usuario_id' => $usuario_id
                ]);

                $status = 'sucesso';
                $mensagem = "Foto de perfil atualizada com sucesso!";
            } else {
                $mensagem = "Erro ao mover o arquivo enviado.";
            }
        }
    }
} else {
    $mensagem = "Nenhum arquivo enviado ou método inválido.";
}

// Redireciona de volta para o perfil com a mensagem de status
header("Location: ../pages/perfilUsuario.php?upload_status=" . urlencode($status) . "&upload_msg=" . urlencode($mensagem));
exit;