export var validaTexto = function(elemento, blur=true) {
    let elem = document.getElementById(elemento);
    if (elem.value == null || elem.value.length == 0 || /^\s+$/.test(elem.value)) {
        if (blur) {
            elem.style.borderColor = "red";
            elem.style.borderWidth = "2px";
        }
        return false;
    } else {
        if (blur) {
            elem.style.borderColor = "#e28743";
            elem.style.borderWidth = "2px";
        }
        return true;
    }
}

export var valida_DNI = function(elemento, blur=true) {
    let elem = document.getElementById(elemento, blur);
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    if (!(/^\d{8}[A-Z]$/.test(elem.value))) {
        if (blur) {
            elem.style.borderColor = "red";
            elem.style.borderWidth = "2px";
        }
        return false;
    } else if (elem.value.charAt(8) != letras[(elem.value.substring(0, 8)) % 23]) {
        if (blur) {
            elem.style.borderColor = "red";
            elem.style.borderWidth = "2px";
        }
        return false;
    } else {
        if (blur) {
            elem.style.borderColor = "#e28743";
            elem.style.borderWidth = "2px";
        }
        return true;
    }
}

export var valida_telefono = function(elemento, blur=true) {
    let elem = document.getElementById(elemento);
    if (elem.value.length != 9) {
        if (blur) {
            elem.style.borderColor = "red";
            elem.style.borderWidth = "2px";
        }
        return false;
    } else {
        if (blur) {
            elem.style.borderColor = "#e28743";
            elem.style.borderWidth = "2px";
        }
        return true;
    }
}


export var valida_correo = function (elemento, blur=true) {
    let elem = document.getElementById(elemento);
    if (!(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(elem.value))) {
        if (blur) {
            elem.style.borderColor = "red";
            elem.style.borderWidth = "2px";
        }
        return false;
    } else {
        if (blur) {
            elem.style.borderColor = "#e28743";
            elem.style.borderWidth = "2px";
        }
        return true;
    }
}


function validarFormularioAlu() {
    let validado = true;
    if (!validaTexto('dni', false)) {
        validado = false
    }
    if (!valida_DNI('dni', false)) {
        validado = false;
    }
    if (!validaTexto('nombre', false)) {
        validado = false;
    }
    if (!validaTexto('apellidos', false)) {
        validado = false;
    }
    if (!validaTexto('telefono', false)) {
        validado = false;
    }
    if (!valida_telefono('telefono', false)) {
        validado = false;
    }
    if (!validaTexto('email', false)) {
        validado = false;
    }
    if (!valida_correo('email', false)) {
        validado = false;
    }
    if (!validaTexto('select-clases', false)) {
        validado = false;
    }
    document.getElementsByClassName('swal2-confirm')[0].disabled = !validado;
}


export function validarFormularioInputAlu() {
    // VALIDAR DNI
    document.getElementById("dni").addEventListener('input', () => {validaTexto('dni'); validarFormularioAlu()})
    document.getElementById("dni").addEventListener('input', () => {valida_DNI('dni');  validarFormularioAlu()})
    // VALIDAR NOMBRE
    document.getElementById("nombre").addEventListener('input', () => {validaTexto('nombre'), validarFormularioAlu()})
    // VALIDAR APELLIDOS
    document.getElementById("apellidos").addEventListener('input', () => {validaTexto('apellidos'), validarFormularioAlu()})
    // VALIDAR TELÉFONO
    document.getElementById("telefono").addEventListener('input', () => {validaTexto('telefono'), validarFormularioAlu()})
    document.getElementById("telefono").addEventListener('input', () => {valida_telefono('telefono'), validarFormularioAlu()})
    // VALIDAR EMAIL
    document.getElementById("email").addEventListener('input', () => {validaTexto('email'), validarFormularioAlu()})
    document.getElementById("email").addEventListener('input', () => {valida_correo('email'), validarFormularioAlu()})
    // VALIDA CLASE
    document.getElementById("select-clases").addEventListener('input', () => {validaTexto('select-clases'), validarFormularioAlu()})
}


function validarFormularioProf(password) {
    let validado = true;
    if (!validaTexto('nombre', false)) {
        validado = false;
    }
    if (!validaTexto('apellidos', false)) {
        validado = false;
    }
    if (!validaTexto('telefono', false)) {
        validado = false;
    }
    if (!valida_telefono('telefono', false)) {
        validado = false;
    }
    if (!validaTexto('email', false)) {
        validado = false;
    }
    if (!valida_correo('email', false)) {
        validado = false;
    }
    if (password) {
        if (!validaTexto('password', false)) {
            validado = false;
        }
    }
    if (!validaTexto('select-dept', false)) {
        validado = false;
    }
    document.getElementsByClassName('swal2-confirm')[0].disabled = !validado;
}


export function validarFormularioInputProf(password=false) {
    // VALIDAR NOMBRE
    document.getElementById("nombre").addEventListener('input', () => {validaTexto('nombre'), validarFormularioProf()})
    // VALIDAR APELLIDOS
    document.getElementById("apellidos").addEventListener('input', () => {validaTexto('apellidos'), validarFormularioProf()})
    // VALIDAR TELÉFONO
    document.getElementById("telefono").addEventListener('input', () => {validaTexto('telefono'), validarFormularioProf()})
    document.getElementById("telefono").addEventListener('input', () => {valida_telefono('telefono'), validarFormularioProf()})
    // VALIDAR EMAIL
    document.getElementById("email").addEventListener('input', () => {validaTexto('email'), validarFormularioProf()})
    document.getElementById("email").addEventListener('input', () => {valida_correo('email'), validarFormularioProf()})
    // VALIDAR CONTRASEÑA
    if (password) {
        document.getElementById("password").addEventListener('input', () => {validaTexto('password'), validarFormularioProf(true)})
    }
    // VALIDA CLASE
    document.getElementById("select-dept").addEventListener('input', () => {validaTexto('select-dept'), validarFormularioProf()})
}


function validarFormularioMail(multiple=true) {
    let validado = true;
    if (!validaTexto('asunto', false)) {
        validado = false;
    }
    if (!validaTexto('mensaje', false)) {
        validado = false;
    }
    if (multiple) {
        if (!validaTexto('select-clases', false)) {
            validado = false;
        }
    } else {
        if (!validaTexto('email', false)) {
            validado = false;
        }
        if (!valida_correo('email', false)) {
            validado = false;
        }
    }
    document.getElementsByClassName('swal2-confirm')[0].disabled = !validado;
}


export function validarFormularioInputMail(multiple=true) {
    // VALIDA ASUNTO
    document.getElementById("asunto").addEventListener('input', () => {validaTexto('asunto'), validarFormularioMail(multiple)})
    // VALIDA MENSAJE
    document.getElementById("mensaje").addEventListener('input', () => {validaTexto('mensaje'), validarFormularioMail(multiple)})
    if (multiple) {
        // VALIDA CLASE
        document.getElementById("select-clases").addEventListener('input', () => {validaTexto('select-clases'), validarFormularioMail(multiple)})
    } else {
        // VALIDA MAIL
        document.getElementById("email").addEventListener('input', () => {validaTexto('email'), validarFormularioMail(multiple)})
        document.getElementById("email").addEventListener('input', () => {valida_correo('email'), validarFormularioMail(multiple)})
    }
}

