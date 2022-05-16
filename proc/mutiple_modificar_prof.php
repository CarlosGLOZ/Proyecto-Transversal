<?php

include './conexion.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$dept = $_POST['dept'];
$profesores = $_POST['ids'];

$sql = "UPDATE `tbl_professor` SET ";
$updated = false;

if (!empty($nombre)) {
    $sql .= "`nom_prof` = '$nombre'";
    $updated = true;
}

if (!empty($apellidos)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`cognoms_prof` = '$apellidos'";
    $updated = true;
}

if (!empty($telefono)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`telf` = '$telefono'";
    $updated = true;
}

if (!empty($email)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`email_prof` = '$email'";
    $updated = true;
}

if (!empty($dept)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`dept` = $dept";
}


foreach ($profesores as $id) {
    mysqli_query($conexion, $sql." WHERE `id_professor` = $id;");
}