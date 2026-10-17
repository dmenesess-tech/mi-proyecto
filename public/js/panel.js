const selectorIdioma = document.querySelector(".idioma");

const traducciones = {
    home: { en: "Home", es: "Inicio" },
    select_language: { en: "Select Language", es: "Seleccionar idioma" },
    english: { en: "English", es: "Inglés" },
    spanish: { en: "Spanish", es: "Español" },
    hello: { en: "Hello", es: "Hola" },
    profile: { en: "Profile", es: "Perfil" },
    users: { en: "Users", es: "Usuarios" },
    tasks: { en: "Tasks", es: "Tareas" },
    log_out: { en: "Log out", es: "Cerrar sesión" },
    welcome: { en: "Welcome", es: "Bienvenido" },
    welcome_text: {
        en: "Login successful! Welcome to your home page. Here you can view and manage your tasks and profile.",
        es: "¡Inicio de sesión correcto! Bienvenido a tu página principal. Aquí puedes ver y administrar tus tareas y perfil."
    },
    name: { en: "Name", es: "Nombre" },
    email: { en: "Email", es: "Correo electrónico" },
    edit: { en: "Edit", es: "Editar" },
    edit_profile: { en: "Edit profile", es: "Editar perfil" },
    change_password: { en: "Change password", es: "Cambiar contraseña" },
    change_profile_image: { en: "Change profile image", es: "Cambiar foto de perfil" },
    delete_profile_image: { en: "Delete profile image", es: "Eliminar foto de perfil" },
    verify_password: { en: "Please enter your password to continue", es: "Ingresa tu contraseña para continuar" },
    password: { en: "Password", es: "Contraseña" },
    new_password: { en: "New password", es: "Nueva contraseña" },
    new_password_optional: { en: "New password (optional)", es: "Nueva contraseña (opcional)" },
    repeat_password: { en: "Repeat new password", es: "Repite la nueva contraseña" },
    send: { en: "Send", es: "Enviar" },
    save: { en: "Save", es: "Guardar" },
    cancel: { en: "Cancel", es: "Cancelar" },
    choose_image: { en: "Choose image", es: "Selecciona una imagen" },
    image_limit: { en: "PNG, JPG, or WEBP. Maximum size: 2 MB.", es: "PNG, JPG o WEBP. Tamaño máximo: 2 MB." },
    confirm_delete_image: { en: "Are you sure you want to delete your profile image?", es: "¿Seguro que quieres eliminar tu foto de perfil?" },
    confirm: { en: "Confirm", es: "Confirmar" },
    new_user: { en: "New user", es: "Nuevo usuario" },
    edit_user: { en: "Edit user", es: "Editar usuario" },
    user: { en: "User", es: "Usuario" },
    active: { en: "Active", es: "Activo" },
    administrator: { en: "Administrator", es: "Administrador" },
    created_at: { en: "Created at", es: "Creado el" },
    updated_at: { en: "Updated at", es: "Actualizado el" },
    actions: { en: "Actions", es: "Acciones" },
    view: { en: "View", es: "Ver" },
    search: { en: "Search", es: "Buscar" },
    newest: { en: "Newest", es: "Más nuevos" },
    oldest: { en: "Oldest", es: "Más antiguos" },
    back: { en: "Back", es: "Regresar" },
    delete: { en: "Delete", es: "Eliminar" },
    new_task: { en: "New task", es: "Nueva tarea" },
    edit_task: { en: "Edit task", es: "Editar tarea" },
    task: { en: "Task", es: "Tarea" },
    description: { en: "Description", es: "Descripción" },
    confirm_delete_user: { en: "Delete this user?", es: "¿Eliminar este usuario?" },
    confirm_delete_task: { en: "Delete this task?", es: "¿Eliminar esta tarea?" },
    id: { en: "ID", es: "ID" },
    yes: {en: "Yes", es:"Si"},
    no: {en: "No", es:"No"}
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

const idiomaGuardado = localStorage.getItem("idioma") || "en";
cambiarIdioma(idiomaGuardado);

if (selectorIdioma) {
    selectorIdioma.addEventListener("change", (evento) => {
        cambiarIdioma(evento.target.value);
    });
}

document.querySelectorAll("form[data-confirm]").forEach((formulario) => {
    formulario.addEventListener("submit", (evento) => {
        const clave = formulario.getAttribute("data-confirm");
        const idioma = localStorage.getItem("idioma") || "en";
        const texto = traducciones[clave]?.[idioma] || "Are you sure?";

        if (!confirm(texto)) {
            evento.preventDefault();
        }
    });
});