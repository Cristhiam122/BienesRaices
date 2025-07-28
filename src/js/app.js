document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkMode();

});

// Mostrar y Ocultar Panel de navegación //
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');

}

// Dark Mode //

function darkMode() {
    const btnDarkMode = document.querySelector('.dark-mode-btn');

    const defaultDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(defaultDarkMode.matches)

    //Leer las preferencias del sistema (modo claro u obscuro)
    if(defaultDarkMode.matches){
        document.body.classList.add('dark-mode')
    }else {
        document.body.classList.remove('dark-mode')
    }

    // Cambiar automaticamente si la preferencia del sistema cambia
    defaultDarkMode.addEventListener('change',() => {
        if(defaultDarkMode.matches){
            document.body.classList.add('dark-mode')
        }else {
            document.body.classList.remove('dark-mode')
    }
    })

    // Agregar class para el Dark-Mode
    btnDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode')
    })
}