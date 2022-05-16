<?php

include './conexion.php';



$sql = "SELECT * FROM tbl_classe";
$clases = mysqli_query($conexion, $sql);

echo "<option value=''>-- Clase --</option>";
if (!isset($_GET['id'])) {
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
