import { changeUsername, checkCheckedCheckboxes, updatePageButtons } from "./utils.js";
import { alertCreateAlu, alertCreateProf, alertFailed, alertModify, alertModifyProf, alertSuccessAction } from "./alerts.js";


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
        data = { id: id, scope: scope, nombre: values.nombre, dni: values.dni, apellidos: values.apellidos, telefono: values.telefono, email: values.email, clase: values.clase };
    } else {
        data = { id: id, scope: scope, nombre: values.nombre, apellidos: values.apellidos, telefono: values.telefono, email: values.email, dept: values.dept, clase: values.clase };
    }
    $.ajax({
        type: 'POST',
        url: '../proc/modificar_reg.php',
        data: data,
        success: function(response) {
            let error;
            if (response) {
                if (response == 'Correo ya existe') {
                    error = 'Correo ya existe';
                } else if (response == 'DNI ya existe') {
                    error = 'DNI ya existe';
                } else if (response == 'Esta clase ya tiene tutor') {
                    error = "Esta clase ya tiene tutor"
                } else {
                    localStorage.setItem('nombre_usuario', response)
                    changeUsername()
                }
                if (error) {
                    let scope = localStorage.getItem('data_scope')
                    if (!scope || scope == 'alumnos') {
                        alertFailed(error, alertModify, data)
                    } else {
                        alertFailed(error, alertModifyProf, data)
                    }
                } 
            }
            if (!error) {
                alertSuccessAction('Registro modificado')
            }
            asyncShow()
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
                let scope = localStorage.getItem('data_scope')
                if (!scope || scope == 'alumnos') {
                    alertFailed(error, alertCreateAlu)
                } else {
                    alertFailed(error, alertCreateProf)
                }
            } else {
                alertSuccessAction('Registro creado')
            }
            asyncShow()
        }
    })
}


export function asyncMultipleModify(values) {
    let query;
    let data;
    let scope = localStorage.getItem('data_scope')
    if (!scope || scope == 'alumnos') {
        query = 'alumno'
        data = { scope: scope, clase: values.clase }
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
            data: { ids: checks, scope: scope },
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
        data: { id: values.id, password: values.password },
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


// SUBIR O CARGAR CSV:
export function asyncUpload(value) {
    let url = "../proc/cargar_csv.php"
        // var formData = new FormData();

    var formData = new FormData();

    formData.append("csv", value.file);
    formData.append("tipo_usuario", value.tipo_usuario);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            var respuesta = JSON.parse(response);

            if (respuesta.repeats) {
                alertFailed(respuesta.repeats);
            }
            if (respuesta.error) {
                alertFailed(respuesta.error);
            }
            if (respuesta.parametros) {
                alertFailed(respuesta.parametros);
            }
            asyncShow();
        }
    })
}


// DESCARGAR CSV:
export function asyncDownload(values) {
    let url = "../view/descargar_csv.php"

    fetch(`../proc/descargar_csv.php?tipo_usuario=${values.tipo_usuario}`)
        .then(resp => resp.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = "datos.csv";
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(() => alert('oh no!'));
}


export function asyncSendMail(values) {
    let data = {asunto: values.asunto, mensaje: values.mensaje, email: values.email}
    $.ajax({
        type: 'POST',
        url: '../proc/enviar_mail_reg.php',
        data: data,
        success: function(response) {
            alertSuccessAction('Correo enviado')
        }
    })
}


export function asyncSendMultipleMail(values) {
    let data = {asunto: values.asunto, mensaje: values.mensaje, clase: values.clase}
    Swal.fire({
        title: 'Porfavor espere',
        html: 'enviando correo',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            $.ajax({
                type: 'POST',
                url: '../proc/multiple_enviar_mail_reg.php',
                data: data,
                success: function(response) {
                    swal.close();
                    alertSuccessAction('Correo enviado')
                }
            })
        },
    });
    
}


export function asyncUploadToServer(values) {
    Swal.fire({
        title: 'Porfavor espere',
        html: 'subiendo archivo al servidor',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            $.ajax({
                type: 'GET',
                url: `../proc/descargar_csv_ftp.php?tipo_usuario=${values.tipo_usuario}`,
                success: function(response) {
                    alertSuccessAction('CSV subido al servidor')
                }
            })
        },
    });
}