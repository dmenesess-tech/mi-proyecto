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
  sign_up: {
    en: "Sign up",
    es: "Registrarse"
  },
  log_in: {
    en: "Log in",
    es: "Iniciar sesión"
  },
  main_title: {
    en: "Welcome to Our Page",
    es: "Bienvenidos a nuestra página"
  },
  main_description: {
    en: "Here, the teacher and students can check assignments, activities, and important course dates. The goal is to keep everything organized and make communication easier.",
    es: "Aquí, la maestra y los alumnos podrán consultar las tareas, actividades y fechas importantes del curso. El objetivo es mantener todo organizado y facilitar la comunicación."
  },
  main_message: {
    en: "If you already have an account, log in. If you don't, sign up. You can change the language using the selector if needed.",
    es: "Si ya tienes una cuenta, inicia sesión. Si todavía no tienes una, regístrate. Puedes cambiar el idioma con el selector si lo necesitas."
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