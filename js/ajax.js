import { changeUsername, checkCheckedCheckboxes, updatePageButtons } from "./utils.js";
import { alertCreateAlu, alertCreateProf, alertFailed, alertModify, alertModifyProf, alertMultipleModifyAlu } from "./alerts.js";


export function asyncShow() {
    document.getElementById('table').innerHTML = '<div class="loader"></div>';
    let url = '../proc/';
    let scope = localStorage.getItem('data_scope');
    let filter = localStorage.getItem('filter');
    if (!scope || scope == 'alumnos') {
        url += 'mostrar_alu.php?';
        if (filter) {
            filter = JSON.parse(filter)
            if (filter.nombre || filter.dni || filter.apellidos || filter.telefono || filter.email || filter.clase) {
                url += `nombre=${filter.nombre}&dni=${filter.dni}&apellidos=${filter.apellidos}&telefono=${filter.telefono}&email=${filter.email}&clase=${filter.clase}&`
            }
        }
    } else {
        url += 'mostrar_prof.php?';
        if (filter) {
            filter = JSON.parse(filter)
            if (filter.nombre || filter.apellidos || filter.telefono || filter.email || filter.dept) {
                url += `nombre=${filter.nombre}&apellidos=${filter.apellidos}&telefono=${filter.telefono}&email=${filter.email}&dept=${filter.dept}&`
            }
        }
    }
    let page = localStorage.getItem('page');
    let orderby = localStorage.getItem('orderby');
    let limit = localStorage.getItem('limit');
    if (page) {
        page = JSON.parse(page)
        url += `page=${page}&`
    }
    if (orderby) {
        url += `orderby=${orderby}&`
    }
    if (limit) {
        url += `limit=${limit}&`
    }
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            let element = document.getElementById('table');
            element.innerHTML = response;
            checkCheckedCheckboxes()
            updatePageButtons();
        }
    })
}


export function asyncDelete(id) {
    let url = '../proc/';
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        url += `eliminar_reg.php?id=${id}&scope=alumnos`;
    } else {
        url += `eliminar_reg.php?id=${id}&scope=profesores`;
    }
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncModify(id, values) {
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        data = { id: id, scope: scope,  nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase };
    } else {
        data = { id: id, scope: scope, nombre: values.nombre, apellidos: values.apellidos, telefono: values.telefono, email: values.email, dept: values.dept };
    }
    $.ajax({
        type: 'POST',
        url: '../proc/modificar_reg.php',
        data: data,
        success: function(response) {
            let error;
            if (response == 'Correo ya existe') {
                error = 'Correo ya existe';
            } else if (response == 'DNI ya existe') {
                error = 'DNI ya existe';
            } 
            if (error) {
                let scope = localStorage.getItem('data_scope')
                if (!scope || scope == 'alumnos') {
                    alertFailed(error, alertModify, data)
                } else {
                    alertFailed(error, alertModifyProf, data)
                }
            } else {
                asyncShow()
                changeUsername()
            }
        }
    })
}


export function asyncCreate(values) {
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        data = { scope: scope, nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase };
    } else {
        data = { scope: scope, nombre: values.nombre, apellidos: values.apellidos, email: values.email, telefono: values.telefono, password: values.password, dept: values.dept };
    }
    $.ajax({
        type: 'POST',
        url: '../proc/insertar_reg.php',
        data: data,
        success: function(response) {
            let error;
            if (response == 'Correo ya existe') {
                error = 'Correo ya existe';
            } else if (response == 'DNI ya existe') {
                error = 'DNI ya existe';
            } 
            if (error) {
                console.log('b')
                let scope = localStorage.getItem('data_scope')
                if (!scope || scope == 'alumnos') {
                    alertFailed(error, alertCreateAlu)
                } else {
                    alertFailed(error, alertCreateProf)
                }
            } else {
                asyncShow()
            }
        }
    })
}


export function asyncMultipleModify(values) {
    let query;
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        query = 'alumno'
        data = {scope: scope, clase: values.clase }
    } else {
        query = 'profesor'
        data = { scope: scope, dept: values.dept }
    }
    let checks = [];
    let checkedBoxes = document.querySelectorAll(`input[name=${query}]:checked`)
    checkedBoxes.forEach(checkbox => {
        checks.push(checkbox.value)
    });
    if (checks.length > 0) {
        data.ids = checks;
        $.ajax({
            type: 'POST',
            url: '../proc/mutiple_modificar_reg.php',
            data: data,
            success: function(response) {
                asyncShow()
            }
        })
    }
}


export function asyncMultipleDelete() {
    let query;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        query = 'alumno'
    } else {
        query = 'profesor'
    }
    let checks = [];
    let checkedBoxes = document.querySelectorAll(`input[name=${query}]:checked`)
    checkedBoxes.forEach(checkbox => {
        checks.push(checkbox.value)
    });
    if (checks.length > 0) {
        $.ajax({
            type: 'POST',
            url: '../proc/mulitple_eliminar_reg.php',
            data: {ids: checks, scope: scope},
            success: function() {
                asyncShow()
            }
        })
    }
}


export function asyncChangePassword(values) {
    $.ajax({
        type: 'POST',
        url: '../proc/cambiar_password.php',
        data: {id: values.id, password: values.password},
        success: function() {
            asyncShow()
        }
    })
}


export function asyncShowClases(elemento, clase = null) {
    let url = "../proc/mostrar_clases.php"
    if (clase) {
        url += `?id=${clase}`
    }
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            let element = document.getElementById(elemento);
            element.innerHTML = response;
        }
    })
}


export function asyncShowDepts(elemento, dept = null) {
    let url = "../proc/mostrar_depts.php"
    if (dept) {
        url += `?id=${dept}`
    }
    $.ajax({
        type: 'GET',
        url: url,
        success: function(response) {
            let element = document.getElementById(elemento);
            element.innerHTML = response;
        }
    })
}