<?php

include '../proc/validar_sesion.php';
val_sesion();

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


