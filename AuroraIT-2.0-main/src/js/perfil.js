  const searchInput = document.getElementById('searchUsuario');
    const tabelaUsuarios = document.querySelector('.usuarios');
    const tabelaUsuariosContainer = document.querySelector('.table-responsive');
    const btnAgendarServico = document.getElementById('btnAgendarServico');
    const servicosUsuarioContainer = document.getElementById('servicosUsuario');

    // Variável para armazenar todos os usuários inicialmente carregados    
    let todosUsuarios = [];

    // Carrega todos os usuários quando a página é carregada
    document.addEventListener('DOMContentLoaded', function() {
       carregarUsuarios();
    });

    function carregarUsuarios() {
        fetch('../database/buscarUsuarios.php?q=')
        .then(response => response.json())
        .then(usuarios => {
            todosUsuarios = usuarios;
            renderUsuarios(usuarios);
            adicionarListenersBotoesUsuario()
        })
        .catch(error => {
            console.error('Erro ao carregar Usuário:', error);
            tabelaUsuarios.innerHTML = '<tr><td colspan="4">Erro ao carregar usuários</td></tr>'
        });
    }

    function adicionarListenersBotoesUsuario() {
        document.querySelectorAll('.btn-usuario').forEach(btn => {
            btn.addEventListener('click', selecionarUsuario);
        });
    }

    function renderUsuarios(usuarios) {
        let html = '';
        if (usuarios.length > 0) {
            usuarios.forEach(usuario => {
                // Formata a data corretamente
                const data = new Date(usuario.data_criacao);
                const dataFormatada = data.toLocaleDateString('pt-BR', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });

                html += `
                <tr class="btn-usuario" data-id="${usuario.id}" style="cursor: pointer;">
                    <td>${usuario.nome}</td>
                    <td>${usuario.email}</td>
                    <td>${dataFormatada}</td>
                    <td><span class="badge bg-success">${usuario.nivel}</span></td>
                </tr>
                `;
            });
        } else {
            html = `
            <tr>
                <td colspan="4" class="text-center">Nenhum usuário encontrado.</td>
            </tr>
            `;
        }
        tabelaUsuarios.innerHTML = html;
        adicionarListenersBotoesUsuario();
    }

    // Função para filtrar usuários localmente (sem requisição ao servidor)
    function filtrarUsuarios(termo) {
        termo = termo.toLowerCase().trim();

        if (termo === '') {
            // Se o campo de pesquisa estiver vazio, mostra todos os usuários
            renderUsuarios(todosUsuarios);
            return;
        }

        const usuariosFiltrados = todosUsuarios.filter(usuario => {
            return (
                usuario.nome.toLowerCase().includes(termo) ||
                usuario.email.toLowerCase().includes(termo) ||
                usuario.nivel.toString().includes(termo)
            );
        });

        renderUsuarios(usuariosFiltrados);
    }

    // Debounce para melhorar performance
    let debounceTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimeout);
        const termo = this.value;
        debounceTimeout = setTimeout(() => {
            filtrarUsuarios(termo);
        }, 300);
    });

    function selecionarUsuario() {
        btnAgendarServico.classList.remove('d-none');
        tabelaUsuarios.classList.add('d-none');

        const userId = this.getAttribute('data-id');
        document.getElementById('usuarioSelecionadoId').value = userId;

        fetch(`../database/getServicos.php?id=${userId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta da rede: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                let html = '';
                if (data.length > 0) {
                    html += `
                    <div class="alert alert-info">
                        Veja os Serviços pendentes a seguir!
                        <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                    </div>
                    <ul class="list-group">
                    `;
                    data.forEach(servico => {
                        html += `
                        <li class="list-group-item">
                            <strong>Tipo Serviço:</strong> ${servico.tipo_servico}<br>
                            <strong>Data de Início:</strong> ${servico.data_inicio}<br>
                            <strong>Data de Término:</strong> ${servico.data_termino}<br>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="remarcarConsulta(${servico.userId})">
                                    <i class="fas fa-edit me-1"></i> Remarcar
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="cancelarConsulta(${servico.userId})">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </button>
                            </div>
                        </li>
                        `;
                    });
                    html += `</ul>`;
                } else {
                    html = `
                    <div class="alert alert-warning" id="avisoConsulta">
                        Nenhum Serviço Agendado Encontrado!
                    </div>
                    <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                    `;
                }

                servicosUsuarioContainer.innerHTML = html;
                servicosUsuarioContainer.classList.remove('d-none');

                document.getElementById('voltar').addEventListener('click', () => {
                    servicosUsuarioContainer.classList.add('d-none');
                    tabelaUsuarios.classList.remove('d-none');
                    btnAgendarServico.classList.add('d-none');
                    searchInput.value = ''; // Limpa a pesquisa ao voltar
                    filtrarUsuarios(''); // Mostra todos os usuários novamente
                });
            })
            .catch(error => {
                console.error('Erro ao buscar serviços:', error);
                servicosUsuarioContainer.innerHTML = `
                <div class="alert alert-danger">
                    Ocorreu um erro ao carregar os serviços.
                    <i class="fas fa-arrow-left float-end" style="font-size:8pt; margin-top:8px;cursor:pointer;" id="voltar">Voltar</i>
                </div>
                `;
                servicosUsuarioContainer.classList.remove('d-none');

                document.getElementById('voltar').addEventListener('click', () => {
                    servicosUsuarioContainer.classList.add('d-none');
                    tabelaUsuarios.classList.remove('d-none');
                    btnAgendarServico.classList.add('d-none');
                });
            });
    }

    function agendarServico() {
        const modal = new bootstrap.Modal(document.getElementById('modalAgendarServico'));
        modal.show();
    }