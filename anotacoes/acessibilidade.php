<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acessibilidade - Aurora Ability IT</title>


    <!-- LINKS BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>


    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="../css-globais/navbar.css" />
    <link rel="stylesheet" href="../css-globais/footer.css" />

    <!-- CSS DA PÁGINA -->
    <link rel="stylesheet" href="../css/acessibilidade.css" />

    <!-- CSS RESPONSIVO -->
    <link rel="stylesheet" href="../css/responsivo.css" />

    <!-- JS ACESSIBILIDADE -->
    <script src="../js/acessibilidade.js" defer></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav class="navbar">
        <div class="logo">Aurora Ability IT</div>
        <ul class="menu">
            <li><a href="index.php">Início</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a href="planos.php">Planos</a></li>
            <li><a href="acessibilidade.php">Acessibilidade</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </nav>

    <main class="acessibilidade">
        <section class="intro">
            <h1>Compromisso com a Acessibilidade</h1>
            <p>Acreditamos que a web deve ser para todos. Por isso, nossos sites incluem recursos que ajudam pessoas com deficiências visuais, auditivas, cognitivas e motoras a navegar com autonomia.</p>
        </section>

        <section class="recursos">
            <div class="recurso">
                <i class='bx bx-zoom-in'></i>
                <h3>Aumento de Fonte</h3>
                <p>Permite que o usuário aumente o tamanho dos textos para facilitar a leitura.</p>
            </div>
            <div class="recurso">
                <i class='bx bx-adjust'></i>
                <h3>Alto Contraste</h3>
                <p>Modo que realça o contraste entre os elementos da página, ideal para baixa visão.</p>
            </div>
            <div class="recurso">
                <i class='bx bx-subtitle'></i>
                <h3>Texto Alternativo</h3>
                <p>Imagens acompanhadas de descrições para usuários de leitores de tela.</p>
            </div>
            <div class="recurso">
                <i class='bx bx-keyboard'></i>
                <h3>Navegação por Teclado</h3>
                <p>Estrutura navegável sem o uso do mouse, ideal para mobilidade reduzida.</p>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Aurora Ability IT. Todos os direitos reservados.</p>
        <p>Desenvolvido com foco em acessibilidade digital.</p>
    </footer>
</body>

</html>