import { asyncShow } from "./ajax.js";


export function checkCheckedCheckboxes() {
    let checkedCheckboxes = document.querySelectorAll('input[name=alumno]:checked');
    if (checkedCheckboxes.length > 0) {
        document.getElementById('multiple-delete-button').disabled = false;
        document.getElementById('multiple-modify-button').disabled = false;
    } else {
        document.getElementById('multiple-delete-button').disabled = true;
        document.getElementById('multiple-modify-button').disabled = true;

    }
}


export function checkAllCheckboxes() {
    let isChecked = document.getElementById('check-all').checked;
    var ele = document.getElementsByName('alumno');
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
    let dni = document.getElementById('filtro-dni').value;
    let nombre = document.getElementById('filtro-nombre').value;
    let apellidos = document.getElementById('filtro-apellidos').value;
    let telefono = document.getElementById('filtro-telefono').value;
    let email = document.getElementById('filtro-email').value;
    let clase = document.getElementById('filtro-clases').value;
    let filter = { dni: dni, nombre: nombre, apellidos: apellidos, telefono: telefono, email: email, clase: clase };
    localStorage.setItem('filter', JSON.stringify(filter));
    localStorage.setItem('page', 1)
    asyncShow();
    updatePageButtons();
}


export function displayLocalFilter() {
    let filter = localStorage.getItem('filter');
    filter = JSON.parse(filter)
    if (filter.nombre || filter.dni || filter.apellidos || filter.telefono || filter.email || filter.clase) {
        document.getElementById('filtro-dni').value = filter.dni;
        document.getElementById('filtro-nombre').value = filter.nombre;
        document.getElementById('filtro-apellidos').value = filter.apellidos;
        document.getElementById('filtro-telefono').value = filter.telefono;
        document.getElementById('filtro-email').value = filter.email;
        document.getElementById('filtro-clases').value = filter.clase;
    }
    let limit = localStorage.getItem('limit')
    if (limit && limit != 'none') {
        document.getElementById('limite-registros').value = limit;
    }
}


export function voidLocalFilter() {
    localStorage.setItem('filter', JSON.stringify({ dni: '', nombre: '', apellidos: '', telefono: '', email: '', clase: '' }))
    document.getElementById('filtro-dni').value = '';
    document.getElementById('filtro-nombre').value = '';
    document.getElementById('filtro-apellidos').value = '';
    document.getElementById('filtro-telefono').value = '';
    document.getElementById('filtro-email').value = '';
    document.getElementById('filtro-clases').value = '';
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