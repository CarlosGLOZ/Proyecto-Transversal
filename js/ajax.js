import { checkCheckedCheckboxes, updatePageButtons, changeFilterInputs } from "./utils.js";


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
            changeFilterInputs()
        }
    })
}


export function asyncDelete(id) {
    let url = '../proc/';
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        url += `eliminar_alu.php?id=${id}`;
    } else {
        url += `eliminar_prof.php?id=${id}`;
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
    let url = '../proc/';
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        data = { id: id, nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase };
        url += 'modificar_alu.php';
    } else {
        data = { id: id, nombre: values.nombre, apellidos: values.apellidos, telefono: values.telefono, email: values.email, dept: values.dept };
        url += 'modificar_prof.php';
    }
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncCreate(values) {
    let url = '../proc/';
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        data = { nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase };
        url += 'insertar_alu.php';
    } else {
        data = { nombre: values.nombre, apellidos: values.apellidos, email: values.email, telefono: values.telefono, dept: values.dept };
        url += 'insertar_prof.php';
    }
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncMultipleModify(values) {
    let url = '../proc/';
    let query;
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        query = 'alumno'
        url += 'mulitple_modificar_alu.php';
        data = { nombre: values.nombre, dni: values.dni, email: values.email, apellidos: values.apellidos, telefono: values.telefono, clase: values.clase }
    } else {
        query = 'profesor'
        url += 'mutiple_modificar_prof.php';
        data = { nombre: values.nombre, email: values.email, apellidos: values.apellidos, telefono: values.telefono, dept: values.dept }
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
            url: url,
            data: data,
            success: function(response) {
                asyncShow()
            }
        })
    }
}


export function asyncMultipleDelete() {
    let url = '../proc/';
    let query;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        query = 'alumno'
        url += 'mulitple_eliminar_alu.php';
    } else {
        query = 'profesor'
        url += 'mulitple_eliminar_prof.php';
    }
    let checks = [];
    let checkedBoxes = document.querySelectorAll(`input[name=${query}]:checked`)
    checkedBoxes.forEach(checkbox => {
        checks.push(checkbox.value)
    });
    if (checks.length > 0) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {ids: checks},
            success: function() {
                asyncShow()
            }
        })
    }
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