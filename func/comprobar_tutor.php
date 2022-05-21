<?php

// COMPROBAR SI UNA CLASE YA TIENE TUTOR
function comprobar_tutor($conexion, $clase, $profesor) {

    // COMPROBAR SI SE ESTA ASIGNANDO O QUITANDO UN TUTOR
    if ($clase != 'null') {
        // COMRPOBAR SI YA HAY UN TUTOR EN LA CLASE SELECCIONADA
        $sql = "SELECT tutor FROM tbl_classe WHERE id_classe = $clase AND tutor != $profesor";
        $result = mysqli_query($conexion, $sql);
    
        if (mysqli_fetch_assoc($result)) {
            echo "Esta clase ya tiene tutor";
            die();
            
        } else {
            // COMPROBAR SI EL PROFESOR YA ESTA EN UNA CLASE
            $sql = "SELECT COUNT(1) as `total` FROM tbl_classe WHERE tutor = $profesor";
            $result = mysqli_query($conexion, $sql);

            // SI EL PROFESOR YA ES TUTOR DE UNA CLASE LO QUITAMOS DE ESTA
            if (mysqli_fetch_assoc($result)['total'] > 0) {
                $sql = "UPDATE tbl_classe SET tutor = NULL WHERE tutor = $profesor";
                $update = mysqli_query($conexion, $sql);
            }

            // ASIGNAR EL PROFESOR A LA NUEVA CLASE
            $sql = "UPDATE tbl_classe SET tutor = $profesor WHERE id_classe = $clase";
            $update = mysqli_query($conexion, $sql);
    
        }

    } else {
        // QUITAR TUTOR DE LA CLASE
        $sql = "UPDATE tbl_classe SET tutor = NULL WHERE tutor = $profesor";
        $update = mysqli_query($conexion, $sql);

    }
}

