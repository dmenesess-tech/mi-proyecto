const traducciones = {
  home: {
    en: "Home",
    es: "Inicio"
  },
  select_language: {
    en: "Select Language",
    es: "Seleccionar idioma"
  },
  english: {
    en: "English",
    es: "Inglés"
  },
  spanish: {
    en: "Spanish",
    es: "Español"
  },
  log_out: {
    en: "Log out",
    es: "cerrar sesion"
  },
  welcome: {
    en: "Welcome",
    es: "Bienvenido"
  },
  text: {
    en: "Login succesful! Welcome to your home page. Here you can view and manage your tasks, profile, user account, and other features.",
    es: "inicio de sesion correcto! Bienvenido a tu pagina de inicio. Aqui puedes gestionar tus tareas, perfil, cuenta de usuario y otras funciones."
  }
};
const selectorIdioma = document.querySelector(".idioma");

function cambiarIdioma(idioma) {
  document.documentElement.lang = idioma;

  document.querySelectorAll("[data-i18n]").forEach((elemento) => {
    const clave = elemento.getAttribute("data-i18n");
    const traduccion = traducciones[clave];

    if (traduccion && traduccion[idioma]) {
      elemento.textContent = traduccion[idioma];
    }
  });

  if (selectorIdioma) {
    selectorIdioma.value = idioma;
  }

  localStorage.setItem("idioma", idioma);
}

if (selectorIdioma) {
  const idiomaGuardado = localStorage.getItem("idioma") || "en";

  cambiarIdioma(idiomaGuardado);

  selectorIdioma.addEventListener("change", (evento) => {
    cambiarIdioma(evento.target.value);
  });
}