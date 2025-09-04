<?php
require_once '../database/auth.php';
require_once '../database/config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário - Aurora IT</title>
    <link rel="stylesheet" href="../css/perfilUsuario.css">
</head>

<body>
    <div class="floating-elements">
        <div class="floating-element" style="left: 10%; width: 60px; height: 60px; animation-delay: -2s;"></div>
        <div class="floating-element" style="left: 70%; width: 80px; height: 80px; animation-delay: -8s;"></div>
        <div class="floating-element" style="left: 40%; width: 40px; height: 40px; animation-delay: -15s;"></div>
    </div>

    <div class="container">
        <div class="header">
            <div class="profile-section">
                <div class="profile-avatar">JD</div>
                <div class="profile-info">
                    <h1>Jane Doe</h1>
                    <p>jane.doe@example.com</p>
                    <p>+1 234 567 8900</p>
                    <p>Cliente desde: Janeiro 2024</p>
                </div>
            </div>
            <div class="profile-stats">
                <div class="stat-card">
                    <span class="stat-number">4</span>
                    <span class="stat-label">Projetos Totais</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">1</span>
                    <span class="stat-label">Em Andamento</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">3</span>
                    <span class="stat-label">Concluídos</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">R$ 12.500</span>
                    <span class="stat-label">Investimento Total</span>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="services-section">
                <h2 class="section-title">Meus Serviços</h2>

                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon">🚀</div>
                                <span>Site Institucional - Advocacia Premium</span>
                            </div>
                            <span class="status-badge status-in-progress">Em Andamento</span>
                        </div>
                        <div class="service-details">
                            Site institucional completo com design moderno, sistema de agendamento de consultas e blog
                            integrado. Inclui otimização SEO e responsividade total.
                        </div>
                        <div class="service-progress">
                            <div class="progress-label">
                                <span>Progresso: 75%</span>
                                <span>Entrega: 15/09/2025</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="service-actions">
                            <button class="btn btn-primary">📋 Ver Detalhes</button>
                            <button class="btn btn-secondary">💬 Chat</button>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon">✅</div>
                                <span>E-commerce - Loja Virtual</span>
                            </div>
                            <span class="status-badge status-completed">Concluído</span>
                        </div>
                        <div class="service-details">
                            Loja virtual completa com sistema de pagamento, gestão de estoque, painel administrativo e
                            integração com correios para cálculo de frete.
                        </div>
                        <div class="service-progress">
                            <div class="progress-label">
                                <span>Concluído em: 28/08/2025</span>
                                <span>⭐ 5.0 - Avaliado</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="service-actions">
                            <button class="btn btn-primary">🌐 Acessar Site</button>
                            <button class="btn btn-secondary">⭐ Avaliar</button>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon">📱</div>
                                <span>Landing Page - Curso Online</span>
                            </div>
                            <span class="status-badge status-completed">Concluído</span>
                        </div>
                        <div class="service-details">
                            Landing page otimizada para conversão com formulários integrados, player de vídeo, sistema
                            de checkout e integração com plataformas de pagamento.
                        </div>
                        <div class="service-progress">
                            <div class="progress-label">
                                <span>Concluído em: 10/08/2025</span>
                                <span>⭐ 4.8 - Avaliado</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="service-actions">
                            <button class="btn btn-primary">🌐 Acessar Site</button>
                            <button class="btn btn-secondary">📊 Relatórios</button>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon">🎨</div>
                                <span>Redesign - Portfolio Arquitetura</span>
                            </div>
                            <span class="status-badge status-completed">Concluído</span>
                        </div>
                        <div class="service-details">
                            Redesign completo do site portfolio com galeria interativa de projetos, formulário de
                            orçamento e otimização para dispositivos móveis.
                        </div>
                        <div class="service-progress">
                            <div class="progress-label">
                                <span>Concluído em: 22/07/2025</span>
                                <span>⭐ 5.0 - Avaliado</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="service-actions">
                            <button class="btn btn-primary">🌐 Acessar Site</button>
                            <button class="btn btn-secondary">🔄 Manutenção</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="sidebar-card">
                    <h3 class="section-title">Ações Rápidas</h3>
                    <div class="quick-actions">
                        <a href="#" class="action-btn">
                            <span>➕</span> Novo Projeto
                        </a>
                        <a href="#" class="action-btn"
                            style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <span>💬</span> Suporte
                        </a>
                        <a href="#" class="action-btn"
                            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <span>📊</span> Relatórios
                        </a>
                    </div>
                </div>

                <div class="sidebar-card">
                    <h3 class="section-title">Atividades Recentes</h3>
                    <div class="recent-activity">
                        <div class="activity-item">
                            <div class="activity-icon">✅</div>
                            <div class="activity-content">
                                <div class="activity-title">Projeto aprovado</div>
                                <div class="activity-time">Há 2 horas</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">💬</div>
                            <div class="activity-content">
                                <div class="activity-title">Nova mensagem no chat</div>
                                <div class="activity-time">Há 5 horas</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">📊</div>
                            <div class="activity-content">
                                <div class="activity-title">Relatório de progresso enviado</div>
                                <div class="activity-time">Ontem</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">🚀</div>
                            <div class="activity-content">
                                <div class="activity-title">Site publicado com sucesso</div>
                                <div class="activity-time">2 dias atrás</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">⭐</div>
                            <div class="activity-content">
                                <div class="activity-title">Avaliação de 5 estrelas recebida</div>
                                <div class="activity-time">3 dias atrás</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-card">
                    <h3 class="section-title">Próximas Entregas</h3>
                    <div class="activity-item">
                        <div class="activity-icon">📅</div>
                        <div class="activity-content">
                            <div class="activity-title">Site Advocacia - Revisão Final</div>
                            <div class="activity-time">Em 3 dias</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">🎯</div>
                        <div class="activity-content">
                            <div class="activity-title">Treinamento de uso do painel</div>
                            <div class="activity-time">Em 5 dias</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/perfilUsuario.js">
    </script>
</body>

</html>