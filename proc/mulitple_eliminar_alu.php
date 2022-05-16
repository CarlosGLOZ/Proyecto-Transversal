<?php

include './conexion.php';

$alumnos = $_POST['ids'];

foreach ($alumnos as $id) {
    $sql = "DELETE FROM tbl_alumne WHERE `id_alumne` = $id";
    mysqli_query($conexion, $sql);
}

