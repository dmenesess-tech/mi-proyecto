const selectorIdioma = document.querySelector(".idioma");

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
    hello: {
        en: "Hello",
        es: "Hola"
    },
    profile: {
        en: "Profile",
        es: "Perfil"
    },
    users: {
        en: "Users",
        es: "Usuarios"
    },
    tasks: {
        en: "Tasks",
        es: "Tareas"
    },
    log_out: {
        en: "Log out",
        es: "Cerrar sesión"
    },
    name: {
        en: "Name",
        es: "Nombre"
    },
    email: {
        en: "Email",
        es: "Correo electrónico"
    },
    edit: {
        en: "Edit",
        es: "Editar"
    }
};

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
    cambiarIdioma(localStorage.getItem("idioma") || "en");

    selectorIdioma.addEventListener("change", (evento) => {
        cambiarIdioma(evento.target.value);
    });
}