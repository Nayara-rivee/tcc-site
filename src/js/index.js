document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const contentWrapper = document.getElementById('content-wrapper');
    const panel = document.getElementById('accessibility-panel');
    const toggleBtn = document.getElementById('accessibility-toggle-btn');
    const closePanelBtn = document.getElementById('close-panel-btn');
    const restoreBtn = document.getElementById('restore-btn');
    const controls = document.querySelectorAll('.control-btn');

    // Mapeamento das classes que o painel controla
    const colorFilterModes = ['monochrome-mode', 'colorblind-protanopia', 'colorblind-deuteranopia', 'colorblind-tritanopia'];
    const toggleModes = ['highlight-links-mode', 'reading-mask-mode', 'highlight-words-mode', 'hide-images-mode', 'highlight-header-mode'];
    const animationModes = ['stop-animations-mode', 'stop-sounds-mode'];
    
    // Elementos de texto que receberão as alterações de fonte/espaçamento
    const textElements = document.querySelectorAll('p, h1, h2, h3, h4, span, a, li, .card-text'); 
    const zoomableElements = Array.from(textElements); // Cria Array para lupa

    // Estado do Painel
    let state = {
        fontSize: 1.0,
        lineHeight: 1.6,
        letterSpacing: 0,
        magnifierActive: false,
        readingModeActive: false,
        contrastActive: false,
    };
    const stepSize = 0.1;

    // ======================================================
    // 1. FUNÇÕES DE UTILIDADE
    // ======================================================

    function updateControlState(action, isActive) {
        const button = document.querySelector(`.control-btn[data-action="${action}"]`);
        if (button) {
            button.classList.toggle('active', isActive);
        }
    }

    function removeAllColorFilters() {
        if (contentWrapper) {
            colorFilterModes.forEach(cls => contentWrapper.classList.remove(cls));
        }
        controls.forEach(btn => {
            if (btn.getAttribute('data-action').startsWith('colorblind-') || btn.getAttribute('data-action') === 'toggle-monochrome') {
                 btn.classList.remove('active');
            }
        });
    }
    
    function applyTextStyles() {
        textElements.forEach(el => {
            el.style.setProperty('font-size', `${state.fontSize}rem`, 'important');
            el.style.setProperty('line-height', state.lineHeight, 'important');
            el.style.setProperty('letter-spacing', `${state.letterSpacing}px`, 'important');
        });
    }

    // ======================================================
    // 2. LÓGICA DO MODO DE LEITURA (Overlay)
    // ======================================================
    function toggleReadingMode() {
        if (!state.readingModeActive) {
            // Cria o overlay e o conteúdo
            const overlay = document.createElement('div');
            overlay.id = 'reading-mode-overlay';
            overlay.classList.add('reading-mode-overlay');
            
            const content = document.createElement('div');
            content.classList.add('reading-mode-content');
            
            // Move o conteúdo principal (do wrapper) para dentro do content box
            content.innerHTML = contentWrapper ? contentWrapper.innerHTML : '<p>Conteúdo principal não encontrado para Modo de Leitura.</p>';

            overlay.appendChild(content);
            body.appendChild(overlay);
            
            // Adiciona listener para sair
            overlay.addEventListener('click', (e) => {
                // Se clicar no fundo escuro, sai do modo
                if (e.target.id === 'reading-mode-overlay') {
                    toggleReadingMode();
                }
            });

            // Oculta o conteúdo original
            if (contentWrapper) contentWrapper.style.display = 'none';
            
            state.readingModeActive = true;
        } else {
            // Remove o overlay
            const overlay = document.getElementById('reading-mode-overlay');
            if (overlay) {
                body.removeChild(overlay);
            }
            // Restaura o conteúdo original
            if (contentWrapper) contentWrapper.style.display = '';

            state.readingModeActive = false;
        }
        updateControlState('toggle-reading-mode', state.readingModeActive);
    }
    
    // ======================================================
    // 3. LÓGICA DO MAGNIFIER (Lupa)
    // ======================================================
    
    function handleMagnifierMode(e) {
        if (!state.magnifierActive) return;
        
        const target = e.target;
        
        // 1. Resetar o estilo (limpar o zoom do elemento anterior)
        zoomableElements.forEach(el => {
            if (el.style.getPropertyValue('transform') === 'scale(1.5)') {
                el.style.removeProperty('transform');
                el.style.removeProperty('transform-origin');
            }
        });

        // 2. Aplica o zoom se o elemento for um texto zoomável
        if (zoomableElements.includes(target)) {
            target.style.setProperty('transform', 'scale(1.5)', 'important');
            target.style.setProperty('transform-origin', 'left center', 'important');
        }
    }

    function toggleMagnifier() {
        state.magnifierActive = !state.magnifierActive;
        
        if (state.magnifierActive) {
            document.addEventListener('mousemove', handleMagnifierMode);
            document.body.classList.add('magnifier-mode'); 
        } else {
            document.removeEventListener('mousemove', handleMagnifierMode);
            document.body.classList.remove('magnifier-mode');
            
            // Reseta todos os estilos de zoom
            zoomableElements.forEach(el => {
                el.style.removeProperty('transform');
                el.style.removeProperty('transform-origin');
            });
        }
        
        updateControlState('toggle-magnifier', state.magnifierActive);
    }


    // ======================================================
    // 4. LISTENERS DO PAINEL
    // (Este bloco foi apenas reordenado, mas a lógica é a mesma)
    // ======================================================
    
    toggleBtn.addEventListener('click', () => {
        const isHidden = panel.classList.toggle('hidden');
        toggleBtn.setAttribute('aria-expanded', !isHidden);
    });

    closePanelBtn.addEventListener('click', () => {
        panel.classList.add('hidden');
        toggleBtn.setAttribute('aria-expanded', false);
    });

    controls.forEach(button => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');
            const className = action.replace('toggle-', '').replace('colorblind-', 'colorblind-');
            
            // --- AÇÕES DE COR E FILTRO ---
            if (colorFilterModes.includes(className) || action === 'toggle-contrast') {
                
                // ... (lógica de Contraste e Filtro de Cor aqui, como estava) ...
                if (action === 'toggle-contrast') {
                    state.contrastActive = !state.contrastActive;
                    body.classList.toggle('high-contrast-mode', state.contrastActive);
                    updateControlState(action, state.contrastActive);
                } 
                else if (contentWrapper) {
                    const wasActive = contentWrapper.classList.contains(className);
                    removeAllColorFilters();
                    if (!wasActive) {
                        contentWrapper.classList.add(className);
                        updateControlState(action, true);
                    } else {
                        updateControlState(action, false);
                    }
                }
            }
            // --- AÇÕES DE NAVEGAÇÃO E OUTROS TOGGLES ---
            else if (toggleModes.includes(className) || animationModes.includes(className)) {
                body.classList.toggle(className);
                updateControlState(action, body.classList.contains(className));
                
                // Ações específicas por função (AGORA CHAMAM AS FUNÇÕES COMPLETAS)
                if (action === 'toggle-reading-mode') toggleReadingMode();
                if (action === 'toggle-magnifier') toggleMagnifier();
                
            } 
            // --- AÇÕES DE TEXTO (A+, A-, etc.) ---
            else {
                switch (action) {
                    case 'increase-font':
                        if (state.fontSize < 2.0) state.fontSize += stepSize;
                        break;
                    case 'decrease-font':
                        if (state.fontSize > 0.7) state.fontSize -= stepSize;
                        break;
                    case 'increase-line-height':
                        if (state.lineHeight < 3.0) state.lineHeight += stepSize;
                        break;
                    case 'decrease-line-height':
                        if (state.lineHeight > 1.0) state.lineHeight -= stepSize;
                        break;
                    case 'increase-letter-spacing':
                        if (state.letterSpacing < 5) state.letterSpacing += 1;
                        break;
                    case 'decrease-letter-spacing':
                        if (state.letterSpacing > 0) state.letterSpacing -= 1;
                        break;
                    default:
                        return;
                }
                applyTextStyles();
            }
        });
    });

    // --- RESTAURAR TUDO ---
    restoreBtn.addEventListener('click', () => {
        // 1. Cores e Toggles
        body.classList.remove('high-contrast-mode');
        state.contrastActive = false;
        removeAllColorFilters();
        toggleModes.forEach(cls => body.classList.remove(cls));
        animationModes.forEach(cls => body.classList.remove(cls));
        controls.forEach(btn => btn.classList.remove('active'));

        // 2. Restaura o modo de leitura e lupa se ativos
        if(state.readingModeActive) toggleReadingMode();
        if(state.magnifierActive) toggleMagnifier(); 

        // 3. Texto
        state = {
            fontSize: 1.0,
            lineHeight: 1.6,
            letterSpacing: 0,
            magnifierActive: false,
            readingModeActive: false,
            contrastActive: false,
        };
        
        textElements.forEach(el => {
            el.style.removeProperty('font-size'); 
            el.style.removeProperty('line-height');
            el.style.removeProperty('letter-spacing');
        });

        alert("Recursos de acessibilidade restaurados!");
        panel.classList.add('hidden');
        toggleBtn.setAttribute('aria-expanded', false);
    });

    applyTextStyles();
});