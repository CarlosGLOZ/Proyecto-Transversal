<?php

// COMPROBAR SI UN DNI YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
function comprobar_dni($conexion, $dni, $id=null) {
    $sql = "SELECT COUNT(1) as `total` FROM tbl_alumne WHERE `dni_alu` = '$dni'";

    if ($id) {
        $sql .= " AND id_alumne != $id";
    }

    $result = mysqli_query($conexion, $sql);
    $total_dni = mysqli_fetch_assoc($result)['total'];
    
    if ($total_dni > 0) {
<<<<<<< HEAD
        echo "DNI YA EXISTE";
=======
        echo "DNI ya existe";
>>>>>>> 1ae29927b6639f5be8d9f487dee1efcc1626ab3c
        die();
    }
}