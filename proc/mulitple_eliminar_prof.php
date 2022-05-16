<?php

include './conexion.php';

$profesores = $_POST['ids'];

foreach ($profesores as $id) {
    $sql = "DELETE FROM tbl_professor WHERE `id_professor` = $id";
    mysqli_query($conexion, $sql);
}

