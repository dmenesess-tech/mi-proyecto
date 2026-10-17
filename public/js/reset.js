const traducciones = {
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
  title: {
    en: "Create New Password",
    es: "Crea Una Nueva Contraseña"
  },
  new_password:{
    en: "New password",
    es: "Nueva Contraseña"
  },
  confirm_password: {
    en: "Confirm password",
    es: "Confirmar Contraseña"
  },
  change: {
    en: "Change password",
    es: "Cambiar Contraseña"
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