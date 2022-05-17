export var validaTexto = function(evento) {
    //console.log(evento.target.name);
    var valor = evento.target.value;
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        // document.getElementById(evento.target.id + "_msg").innerHTML = evento.target.name + " no es correcto";
        evento.target.style.borderColor = "red";
        evento.target.style.borderWidth = "2px";
        evento.target.focus();
        return false;
    } else {
        // document.getElementById(evento.target.id + "_msg").innerHTML = "";
        evento.target.style.borderColor = "green";
        evento.target.style.borderWidth = "2px";
        return true;
    }
}

export var valida_DNI = function(evento) {
    //console.log(evento.target.name);
    var valor = evento.target.value;
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    if (!(/^\d{8}[A-Z]$/.test(valor))) {
        // document.getElementById(evento.target.id + "_msg").innerHTML = evento.target.name + " no es correcto";
        evento.target.style.borderColor = "red";
        evento.target.style.borderWidth = "2px";
        evento.target.focus();
        return false;
    } else if (valor.charAt(8) != letras[(valor.substring(0, 8)) % 23]) {
        evento.target.style.borderColor = "red";
        evento.target.style.borderWidth = "2px";
        evento.target.focus();
        return false;
    } else {
        // document.getElementById(evento.target.id + "_msg").innerHTML = "";
        evento.target.style.borderColor = "green";
        evento.target.style.borderWidth = "2px";
        return true;
    }
}

export var valida_telefono = function(evento) {
    //console.log(evento.target.name);
    var valor = evento.target.value;
    if (valor.length != 5) {
        // document.getElementById(evento.target.id + "_msg").innerHTML = evento.target.name + " no es correcto";
        evento.target.style.borderColor = "red";
        evento.target.style.borderWidth = "2px";
        evento.target.focus();
        return false;
    } else {
        // document.getElementById(evento.target.id + "_msg").innerHTML = "";
        evento.target.style.borderColor = "green";
        evento.target.style.borderWidth = "2px";
        return true;
    }
}