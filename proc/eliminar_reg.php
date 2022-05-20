<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';

include './conexion.php';

/* VALIDACIONES */
if (!isset($_GET['scope']) || !isset($_GET['id'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* ELIMINAR */
if ($_GET['scope'] == 'alumnos') {
    $sql = "DELETE FROM tbl_alumne WHERE id_alumne={$_GET['id']}";
} else {
    $sql = "DELETE FROM tbl_professor WHERE id_professor={$_GET['id']}";
}

$delete = mysqli_query($conexion, $sql);




