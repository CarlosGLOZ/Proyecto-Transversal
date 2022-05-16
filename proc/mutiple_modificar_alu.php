<?php

include './conexion.php';

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$clase = $_POST['clase'];
$alumnos = $_POST['alumnos'];

$sql = "UPDATE `tbl_alumne` SET ";
$updated = false;

if (!empty($nombre)) {
    $sql .= "`nom_alu` = '$nombre'";
    $updated = true;
}

if (!empty($dni)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`dni_alu` = '$dni'";
    $updated = true;
}

if (!empty($apellidos)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`cognoms_alu` = '$apellidos'";
    $updated = true;
}

if (!empty($telefono)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`telf_alu` = '$telefono'";
    $updated = true;
}

if (!empty($email)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`email_alu` = '$email'";
    $updated = true;
}

if (!empty($clase)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`classe` = $clase";
}


foreach ($alumnos as $id) {
    mysqli_query($conexion, $sql." WHERE `id_alumne` = $id;");
}