<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';

include './conexion.php';

/* VALIDACIONES COMUNES VARIABLES SETEADAS */
if (!isset($_POST['scope']) || !isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['telefono']) || !isset($_POST['email'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES COMUNES VARIABLES VACIAS */
if (empty($_POST['scope']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['telefono']) || empty($_POST['email'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES ALUMNOS */
if ($_POST['scope'] == 'alumnos' && (!isset($_POST['dni']) || empty($_POST['dni']) || !isset($_POST['clase']) || empty($_POST['clase']))) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES PROFESORES */
if ($_POST['scope'] == 'profesores' && (!isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['dept']) || empty($_POST['dept']) )) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

// RECUPERAR DATOS Y EVITAR INJECCIONES JS / HTML
$nombre = strip_tags($_POST['nombre']);
$apellidos = strip_tags($_POST['apellidos']);
$telefono = strip_tags($_POST['telefono']);
$email = strip_tags($_POST['email']);

// ELIMINAR ESPACIOS EN BLANCO AL PRINCIPIO Y FINAL DEL STRING
$telefono = trim($telefono);
$email = trim($email);

// COMPROBAR SI UN CORREO YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
include '../func/comprobar_correo.php';
comprobar_correo($conexion, $email);

if ($_POST['scope'] == 'alumnos') {
    // COMPROBACIONES DNI
    $dni = strip_tags($_POST['dni']);
    $dni = trim($dni);

    // COMPROBAR SI UN DNI YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
    include '../func/comprobar_dni.php';
    comprobar_dni($conexion, $dni);

    $clase = strip_tags($_POST['clase']);
    $sql = "INSERT INTO tbl_alumne (`dni_alu`, `nom_alu`, `cognoms_alu`, `telf_alu`, `email_alu`, `classe`) VALUES ('$dni', '$nombre', '$apellidos', '$telefono', '$email', $clase);";

} else {
    $password = sha1($_POST['password']);
    $dept = strip_tags($_POST['dept']);
    $sql = "INSERT INTO tbl_professor (`nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `contra`, `dept`, `admin`) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$password', $dept, 0);";
    echo $sql;
}

$insert = mysqli_query($conexion, $sql);

var_dump($insert);


