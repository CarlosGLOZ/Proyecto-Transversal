import { checkCheckedCheckboxes, updatePageButtons } from "./utils.js";


export function asyncShow() {
    document.getElementById('table').innerHTML = '<div class="loader"></div>';
    let url = '../proc/mostrar_alu.php?';
    let filter = localStorage.getItem('filter');
    let page = localStorage.getItem('page');
    let orderby = localStorage.getItem('orderby');
    let limit = localStorage.getItem('limit');
    if (filter) {
        filter = JSON.parse(filter)
        if (filter.nombre || filter.dni || filter.apellidos || filter.telefono || filter.email || filter.clase) {
            url += `nombre=${filter.nombre}&dni=${filter.dni}&apellidos=${filter.apellidos}&telefono=${filter.telefono}&email=${filter.email}&clase=${filter.clase}&`
        }
    }
    if (page) {
        filter = JSON.parse(page)
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
    $.ajax({
        type: 'GET',
        url: `../proc/eliminar_alu.php?id=${id}`,
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncModify(id, values) {
    $.ajax({
        type: 'POST',
        url: `../proc/modificar_alu.php`,
        data: { id: id, nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase },
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncCreate(values) {
    console.log(values)
    $.ajax({
        type: 'POST',
        url: `../proc/insertar_alu.php`,
        data: { nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase },
        success: function(response) {
            asyncShow()
        }
    })
}


export function asyncMultipleModify(values) {
    console.log('pepe')
    let checkedCheckboxes = document.querySelectorAll('input[name=alumno]:checked');
    if (checkedCheckboxes.length > 0) {
        let alumnos = []
        checkedCheckboxes.forEach(checkbox => {
            alumnos.push(checkbox.value)
        });
        $.ajax({
            type: 'POST',
            url: `../proc/mutiple_modificar_alu.php`,
            data: { alumnos: alumnos, nombre: values.nombre, dni: values.dni, email: values.email, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase },
            success: function(response) {
                asyncShow()
            }
        })
    }
}


export function asyncMultipleDelete() {
    let checkedCheckboxes = document.querySelectorAll('input[name=alumno]:checked');
    if (checkedCheckboxes.length > 0) {
        let alumnos = []
        checkedCheckboxes.forEach(checkbox => {
            alumnos.push(checkbox.value)
        });
        $.ajax({
            type: 'POST',
            url: `../proc/mulitple_eliminar_alu.php`,
            data: { alumnos: alumnos },
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