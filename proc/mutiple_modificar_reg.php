<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';


$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$alumnos = $_POST['ids'];

if ($_POST['scope'] == 'alumnos') {
    $dni = $_POST['dni'];
    $clase = $_POST['clase'];
    $scope = 'alu';
    $where = 'WHERE `id_alumne`';
    $sql = "UPDATE `tbl_alumne` SET ";
} else {
    $dept = $_POST['dept'];
    $scope = 'prof';
    $where = 'WHERE `id_professor`';
    $sql = "UPDATE `tbl_professor` SET ";
}

$updated = false;

if (!empty($nombre)) {
    $sql .= "`nom_$scope` = '$nombre'";
    $updated = true;
}

if ($_POST['scope'] == 'alumnos' && !empty($dni)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`dni_$scope` = '$dni'";
    $updated = true;
}

if (!empty($apellidos)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`cognoms_$scope` = '$apellidos'";
    $updated = true;
}

if (!empty($telefono)) {
    if ($updated) {
        $sql .= ', ';
    }
    if ($scope == 'alu') {
        $sql .= "`telf_$scope` = '$telefono'";
    } else {
        $sql .= "`telf` = '$telefono'";
    }
    $updated = true;
}

if (!empty($email)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`email_$scope` = '$email'";
    $updated = true;
}

if ($_POST['scope'] == 'alumnos' && !empty($clase)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`classe` = $clase";
}

if ($_POST['scope'] == 'profesores' && !empty($dept)) {
    if ($updated) {
        $sql .= ', ';
    }
    $sql .= "`dept` = $dept";
}


foreach ($alumnos as $id) {
    mysqli_query($conexion, "$sql $where = $id;");
}