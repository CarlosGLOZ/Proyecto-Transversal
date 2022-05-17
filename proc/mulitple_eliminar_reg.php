<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

$alumnos = $_POST['ids'];

if ($_POST['scope'] == 'alumnos') {
    $sql = "DELETE FROM tbl_alumne WHERE `id_alumne`";
} else {
    $sql = "DELETE FROM tbl_professor WHERE `id_professor`";
}

foreach ($alumnos as $id) {
    mysqli_query($conexion, "$sql = $id");
}

