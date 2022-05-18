<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

if (!isset($_POST['ids']) || empty($_POST['ids']) || !isset($_POST['scope']) || empty($_POST['scope']) ) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}

// RECUPERAR DATOS Y EVITAR INJECCIONES JS / HTML
$nombre = strip_tags($_POST['nombre']);
$apellidos = strip_tags($_POST['apellidos']);
$telefono = strip_tags($_POST['telefono']);
$email = strip_tags($_POST['email']);
$registros = $_POST['ids'];

if ($_POST['scope'] == 'alumnos') {
    $dni = strip_tags($_POST['dni']);
    $clase = strip_tags($_POST['clase']);
    $scope = 'alu';
    $where = 'WHERE `id_alumne`';
    $sql = "UPDATE `tbl_alumne` SET ";
} else {
    $dept = strip_tags($_POST['dept']);
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


foreach ($registros as $id) {
    mysqli_query($conexion, "$sql $where = $id;");
}