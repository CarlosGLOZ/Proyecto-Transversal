<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

$sql = "SELECT * FROM tbl_classe";
$clases = mysqli_query($conexion, $sql);

if (!isset($_GET['id'])) {
    echo "<option value=''>-- Clase --</option>";
    foreach ($clases as $clase) {
        echo "<option value='{$clase['id_classe']}'>{$clase['codi_classe']}</option>";
    }
} else {
    $id_clase = $_GET['id'];
    foreach ($clases as $clase) {
        $selected = $clase['id_classe'] == $id_clase ? "selected='selected'" : '';
        echo "<option value='{$clase['id_classe']}' $selected >{$clase['codi_classe']}</option>";
    }
}
