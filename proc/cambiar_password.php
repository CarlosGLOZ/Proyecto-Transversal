<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

$id = $_POST['id'];
$password = sha1($_POST['password']);

$sql = "UPDATE `tbl_professor` SET `contra` = '$password' WHERE `id_professor` = $id";
mysqli_query($conexion, $sql);

