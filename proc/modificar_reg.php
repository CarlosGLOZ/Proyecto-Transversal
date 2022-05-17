<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

if ($_POST['scope'] == 'alumnos') {
    $dni = $_POST['dni'];
    $clase = $_POST['clase'];
    $sql = "UPDATE `tbl_alumne` SET `dni_alu` = '$dni', `nom_alu` = '$nombre', `cognoms_alu` = '$apellidos', `telf_alu` = '$telefono', `email_alu` = '$email', `classe` = '$clase' WHERE `id_alumne` = $id";

} else {
    $dept = $_POST['dept'];
    $sql = "UPDATE `tbl_professor` SET `nom_prof` = '$nombre', `cognoms_prof` = '$apellidos', `telf` = '$telefono', `email_prof` = '$email', `dept` = '$dept' WHERE `id_professor` = $id";
}

mysqli_query($conexion, $sql);

