const iconoMenu = document.querySelector('#icono-menu')

menu = document.querySelector('#menu');

iconoMenu.addEventListener('click', (e) => {

    // Alternamos estilos para el menu y body
    menu.classList.toggle('active');
    document.body.classList.toggle('opacity');

    // Alternamos su atributo 'src' para el ícono del menú
    const rutaActual = e.target.getAttribute('src');

    if (rutaActual == '../img/open-menu.png') {
        e.target.setAttribute('src', '../img/open-menu2.png');
    } else {
        e.target.setAttribute('src', '../img/open-menu.png');
    }

    var width_div = document.getElementById('width_div');
    var width_menu = document.getElementById('width_menu');

    if (menu.classList.contains('active')) {
        width_div.style.width = "87%";
        width_menu.style.width = "10%";

    } else {
        width_div.style.width = "72%";
        width_menu.style.width = "27%";
    }
});