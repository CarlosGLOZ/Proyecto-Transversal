<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

//RECUPERAR DATOS
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

if ($_POST['scope'] == 'alumnos') {
    $dni = $_POST['dni'];
    $clase = $_POST['clase'];
    $sql = "INSERT INTO tbl_alumne (`dni_alu`, `nom_alu`, `cognoms_alu`, `telf_alu`, `email_alu`, `classe`) VALUES ('$dni', '$nombre', '$apellidos', '$telefono', '$email', $clase);";

} else {
    $password = sha1($_POST['password']);
    $dept = $_POST['dept'];
    $sql = "INSERT INTO tbl_professor (`nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `contra`, `dept`) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$password', $dept);";

}

$insert = mysqli_query($conexion, $sql);


