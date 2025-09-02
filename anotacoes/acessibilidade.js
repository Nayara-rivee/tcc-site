document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  let fontSize = 100; // tamanho inicial em %

  document.getElementById("aumentar-fonte").addEventListener("click", () => {
    fontSize += 10;
    body.style.fontSize = fontSize + "%";
  });

  document.getElementById("diminuir-fonte").addEventListener("click", () => {
    if (fontSize > 50) {
      fontSize -= 10;
      body.style.fontSize = fontSize + "%";
    }
  });

  document.getElementById("resetar-fonte").addEventListener("click", () => {
    fontSize = 100;
    body.style.fontSize = "100%";
  });

  document.getElementById("contraste").addEventListener("click", () => {
    body.classList.toggle("high-contrast");
  });

  document.getElementById("espacamento").addEventListener("click", () => {
    body.classList.toggle("spaced-text");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  let fontSize = 100; // tamanho inicial em %

  // Toggle abrir/fechar barra
  const toggleBtn = document.getElementById("acessibilidade-toggle");
  const bar = document.getElementById("acessibilidade-bar");

  toggleBtn.addEventListener("click", () => {
    bar.style.display = bar.style.display === "flex" ? "none" : "flex";
  });

  // Controles de acessibilidade
  document.getElementById("aumentar-fonte").addEventListener("click", () => {
    fontSize += 10;
    body.style.fontSize = fontSize + "%";
  });

  document.getElementById("diminuir-fonte").addEventListener("click", () => {
    if (fontSize > 50) {
      fontSize -= 10;
      body.style.fontSize = fontSize + "%";
    }
  });

  document.getElementById("resetar-fonte").addEventListener("click", () => {
    fontSize = 100;
    body.style.fontSize = "100%";
  });

  document.getElementById("contraste").addEventListener("click", () => {
    body.classList.toggle("high-contrast");
  });

  document.getElementById("espacamento").addEventListener("click", () => {
    body.classList.toggle("spaced-text");
  });
});
