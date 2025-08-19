// document.querySelector('.ball').addEventListener('click', (e) => {
//     e.target.classList.toggle('ball-move')
//     document.body.classList.toggle('dark')
//   })

//     document.querySelector('#mode').addEventListener('click', (e) => {
//       e.target.classList.toggle('ball-move')
//       document.querySelector("footer").classList.toggle('modo-footer')
//     })

//     document.querySelector('#mode').addEventListener('click', (e) => {
//       e.target.classList.toggle('ball-move')
//       document.querySelector(".bg-degrade").classList.toggle('modo-bg-degrade')
//     })

//     document.querySelector('#mode').addEventListener('click', (e) => {
//       e.target.classList.toggle('ball-move')
//       document.querySelector(".incentivo").classList.toggle('modo')
//     })


document.addEventListener('DOMContentLoaded', () => {
  console.log("JS carregado");

  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');
  const introducao = document.querySelector('.introducao');

  if (!themeToggle || !themeIcon) {
    console.log("Elementos não encontrados!");
    return;
  }

  console.log("Botão e ícone encontrados");

  const setDark = () => {
    document.body.classList.remove('light-mode');
    document.body.classList.add('dark-mode');
    if (introducao) {
      introducao.classList.remove('light-mode');
      introducao.classList.add('dark-mode');
    }
    themeIcon.classList.remove('bx-moon');
    themeIcon.classList.add('bx-sun');
    localStorage.setItem('theme', 'dark');
    console.log("Tema escuro aplicado");
  };

  const setLight = () => {
    document.body.classList.remove('dark-mode');
    document.body.classList.add('light-mode');
    if (introducao) {
      introducao.classList.remove('dark-mode');
      introducao.classList.add('light-mode');
    }
    themeIcon.classList.remove('bx-sun');
    themeIcon.classList.add('bx-moon');
    localStorage.setItem('theme', 'light');
    console.log("Tema claro aplicado");
  };

  // Tema inicial
  if (localStorage.getItem('theme') === 'dark') {
    setDark();
  } else {
    setLight();
  }

  // Clique no botão
  themeToggle.addEventListener('click', () => {
    if (document.body.classList.contains('light-mode')) {
      setDark();
    } else {
      setLight();
    }
  });
});


