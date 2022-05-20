import { asyncShow, asyncShowClases, asyncShowDepts } from "./ajax.js";


export function checkCheckedCheckboxes() {
    let scope = localStorage.getItem('data_scope')
    let checkedCheckboxes;
    if (!scope || scope == 'alumnos') {
        checkedCheckboxes = document.querySelectorAll('input[name=alumno]:checked');
    } else {
        checkedCheckboxes = document.querySelectorAll('input[name=profesor]:checked');
    }
    if (checkedCheckboxes.length > 0) {
        document.getElementById('multiple-delete-button').disabled = false;
        document.getElementById('multiple-modify-button').disabled = false;
    } else {
        document.getElementById('multiple-delete-button').disabled = true;
        document.getElementById('multiple-modify-button').disabled = true;

    }
}


export function checkAllCheckboxes() {
    let scope = localStorage.getItem('data_scope')
    let ele;
    if (!scope || scope == 'alumnos') {
        ele = document.getElementsByName('alumno');
    } else {
        ele = document.getElementsByName('profesor');
    }
    let isChecked = document.getElementById('check-all').checked;

    for (var i = 0; i < ele.length; i++) {
        if (ele[i].type == 'checkbox') {
            if (isChecked) {
                ele[i].checked = true;
            } else {
                ele[i].checked = false;
            }
        }
    }
    checkCheckedCheckboxes()
}


export function storeLocalFilter() {
    let scope = localStorage.getItem('data_scope')
    let nombre = document.getElementById('filtro-nombre').value;
    let apellidos = document.getElementById('filtro-apellidos').value;
    let telefono = document.getElementById('filtro-telefono').value;
    let email = document.getElementById('filtro-email').value;
    let filter;
    if (!scope || scope == 'alumnos') {
        let dni = document.getElementById('filtro-dni').value;
        let clase = document.getElementById('filtro-select').value;
        filter = { dni: dni, nombre: nombre, apellidos: apellidos, telefono: telefono, email: email, clase: clase };
    } else {
        let dept = document.getElementById('filtro-select').value;
        filter = { nombre: nombre, apellidos: apellidos, telefono: telefono, email: email, dept: dept };
    }
    localStorage.setItem('filter', JSON.stringify(filter));
    localStorage.setItem('page', 1)
    asyncShow();
    updatePageButtons();
}


export function displayLocalFilter() {
    let filter = localStorage.getItem('filter');
    filter = JSON.parse(filter)
    if (filter.nombre || filter.dni || filter.apellidos || filter.telefono || filter.email || filter.clase) {
        if (filter.dni) {
            document.getElementById('filtro-dni').value = filter.dni;
        }
        document.getElementById('filtro-nombre').value = filter.nombre;
        document.getElementById('filtro-apellidos').value = filter.apellidos;
        document.getElementById('filtro-telefono').value = filter.telefono;
        document.getElementById('filtro-email').value = filter.email;
        document.getElementById('filtro-select').value = filter.clase;
    }
    let limit = localStorage.getItem('limit')
    if (limit && limit != 'none') {
        document.getElementById('limite-registros').value = limit;
    }
}


export function voidLocalFilter() {
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        localStorage.setItem('filter', JSON.stringify({ dni: '', nombre: '', apellidos: '', telefono: '', email: '', clase: '' }))
        if (document.getElementById('filtro-dni')) {
            document.getElementById('filtro-dni').value = '';
        }
    } else {
        localStorage.setItem('filter', JSON.stringify({ nombre: '', apellidos: '', telefono: '', email: '', dept: '' }))
    }
    document.getElementById('filtro-nombre').value = '';
    document.getElementById('filtro-apellidos').value = '';
    document.getElementById('filtro-telefono').value = '';
    document.getElementById('filtro-email').value = '';
    document.getElementById('filtro-select').value = '';
    asyncShow();
}


export function updatePageButtons() {
    let currentPage = localStorage.getItem('page')
    if (!currentPage) {
        localStorage.setItem('page', 1)
        document.getElementById('current-page').innerText = 1;
        document.getElementById('reduce-page-button').disabled = true;
    } else {
        document.getElementById('current-page').innerText = currentPage;
        if (currentPage == 1) {
            document.getElementById('reduce-page-button').disabled = true;
            document.getElementById('start-page-button').disabled = true;
        } else {
            document.getElementById('reduce-page-button').disabled = false;
            document.getElementById('start-page-button').disabled = false;
        }
    }
    let maxPages = document.getElementById('max-pages').value;
    document.getElementById('num-pages').innerText = maxPages + ' páginas';
    if (currentPage && currentPage == maxPages) {
        document.getElementById('add-page-button').disabled = true;
        document.getElementById('end-page-button').disabled = true;
    } else {
        document.getElementById('add-page-button').disabled = false;
        document.getElementById('end-page-button').disabled = false;

    }
    let scope = localStorage.getItem('data_scope');
    if (!scope || scope == 'alumnos') {
        document.getElementById('scope-alumnos').checked = true;
        document.getElementById('scope-profesores').checked = false;
    } else {
        document.getElementById('scope-profesores').checked = true;
        document.getElementById('scope-alumnos').checked = false;
    }
}


export function changePage(opt) {
    let currentPage = localStorage.getItem('page')
    if (!currentPage) {
        localStorage.setItem('page', 1)
    } else {
        if (currentPage == 1 && opt == 'reduce') {
            localStorage.setItem('page', 1)
        } else {
            if (opt == 'reduce') {
                localStorage.setItem('page', parseInt(currentPage) - 1)
            } else if (opt == 'add') {
                localStorage.setItem('page', parseInt(currentPage) + 1)
            } else if (opt == 'end') {
                let maxPages = document.getElementById('max-pages').value;
                localStorage.setItem('page', maxPages)
            } else {
                localStorage.setItem('page', 1)
            }
        }
    }
    updatePageButtons();
    asyncShow();
}


export function changeOrderBy(opt) {
    if (localStorage.getItem('orderby') && localStorage.getItem('orderby') == opt) {
        localStorage.removeItem('orderby')
    } else {
        localStorage.setItem('orderby', opt);
    }
    asyncShow();
}


export function removeLimit() {
    localStorage.setItem('limit', 'none')
    localStorage.setItem('page', 1)
    document.getElementById('limite-registros').value = '';
    asyncShow();
}


export function changeLimit() {
    let limitValue = document.getElementById('limite-registros').value
    if (!isNaN(limitValue)) {
        localStorage.setItem('limit', limitValue);
    } else {
        removeLimit();
    }
    localStorage.setItem('page', 1);
    asyncShow();
}


export function changeDataVisualizationScope() {
    let dataScope = document.querySelector('input[name="datos-scope"]:checked').value;
    localStorage.setItem('data_scope', dataScope)
    asyncShow();
    changeFilterInputs()
    displayLocalFilter()
}


export function changeFilterInputs() {
    let container = document.getElementById('filtros-container');
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        if (!document.getElementById("filtro-dni")) {
            container.innerHTML = '<input id="filtro-dni" type="text" name="dni" class="filtro form-control" placeholder="DNI"/>' + container.innerHTML
        }
        asyncShowClases('filtro-select')
    } else {
        if (document.getElementById("filtro-dni")) {
            document.getElementById('filtro-dni').remove()
        }
        asyncShowDepts('filtro-select')
    }
}

export function changeUsername() {
    let nombreUsuario = localStorage.getItem('nombre_usuario');
    document.getElementById('nombre-usuario').innerHTML = `Usuario: ${nombreUsuario}`;
}