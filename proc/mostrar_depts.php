<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

$sql = "SELECT * FROM tbl_dept";
$depts = mysqli_query($conexion, $sql);

if (!isset($_GET['id'])) {
    echo "<option value=''>-- Dept --</option>";
    foreach ($depts as $dept) {
        echo "<option value='{$dept['id_dept']}'>{$dept['nom_dept']}</option>";
    }
} else {
    $id_dept = $_GET['id'];
    foreach ($depts as $dept) {
        $selected = $dept['id_dept'] == $id_dept ? "selected='selected'" : '';
        echo "<option value='{$dept['id_dept']}' $selected >{$dept['nom_dept']}</option>";
    }
}
