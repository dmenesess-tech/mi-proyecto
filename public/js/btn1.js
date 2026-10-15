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
  log_in: {
    en: "Log in",
    es: "Iniciar sesión"
  },
  name: {
    en: "Name",
    es: "Nombre"
  },
  email: {
    en: "Email",
    es: "Correo electrónico"
  },
  password: {
    en: "Password",
    es: "Contraseña"
  },
  sign_up: {
    en: "Sign up",
    es: "Registrarse"
  },
  password_description: {
    en: "It must be at least 8 characters long.",
    es: "Debe tener al menos 8 caracteres."
  },
  create_account: {
    en: "Create Account",
    es: "Crear cuenta"
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