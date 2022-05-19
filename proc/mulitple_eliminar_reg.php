<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';

include './conexion.php';

/* VALIDACIONES */
if (!isset($_POST['scope']) || empty($_POST['scope']) || !isset($_POST['ids']) || empty($_POST['ids'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

$registros = $_POST['ids'];

if ($_POST['scope'] == 'alumnos') {
    $sql = "DELETE FROM tbl_alumne WHERE `id_alumne`";
} else {
    $sql = "DELETE FROM tbl_professor WHERE `id_professor`";
}

foreach ($registros as $id) {
    mysqli_query($conexion, "$sql = $id");
}

