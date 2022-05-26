import { asyncUploadToServer, asyncSendMultipleMail, asyncSendMail, asyncDelete, asyncModify, asyncCreate, asyncMultipleModify, asyncMultipleDelete, asyncShowDepts, asyncChangePassword, asyncDownload, asyncUpload } from "./ajax.js"
import { validaTexto, valida_correo, validarFormularioInputAlu, validarFormularioInputProf, validarFormularioInputMail } from './valida.js';


// ALERTA ELIMINAR REGISTROS
export function alertDelete(id) {
    Swal.fire({
            title: '¿Estas seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                // LLAMA A AL FUNCION AJAX DE ELIMINAR
                asyncDelete(id);
            }
        })
}


// ALERTA ELIMINAR MULTIPLES REGISTROS A LA VEZ
export function alertMultipleDelete() {
    Swal.fire({
            title: '¿Seguro que quieres eliminar todos los registros seleccionados?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                // LLAMA A LA FUNCION AJAX DE ELIMINAR MULTIPLE
                asyncMultipleDelete();
            }
        })
}


// ALERTA PARA DETERMINAR FUNCION DE MODIFICAR MUTIPLES REGISTROS
export function alertMultipleModify() {
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        // SI EL SCOPE ES ALUMNOS LLAMA A LA ALERTA DE MODIFICAR MULTIPLES ALUMNOS
        alertMultipleModifyAlu()
    } else {
        // SI EL SCOPE ES PROFESORES LLAMA A LA ALERTA DE MODIFICAR MULTIPLES PROFESORES
        alertMultipleModifyProf()
    }
}


// ALERTA MODIFICAAR LOS DATOS DE UN PROFESOR
export function alertModifyProf(id, nombre, apellidos, telefono, email, dept, clase, admin) {
    Swal.fire({
        title: 'Modificar profesor',
        html: `<input type="text" id="nombre" class="swal2-input" placeholder="Nombre" value="${nombre}">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos" value="${apellidos}">
               <input type="text" id="telefono" class="swal2-input" placeholder="Teléfono" value="${telefono}">
               <input type="email" id="email" class="swal2-input" placeholder="Email" value="${email}"><br>
               <select id="select-dept" class="swal2-input" name='dept'></select><br>
               <select id="select-clases" class="swal2-input" name='clases'></select>
               <div class="admin-container">
               <input type="checkbox" id="admin" class="swal2-input" ${admin == 1 ? 'checked' : ''}  />
               <label for="admin">Administrador</label>
               </div>`,
        confirmButtonText: 'Modificar',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // MOSTRAR LISTA DE DEPARTAMENTOS
            asyncShowDepts('select-dept', dept)
                // MOSTRAR LISTA DE CLASES
            asyncShowClases('select-clases', clase, 'profesores')
                // VALIDAR EL FORMULARIO
            validarFormularioInputProf()
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let dept = Swal.getPopup().querySelector('#select-dept').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            let admin = Swal.getPopup().querySelector('#admin').checked
            return { nombre: nombre, email: email, apellidos: apellidos, telefono: telefono, email: email, dept: dept, clase: clase, admin: admin }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA MODIFICAR REGISTROS PASANDO LOS DATOS RECOGIDOS DEL FORMULARIO
            asyncModify(id, result.value)
        }
    })
}


// ALERTA MODIFICAR MULTIPLES PROFESORES
export function alertMultipleModifyProf() {
    Swal.fire({
        title: 'Cambiar departamento',
        html: `<select id="select-dept" class="swal2-input" name='dept'></select>`,
        confirmButtonText: 'Modify',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // MOSTRAR LISTA DE DEPARTAMENTOS
            asyncShowDepts('select-dept')
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let dept = Swal.getPopup().querySelector('#select-dept').value
            return { dept: dept }
        }
    }).then((result) => {
        // LLAMAR A LA FUNCION AJAX PARA MODIFICAR MULTIPLES REGISTROS PASANDO LOS DATOS RECOGIDOS DEL FORMULARIO
        asyncMultipleModify(result.value)
    })
}


// ALERTA PARA MODIFICAR EL PASSWORD DE LOS PROFESORES
export function alertChangePasswordProf(id) {
    Swal.fire({
        title: 'Cambiar password',
        html: `<input type="password" id="password" class="swal2-input" placeholder="Nuevo password">`,
        confirmButtonText: 'Cambiar',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let password = Swal.getPopup().querySelector('#password').value
            return { id: id, password: password }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA MODIFICAR EL PASSWORD
            asyncChangePassword(result.value)
        }
    })
}


// ALERTA PARA MODIFICAR LOS DATOS DE UN ALUMNO
export function alertModifyAlu(id, dni, nombre, apellidos, telefono, email, clase) {
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
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // MOSTRAR LISTA DE CLASES
            asyncShowClases('select-clases', clase)
                // VALIDARA FORMULARIO
            validarFormularioInputAlu()
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let dni = Swal.getPopup().querySelector('#dni').value
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, dni: dni, email: email, apellidos: apellidos, telefono: telefono, email: email, clase: clase }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA MODIFICAR REGISTROS
            asyncModify(id, result.value)
        }
    })
}


