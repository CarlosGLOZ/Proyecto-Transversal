<?php

include './conexion.php';

$sql = "DELETE FROM tbl_alumne WHERE id_alumne={$_GET['id']}";
$listadodept = mysqli_query($conexion, $sql);
