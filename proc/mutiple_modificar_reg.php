<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

if (!isset($_POST['ids']) || empty($_POST['ids']) || !isset($_POST['scope']) || empty($_POST['scope']) ) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

$registros = $_POST['ids'];

if ($_POST['scope'] == 'alumnos') {
    $clase = strip_tags($_POST['clase']);
    $sql = "UPDATE `tbl_alumne` SET `classe` = $clase WHERE `id_alumne`";
} else {
    $dept = strip_tags($_POST['dept']);
    $sql = "UPDATE `tbl_professor` SET `dept` = $dept WHERE `id_professor`";

}

foreach ($registros as $id) {
    mysqli_query($conexion, $sql);
}