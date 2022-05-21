import { asyncUploadToServer, asyncSendMultipleMail, asyncSendMail, asyncDelete, asyncModify, asyncCreate, asyncMultipleModify, asyncMultipleDelete, asyncShowDepts, asyncChangePassword, asyncDownload, asyncUpload } from "./ajax.js"
import { validaTexto, valida_DNI, valida_telefono, valida_correo } from './valida.js';


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


export function alertMultipleModify() {
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        alertMultipleModifyAlu()
    } else {
        alertMultipleModifyProf()
    }
}


export function alertModifyProf(id, nombre, apellidos, telefono, email, dept, clase) {
    Swal.fire({
        title: 'Modificar',
        html: `<input type="text" id="nombre" class="swal2-input" placeholder="Nombre" value="${nombre}">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos" value="${apellidos}">
               <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono" value="${telefono}">
               <input type="email" id="email" class="swal2-input" placeholder="Email" value="${email}">
               <select id="select-dept" class="swal2-input" name='dept'></select><br>
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Modificar',
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => {
            asyncShowDepts('select-dept', dept)
            asyncShowClases('select-clases', clase)
            // VALIDAR NOMBRE:
            document.getElementById("nombre").onblur = validaTexto;
            // VALIDAR APELLIDOS:
            document.getElementById("apellidos").onblur = validaTexto;
            // VALIDAR TELÉFONO:
            document.getElementById("telefono").onblur = validaTexto;
            document.getElementById("telefono").onblur = valida_telefono;
            // VALIDAR EMAIL: 
            document.getElementById("email").onblur = validaTexto;
            // VALIDAR CONTRASEÑA:
            document.getElementById("password").onblur = validaTexto;
            // VALIDA CLASE:
            document.getElementById("select-dept").onblur = validaTexto;
        },
        preConfirm: () => {
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let dept = Swal.getPopup().querySelector('#select-dept').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, email: email, apellidos: apellidos, telefono: telefono, email: email, dept: dept, clase: clase }
        }
    }).then((result) => {
        asyncModify(id, result.value)
    })
}


export function alertMultipleModifyProf() {
    Swal.fire({
        title: 'Mulitple modify',
        html: `<select id="select-dept" class="swal2-input" name='dept'></select>`,
        confirmButtonText: 'Modify',
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => asyncShowDepts('select-dept'),
        preConfirm: () => {
            let dept = Swal.getPopup().querySelector('#select-dept').value
            return { dept: dept }
        }
    }).then((result) => {
        asyncMultipleModify(result.value)
    })
}


export function alertChangePasswordProf(id) {
    Swal.fire({
        title: 'Cambiar password',
        html: `<input type="password" id="password" class="swal2-input" placeholder="Nuevo password">`,
        confirmButtonText: 'Cambiar password',
        focusConfirm: false,
        preConfirm: () => {
            let password = Swal.getPopup().querySelector('#password').value
            return { id: id, password: password }
        }
    }).then((result) => {
        asyncChangePassword(result.value)
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
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => {
            asyncShowClases('select-clases', clase)
            // VALIDAR DNI:
            document.getElementById("dni").onblur = validaTexto;
            document.getElementById("dni").onblur = valida_DNI;
            // VALIDAR NOMBRE:
            document.getElementById("nombre").onblur = validaTexto;
            // VALIDAR APELLIDOS:
            document.getElementById("apellidos").onblur = validaTexto;
            // VALIDAR TELÉFONO:
            document.getElementById("telefono").onblur = validaTexto;
            document.getElementById("telefono").onblur = valida_telefono;
            // VALIDAR EMAIL: 
            document.getElementById("email").onblur = validaTexto;
            // VALIDA CLASE:
            document.getElementById("select-clases").onblur = validaTexto;
        },
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


export function alertMultipleModifyAlu() {
    Swal.fire({
        title: 'Mulitple modify',
        html: `<select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Modify',
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => asyncShowClases('select-clases'),
        preConfirm: () => {
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { clase: clase }
        }
    }).then((result) => {
        asyncMultipleModify(result.value)
    })
}


export function alertCreate() {
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        alertCreateAlu()
    } else {
        alertCreateProf()
    }
}


