<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';

include './conexion.php';


/* VALIDACIONES COMUNES VARIABLES SETEADAS */
if (!isset($_POST['scope']) || !isset($_POST['id']) || !isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['telefono']) || !isset($_POST['email'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES COMUNES VARIABLES VACIAS */
if (empty($_POST['scope']) || empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['telefono']) || empty($_POST['email'])) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES ALUMNOS */
if ($_POST['scope'] == 'alumnos' && (!isset($_POST['dni']) || empty($_POST['dni']) || !isset($_POST['clase']) || empty($_POST['clase']))) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

/* VALIDACIONES PROFESORES */
if ($_POST['scope'] == 'profesores' && (!isset($_POST['dept']) || empty($_POST['dept']) )) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

// RECUPERAR DATOS Y EVITAR INJECCIONES JS / HTML
$id = strip_tags($_POST['id']);
$nombre = strip_tags($_POST['nombre']);
$apellidos = strip_tags($_POST['apellidos']);
$telefono = strip_tags($_POST['telefono']);
$email = strip_tags($_POST['email']);

// ELIMINAR ESPACIOS EN BLANCO AL PRINCIPIO Y FINAL DEL STRING
$telefono = trim($telefono);
$email = trim($email);

// COMPROBAR SI UN CORREO YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
include '../func/comprobar_correo.php';
comprobar_correo($conexion, $email, $id, $_POST['scope']);

if ($_POST['scope'] == 'alumnos') {
    // COMPROBACIONES DNI
    $dni = strip_tags($_POST['dni']);
    $dni = trim($dni);

    // COMPROBAR SI UN DNI YA HA SIDO INTRODUCIDO EN LA BASE DE DATOS
    include '../func/comprobar_dni.php';
    comprobar_dni($conexion, $dni, $id);
    
    $clase = strip_tags($_POST['clase']);
    $sql = "UPDATE `tbl_alumne` SET `dni_alu` = '$dni', `nom_alu` = '$nombre', `cognoms_alu` = '$apellidos', `telf_alu` = '$telefono', `email_alu` = '$email', `classe` = '$clase' WHERE `id_alumne` = $id";
    
} else {
    $dept = strip_tags($_POST['dept']);
    $sql = "UPDATE `tbl_professor` SET `nom_prof` = '$nombre', `cognoms_prof` = '$apellidos', `telf` = '$telefono', `email_prof` = '$email', `dept` = '$dept' WHERE `id_professor` = $id";

    if ($id == $_SESSION['id_professor']) {
        echo "$nombre";
    }
}

mysqli_query($conexion, $sql);
