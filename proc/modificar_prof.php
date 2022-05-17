<?php

include './conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$dept = $_POST['dept'];

$sql = "UPDATE `tbl_professor` SET `nom_prof` = '$nombre', `cognoms_prof` = '$apellidos', `telf` = '$telefono', `email_prof` = '$email', `dept` = '$dept' WHERE `id_professor` = $id";
mysqli_query($conexion, $sql);

