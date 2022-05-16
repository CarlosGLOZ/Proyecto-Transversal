import { asyncDelete, asyncModify, asyncCreate, asyncMultipleModify, asyncMultipleDelete } from "./ajax.js"


export function alertDelete(id) {
    Swal.fire({
            title: '¿Estas seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        })
        .then((result) => {
            if (result.isConfirmed) {
                asyncDelete(id);
            }
        })
}


export function alertMultipleDelete() {
    Swal.fire({
            title: '¿Estas seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        })
        .then((result) => {
            if (result.isConfirmed) {
                asyncMultipleDelete();
            }
        })
}


export function alertModify(id, dni, nombre, apellidos, telefono, email, clase) {
    Swal.fire({
        title: 'Modificar',
        html: `<input type="text" id="dni" class="swal2-input" placeholder="DNI" value="${dni}">
               <input type="text" id="nombre" class="swal2-input" placeholder="" value="${nombre}">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos" value="${apellidos}">
               <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono" value="${telefono}">
               <input type="email" id="email" class="swal2-input" placeholder="Email" value="${email}">
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Modificar',
        focusConfirm: false,
        didOpen: () => asyncShowClases('select-clases', clase),
        preConfirm: () => {
            let dni = Swal.getPopup().querySelector('#dni').value
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, dni: dni, email: email, apellidos: apellidos, telefono: telefono, email: email, clase: clase }
            /* if (!login || !password) {
                Swal.showValidationMessage(`Please enter login and password`)
            } */
        }
    }).then((result) => {
        asyncModify(id, result.value)
    })
}


export function alertMultipleModify() {
    Swal.fire({
        title: 'Mulitple modify',
        html: `<input type="text" id="dni" class="swal2-input" placeholder="DNI">
               <input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Modify',
        focusConfirm: false,
        didOpen: () => asyncShowClases('select-clases'),
        preConfirm: () => {
            let dni = Swal.getPopup().querySelector('#dni').value
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, dni: dni, email: email, apellidos: apellidos, telefono: telefono, email: email, clase: clase }
        }
    }).then((result) => {
        asyncMultipleModify(result.value)
    })
}


export function alertCreate() {
    Swal.fire({
        title: 'Crear',
        html: `<input type="text" id="dni" class="swal2-input" placeholder="DNI">
               <input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Crear',
        focusConfirm: false,
        didOpen: () => asyncShowClases('select-clases'),
        preConfirm: () => {
            let dni = Swal.getPopup().querySelector('#dni').value
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, dni: dni, email: email, apellidos: apellidos, telefono: telefono, email: email, clase: clase }
        }
    }).then((result) => {
        asyncCreate(result.value)
    })
}