// ALERTA PARA MODIFICAR MULTIPLES ALUMNOS
export function alertMultipleModifyAlu() {
    Swal.fire({
        title: 'Cambiar clase',
        html: `<select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Modify',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // MOSTRAR LISTA DE CLASES
            asyncShowClases('select-clases')
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { clase: clase }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA MODIFICAR MULTIPLES REGISTROS
            asyncMultipleModify(result.value)
        }
    })
}


// ALERTA PARA DETERMINAR FUNCION DE CREAR REGISTRO
export function alertCreate() {
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        alertCreateAlu()
    } else {
        alertCreateProf()
    }
}


// ALERTA PARA CREAR UN ALUMNO
export function alertCreateAlu() {
    Swal.fire({
        title: 'Crear alumno',
        html: `<input type="text" id="dni" class="swal2-input" placeholder="DNI">
               <input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="number" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <select id="select-clases" class="swal2-input" name='clases'></select>`,
        confirmButtonText: 'Crear',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        allowOutsideClick: false,
        didOpen: () => {
            // DESHABILITAR EL BOTON DE CONFIRMAR
            document.getElementsByClassName('swal2-confirm')[0].disabled = true;
            // MOSTRAR LISTA DE CLASES
            asyncShowClases('select-clases')
                // VALIDAR FORMULARIO
            validarFormularioInputAlu()
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let dni = Swal.getPopup().querySelector('#dni').value
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let clase = Swal.getPopup().querySelector('#select-clases').value
            return { nombre: nombre, dni: dni, email: email, apellidos: apellidos, telefono: telefono, email: email, clase: clase }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA CREAR REGISTROS
            asyncCreate(result.value)
        }
    })
}


// ALERTA PARA CREAR UN PROFESOR
export function alertCreateProf() {
    Swal.fire({
        title: 'Crear profesor',
        html: `<input type="text" id="nombre" class="swal2-input" placeholder="Nombre">
               <input type="text" id="apellidos" class="swal2-input" placeholder="Apellidos">
               <input type="number" id="telefono" class="swal2-input" placeholder="Teléfono">
               <input type="email" id="email" class="swal2-input" placeholder="Email">
               <input type="password" id="password" class="swal2-input" placeholder="Password">
               <select id="select-dept" class="swal2-input" name='dept'></select>`,
        confirmButtonText: 'Crear',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // DESHABILITAR EL BOTON DE CONFIRMAR
            document.getElementsByClassName('swal2-confirm')[0].disabled = true;
            // MOSTRAR LISTA DE DEPARTAMENTOS
            asyncShowDepts('select-dept')
                // VALIDAR FORMULARIO
            validarFormularioInputProf(true)
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let nombre = Swal.getPopup().querySelector('#nombre').value
            let apellidos = Swal.getPopup().querySelector('#apellidos').value
            let telefono = Swal.getPopup().querySelector('#telefono').value
            let email = Swal.getPopup().querySelector('#email').value
            let password = Swal.getPopup().querySelector('#password').value
            let dept = Swal.getPopup().querySelector('#select-dept').value
            return { nombre: nombre, email: email, apellidos: apellidos, telefono: telefono, email: email, password: password, dept: dept }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA CREAR REGISTROS
            asyncCreate(result.value)
        }
    })
}


// ALERTA PARA PROCESO FALLIDO
export function alertFailed(error, callBack = null, values = null) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error,
        allowOutsideClick: false,
    }).then(() => {
        if (!values) {
            // SI NO SE PASAN VALORES SE LLAMA A LA FUNCION DE CALLBACK
            callBack();
        } else {
            // SI HAY VALORES SE COMPRUEBA EL SCOPE Y SE LLAMA A LA FUNCION DE CALLBACK PASANDOLE LOS PARAMETROS NECESARIOS
            let scope = localStorage.getItem('data_scope')
            if (!scope || scope == 'alumnos') {
                callBack(values.id, values.dni, values.nombre, values.apellidos, values.telefono, values.email, values.clase);
            } else {
                callBack(values.id, values.nombre, values.apellidos, values.telefono, values.email, values.dept, values.clase)
            }
        }
    })
}


// ALERTA PARA DESCARGAR FICHERO CSV
export function alertDownloadCSV(mode) {
    Swal.fire({
        title: `Descargar CSV en ${mode}`,
        html: `<select class="swal2-input" id="tipo_usuario" name="tipo_usuario">
                    <option value="profes">Profesores</option>
                    <option value="alumnos">Alumnos</option>
                </select>`,
        confirmButtonText: 'Descargar',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let tipo_usuario = Swal.getPopup().querySelector('#tipo_usuario').value
            return { tipo_usuario: tipo_usuario }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            if (mode == 'local') {
                // SI EL MODO ES EN LOCAL, SE DESCARGA EL FICHER CSV EN EL NAVEGADOR
                asyncDownload(result.value)
            } else {
                // SI EL MODO ES EN SERVIDOR, SE CARGA EL FICHERO CSV EN EL SERVIDOR 
                asyncUploadToServer(result.value)
            }
        }
    })
}


// ALERTA PARA CARGAR FICHERO CSV A LA BASE DE DATOS
export function alertUploadCSV() {
    Swal.fire({
        title: 'Cargar CSV',
        html: `<div class="custom-file">
                    <input id="csv" class="custom-file-input" type="file" name="csv" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="csv">Selecciona el archivo</label>
                </div>
               <select class="swal2-input" id="tipo_usuario" name="tipo_usuario">
                    <option value="profes">Profesores</option>
                    <option value="alumnos">Alumnos</option>
               </select>`,
        confirmButtonText: 'Cargar',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let file = Swal.getPopup().querySelector('#csv').files[0]
            let tipo_usuario = Swal.getPopup().querySelector('#tipo_usuario').value
            return { file: file, tipo_usuario: tipo_usuario }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A LA FUNCION AJAX PARA SUBIR CSV
            asyncUpload(result.value)
        }
    })
}


// ALERTA PARA ACCION EXITOSA
export function alertSuccessAction(msg) {
    // SE DEFINE ALERTA PERSONALIZADA
    const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                // SI PASA EL MOUSE POR ENCIMA DEL ELEMENTO SE DETIENE EL CONTADOR
                toast.addEventListener('mouseenter', Swal.stopTimer)
                    // SI SE SALE EL MOUSE DEL ELEMENTO CONTINUA EL CONTADOR
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        // SE MUESTRA ALERTA PERSONALIZADA
    Toast.fire({
        icon: 'success',
        title: msg
    })
}


// ALERTA PARA ENVIAR MAIL
export function alertSendMail(email) {
    Swal.fire({
        title: 'Enviar correo',
        html: `<input id="email" class="swal2-input" type="text" value="${email}" placeholder="Correo" />
               <input id="asunto" class="swal2-input" type="text" placeholder="Asunto" />
               <textarea id="mensaje" class="swal2-input" placeholder="Mensaje"></textarea>
               <div class="custom-file mail-adjunto">
                    <input id="adjunto" class="custom-file-input" type="file" name="csv" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="adjunto">Selecciona el archivo</label>
                </div>`,
        confirmButtonText: 'Enviar',
        showCancelButton: true,
        customClass: 'swal-wide',
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // DEHABILITAR BOTON DE ENVIAR
            document.getElementsByClassName('swal2-confirm')[0].disabled = true;
            // VALIDAR FORMULARIO
            validarFormularioInputMail(false)
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let email = Swal.getPopup().querySelector('#email').value
            let asunto = Swal.getPopup().querySelector('#asunto').value
            let mensaje = Swal.getPopup().querySelector('#mensaje').value
            if (Swal.getPopup().querySelector('#adjunto').files.length > 0) {
                let adjunto = Swal.getPopup().querySelector('#adjunto').files[0]
                console.log("TIPO: " + adjunto);
                return { email: email, asunto: asunto, mensaje: mensaje, adjunto: adjunto }
            } else {
                return { email: email, asunto: asunto, mensaje: mensaje }
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A FUNCION AJAX PARA ENVIAR MAIL
            asyncSendMail(result.value)
        }
    })
}


// ALERTA PARA ENVIAR MULTIPLES MAILS
export function alertMultipleMail() {
    Swal.fire({
        title: 'Enviar correo multiple',
        html: `<select id="select-clases" class="swal2-input" name='clases'></select>
               <input id="asunto" class="swal2-input" type="text" placeholder="Asunto" />
               <textarea id="mensaje" class="swal2-input" placeholder="Mensaje"></textarea>
               <div class="custom-file mail-adjunto">
                    <input id="adjunto" class="custom-file-input" type="file" name="csv" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="adjunto">Selecciona el archivo</label>
                </div>`,
        confirmButtonText: 'Enviar',
        showCancelButton: true,
        customClass: 'swal-wide',
        focusConfirm: false,
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        didOpen: () => {
            // MOSTRAR LISTA DE CLASES
            asyncShowClases('select-clases')
                // DEHABILITAR BOTON DE ENVIAR
            document.getElementsByClassName('swal2-confirm')[0].disabled = true;
            // VALIDAR FORMULARIO
            validarFormularioInputMail()
        },
        preConfirm: () => {
            // RECOGER DATOS DEL FORMULARIO CUANDO SE CONFIRME
            let clase = Swal.getPopup().querySelector('#select-clases').value
            let asunto = Swal.getPopup().querySelector('#asunto').value
            let mensaje = Swal.getPopup().querySelector('#mensaje').value
            if (Swal.getPopup().querySelector('#adjunto').files.length > 0) {
                let adjunto = Swal.getPopup().querySelector('#adjunto').files[0]
                console.log("TIPO: " + adjunto);
                return { clase: clase, asunto: asunto, mensaje: mensaje, adjunto: adjunto }
            } else {
                return { clase: clase, asunto: asunto, mensaje: mensaje }
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // LLAMAR A FUNCION AJAX PARA ENVIAR MULTIPLES MAILS
            asyncSendMultipleMail(result.value)
                // LA ALERTA SE QUEDA CARGANDO HASTA RECIBIR RESPUESTA
            Swal.showLoading()
        }
    })
}