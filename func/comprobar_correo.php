<?php

// COMPROBAR SI UN CORREO YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
function comprobar_correo($conexion, $email, $id=null, $scope=null) {
    $sql = "SELECT COUNT(1) as `total` FROM tbl_professor, tbl_alumne WHERE email_prof = '$email' OR email_alu = '$email'";

    if ($id && $scope) {
        if ($scope == 'alumnos') {
            $sql .= " AND id_alumne != $id";
        } else {
            $sql .= " AND id_professor != $id";
        }
    }

    $result = mysqli_query($conexion, $sql);
    $total_correos = mysqli_fetch_assoc($result)['total'];
    
    if ($total_correos > 0) {
        echo "CORREO YA EXISTE";
        die();
    }
}