export function alertCreateAlu() {
    Swal.fire({
        title: 'Crear',
        html: `<input type="text" id="dni" class="swal2-input" placeholder="DNI">
               <input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="number" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Crear',
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => {
            asyncShowClases('select-clases')
            // VALIDAR DNI:
            document.getElementById("dni").onblur = validaTexto;
            document.getElementById("dni").onblur = valida_DNI;
            // VALIDAR NOMBRE:
            document.getElementById("nombre").onblur = validaTexto;
            // VALIDAR APELLIDOS:
            document.getElementById("apellidos").onblur = validaTexto;
            // VALIDAR TELÉFONO:
            document.getElementById("telefono").onblur = validaTexto;
            document.getElementById("telefono").onblur = valida_telefono;
            // VALIDAR EMAIL: 
            document.getElementById("email").onblur = validaTexto;
            document.getElementById("email").onblur = valida_correo;
            // VALIDA CLASE:
            document.getElementById("select-clases").onblur = validaTexto;
        },
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


export function alertCreateProf() {
    Swal.fire({
        title: 'Crear',
        html: `<input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="number" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <input type="password" id="password" class="swal2-input" placeholder="Password">
               <select id="select-dept" class="swal2-input" name='dept'></select>`,
        confirmButtonText: 'Crear',
        showCancelButton: true,
        focusConfirm: false,
        didOpen: () => {
            asyncShowDepts('select-dept')
            // VALIDAR NOMBRE:
            document.getElementById("nombre").onblur = validaTexto;
            // VALIDAR APELLIDOS:
            document.getElementById("apellidos").onblur = validaTexto;
            // VALIDAR TELÉFONO:
            document.getElementById("telefono").onblur = validaTexto;
            document.getElementById("telefono").onblur = valida_telefono;
            // VALIDAR EMAIL: 
            document.getElementById("email").onblur = validaTexto;
            // VALIDAR CONTRASEÑA:
            document.getElementById("password").onblur = validaTexto;
            // VALIDA CLASE:
            document.getElementById("select-dept").onblur = validaTexto;
        },
        preConfirm: () => {
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let password = Swal.getPopup().querySelector('#password').value
            let dept = Swal.getPopup().querySelector('#select-dept').value
            return { nombre: nombre, email: email, apellidos: apellidos, telefono: telefono, email: email, password: password, dept: dept }
            /* if (!login || !password) {
                Swal.showValidationMessage(`Please enter login and password`)
            } */
        }
    }).then((result) => {
        asyncCreate(result.value)
    })
}


export function alertFailed(error, callBack=null, values = null) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error,
    }).then(() => {
        if (!values) {
            callBack();
        } else {
            let scope = localStorage.getItem('data_scope')
            if (!scope || scope == 'alumnos') {
                callBack(values.id, values.dni, values.nombre, values.apellidos, values.telefono, values.email, values.clase);
            } else {
                callBack(values.id, values.nombre, values.apellidos, values.telefono, values.email, values.dept, values.clase)
            }
        }
    })
}


export function alertDownloadCSV(mode) {
    Swal.fire({
        title: 'Descargar CSV',
        html: `
        <select id="tipo_usuario" name="tipo_usuario">
            <option value="profes">Profesores</option>
            <option value="alumnos">Alumnos</option>
        </select>`,
        confirmButtonText: 'Descargar',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            let tipo_usuario = Swal.getPopup().querySelector('#tipo_usuario').value
            return { tipo_usuario: tipo_usuario }
            /* if (!login || !password) {
                Swal.showValidationMessage(`Please enter login and password`)
            } */
        }
    }).then((result) => {
        if (mode == 'local') {
            asyncDownload(result.value)
        } else {
            asyncUploadToServer(result.value)
        }
    })
}


export function alertUploadCSV() {
    Swal.fire({
        title: 'Cargar CSV',
        html: `
        <input id="csv" type="file" name="csv">
        <select id="tipo_usuario" name="tipo_usuario">
            <option value="profes">Profesores</option>
            <option value="alumnos">Alumnos</option>
        </select>`,
        confirmButtonText: 'Cargar',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            let file = Swal.getPopup().querySelector('#csv').files[0]
            let tipo_usuario = Swal.getPopup().querySelector('#tipo_usuario').value
            return { file: file, tipo_usuario: tipo_usuario }
        }
    }).then((result) => {
        asyncUpload(result.value)
    })
}


export function alertSuccessAction(msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    
    Toast.fire({
        icon: 'success',
        title: msg
    })
}


export function alertSendMail(email) {
    Swal.fire({
        title: 'Enviar correo',
        html: `<input id="email" class="swal2-input" type="text" value="${email}" placeholder="Correo" />
               <input id="asunto" class="swal2-input" type="text" placeholder="Asunto" />
               <textarea id="mensaje" class="swal2-input" placeholder="Mensaje"></textarea>`,
        confirmButtonText: 'Enviar',
        showCancelButton: true,
        customClass: 'swal-wide',
        focusConfirm: false,
        didOpen: () => {
            // VALIDAR CORREO
            document.getElementById("email").onblur = valida_correo;
            document.getElementById("email").onblur = validaTexto;
            // VALIDAR ASUNTO
            document.getElementById("asunto").onblur = validaTexto;
            // VALIDAR MENSAJE
            document.getElementById("mensaje").onblur = validaTexto;
        },
        preConfirm: () => {
            let email = Swal.getPopup().querySelector('#email').value
            let asunto = Swal.getPopup().querySelector('#asunto').value
            let mensaje = Swal.getPopup().querySelector('#mensaje').value
            return { email: email, asunto: asunto, mensaje: mensaje }
        }
    }).then((result) => {
        asyncSendMail(result.value)
    })
}


export function alertMultipleMail() {
    Swal.fire({
        title: 'Enviar correo multiple',
        html: `<select id="select-clases" class="swal2-input" name='clases'></select>
               <input id="asunto" class="swal2-input" type="text" placeholder="Asunto" />
               <textarea id="mensaje" class="swal2-input" placeholder="Mensaje"></textarea>`,
        confirmButtonText: 'Enviar',
        showCancelButton: true,
        customClass: 'swal-wide',
        focusConfirm: false,
        didOpen: () => {
            asyncShowClases('select-clases')
            // VALIDAR ASUNTO
            document.getElementById("asunto").onblur = validaTexto;
            // VALIDAR MENSAJE
            document.getElementById("mensaje").onblur = validaTexto;
            // VALIDA CLASE:
            document.getElementById("select-clases").onblur = validaTexto;
        },
        preConfirm: () => {
            let clase = Swal.getPopup().querySelector('#select-clases').value
            let asunto = Swal.getPopup().querySelector('#asunto').value
            let mensaje = Swal.getPopup().querySelector('#mensaje').value
            return { clase: clase, asunto: asunto, mensaje: mensaje }
        }
    }).then((result) => {
        asyncSendMultipleMail(result.value)
        Swal.showLoading()
    })
}