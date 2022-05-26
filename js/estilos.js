window.onload = () => {
    changeInput()
    cambiarFondo()
    cambiarColorLetra()
    cambiarBotones()

    // CambiarFondo()
    var fondo_div = document.getElementById('fondo_div');
    var fondo_nav = document.getElementById('fondo_nav');

    var color_div = localStorage.getItem('color_div');
    var color_nav = localStorage.getItem('color_nav');

    fondo_div.style.background = color_div;
    fondo_nav.style.background = color_nav;

    // CambiarBotones()
    var btn_colores = document.getElementsByClassName('fondo_btn');

    var fondo_boton = localStorage.getItem('fondo_btn');
    var border_boton = localStorage.getItem('border_btn');

    for (let i = 0; i < btn_colores.length; i++) {
        const element = btn_colores[i];
        element.style.background = fondo_boton;
        element.style.border = border_boton;
    }

    // CambiarColorLetra()
    var letra = document.getElementsByClassName('color_letra');

    var color_letra = localStorage.getItem('color');

    for (let i = 0; i < letra.length; i++) {
        var element = letra[i]; // RECORRER TODOS LOS ELEMENTOS QUE TENGAN LA CLASE QUE ESPECIFICAMOS
        // PONER LOS COLORES A TODAS ESAS CLASES:
        element.style.color = color_letra;
    }

}

// FUNCIONES DE PERSONALIZACIÓN:

function cambiarFondo(value) {

    var fondo_div = document.getElementById('fondo_div');
    var fondo_nav = document.getElementById('fondo_nav');
    if (value == "claro") {
        fondo_div.style.background = "linear-gradient(180deg, rgb(245, 245, 245) 0%, rgb(175, 175, 175) 100%)";
        fondo_nav.style.background = "rgb(175, 175, 175)";
        localStorage.setItem('color_div', "linear-gradient(180deg, rgb(245, 245, 245) 0%, rgb(175, 175, 175) 100%)")
        localStorage.setItem('color_nav', "rgb(175, 175, 175)")
    }
    if (value == "oscuro") {
        fondo_div.style.background = "linear-gradient(180deg, rgb(60, 60, 60) 0%, rgb(15, 15, 15) 100%)";
        fondo_nav.style.background = "rgb(15, 15, 15)";
        localStorage.setItem('color_div', "linear-gradient(180deg, rgb(60, 60, 60) 0%, rgb(15, 15, 15) 100%)")
        localStorage.setItem('color_nav', "rgb(15, 15, 15)")
    }
    if (value == "predeterminado") {
        fondo_div.style.background = "linear-gradient(180deg, rgba(54, 97, 116, 1) 0%, rgba(4, 52, 68, 1) 100%)";
        fondo_nav.style.background = "rgb(33, 158, 188)";
        localStorage.setItem('color_div', "linear-gradient(180deg, rgba(54, 97, 116, 1) 0%, rgba(4, 52, 68, 1) 100%)")
        localStorage.setItem('color_nav', "rgb(33, 158, 188)")
    }
}

function cambiarBotones(value) {
    var fondo_btn = document.getElementsByClassName('fondo_btn');
    // console.log(fondo_btn);
    for (let i = 0; i < fondo_btn.length; i++) {
        const element = fondo_btn[i]; // RECORRER TODOS LOS ELEMENTOS QUE TENGAN LA CLASE QUE ESPECIFICAMOS
        // PONER LOS COLORES A TODAS ESAS CLASES:
        if (value == "rojo") {
            element.style.background = "rgb(241, 89, 89)";
            element.style.borderColor = "rgb(214, 39, 39)";
            localStorage.setItem('fondo_btn', "rgb(241, 89, 89)");
            localStorage.setItem('border_btn', "rgb(214, 39, 39)");
        }
        if (value == "verde") {
            element.style.background = "rgb(132, 238, 139)";
            element.style.borderColor = "rgb(74, 208, 83)";
            localStorage.setItem('fondo_btn', "rgb(132, 238, 139)");
            localStorage.setItem('border_btn', "rgb(74, 208, 83)");
        }
        if (value == "morado") {
            element.style.background = "rgb(212, 142, 248)";
            element.style.borderColor = "rgb(182, 91, 227)";
            localStorage.setItem('fondo_btn', "rgb(212, 142, 248)");
            localStorage.setItem('border_btn', "rgb(182, 91, 227)");
        }
        if (value == "amarillo") {
            element.style.background = "rgb(255, 183, 3)";
            element.style.borderColor = "rgb(251, 133, 0)";
            localStorage.setItem('fondo_btn', "rgb(255, 183, 3)");
            localStorage.setItem('border_btn', "rgb(251, 133, 0)");
        }
        if (value == "azul") {
            element.style.background = "rgb(125, 162, 205)";
            element.style.borderColor = "rgb(65, 118, 199)";
            localStorage.setItem('fondo_btn', "rgb(125, 162, 205)");
            localStorage.setItem('border_btn', "rgb(65, 118, 199)");
        }
    }
}

function cambiarColorLetra() {
    var color_letra = document.getElementById('color-picker').value
    var fondo_letra = document.getElementsByClassName('fondo_letra');

    localStorage.setItem('color', color_letra);

    for (let i = 0; i < fondo_letra.length; i++) {
        var element = fondo_letra[i]; // RECORRER TODOS LOS ELEMENTOS QUE TENGAN LA CLASE QUE ESPECIFICAMOS
        // PONER LOS COLORES A TODAS ESAS CLASES:
        element.style.color = color_letra;
    }
}

function changeInput() {
    var color = localStorage.getItem('color');
    document.getElementById('color-picker').value = color;
}