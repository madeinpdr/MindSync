const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggleButton = body.querySelector(".toggle"),
  searchButton = body.querySelector(".search-box"),
  modeSwitchButton = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

// Alterna a visibilidade da sidebar
toggleButton.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

// Remove a classe 'close' da sidebar ao clicar na caixa de pesquisa
searchButton.addEventListener("click", () => {
  sidebar.classList.remove("close");
});

// Alterna entre o modo claro e escuro
modeSwitchButton.addEventListener("click", () => {
  body.classList.toggle("dark");

  // Atualiza o texto dependendo do modo
  modeText.innerText = body.classList.contains("dark") ? "Modo Claro" : "Modo Escuro";
});

