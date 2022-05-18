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
        echo "DNI YA EXISTE";
        die();
    }
}