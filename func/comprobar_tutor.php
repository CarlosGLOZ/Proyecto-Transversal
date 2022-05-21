<?php

// COMPROBAR SI UNA CLASE YA TIENE TUTOR
function comprobar_tutor($conexion, $clase, $profesor) {
    $sql = "SELECT tutor FROM tbl_classe WHERE id_classe = $clase AND tutor != $profesor";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_fetch_assoc($result)) {
        echo "Esta clase ya tiene tutor";
        die();
        
    } else {
        $sql = "UPDATE tbl_classe SET tutor = $profesor WHERE id_classe = $clase";
        $insert = mysqli_query($conexion, $sql);

    }
}

