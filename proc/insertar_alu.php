<?php

include './conexion.php';

//RECUPERAR DATOS
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$clase = $_POST['clase'];

$sql = "INSERT INTO tbl_alumne (`dni_alu`, `nom_alu`, `cognoms_alu`, `telf_alu`, `email_alu`, `classe`) VALUES ('$dni', '$nombre', '$apellidos', '$telefono', '$email', $clase);";
$insert = mysqli_query($conexion, $sql);

