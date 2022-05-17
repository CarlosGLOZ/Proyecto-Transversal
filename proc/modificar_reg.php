<?php

include '../proc/validar_sesion.php';
val_sesion();

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

