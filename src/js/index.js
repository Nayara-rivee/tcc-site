// Script para pausar vídeos ao fechar modais
        const modal1 = document.getElementById('modalProjeto1');
        const video1 = document.getElementById('videoProjeto1');
        modal1.addEventListener('hidden.bs.modal', () => {
            video1.pause();
            video1.currentTime = 0;
        });

        const modal2 = document.getElementById('modalProjeto2');
        const video2 = document.getElementById('videoProjeto2');
        modal2.addEventListener('hidden.bs.modal', () => {
            video2.pause();
            video2.currentTime = 0;
        });
