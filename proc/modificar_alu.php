<?php

include './conexion.php';

$id = $_POST['id'];
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$clase = $_POST['clase'];

$sql = "UPDATE `tbl_alumne` SET `dni_alu` = '$dni', `nom_alu` = '$nombre', `cognoms_alu` = '$apellidos', `telf_alu` = '$telefono', `email_alu` = '$email', `classe` = '$clase' WHERE `id_alumne` = $id";
mysqli_query($conexion, $sql);

