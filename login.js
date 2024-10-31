// Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

// Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

let isKeyboardVisible = false; // Controlador del estado del teclado

// FUNCIONES
function anchoPage() {
    // setTimeout(() => {
        if (!isKeyboardVisible) { // Solo ejecuta si el teclado no está visible
            if (window.innerWidth > 850) {
                caja_trasera_register.style.display = "block";
                caja_trasera_login.style.display = "block";
            } else {
                caja_trasera_register.style.display = "block";
                caja_trasera_register.style.opacity = "1";
                caja_trasera_login.style.display = "none";
                formulario_login.style.display = "none";
                formulario_login.style.display = "block";
                contenedor_login_register.style.left = "0px";
                formulario_register.style.display = "none";   
            }
        }
    // }, 1); // Ajusta el tiempo según sea necesario
}

anchoPage();

function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

// Detectar si el teclado está visible
window.addEventListener("resize", () => {
    if (window.innerHeight < window.innerWidth) {
        isKeyboardVisible = false; // Teclado no visible
    } else {
        isKeyboardVisible = true; // Teclado visible
    }
});
