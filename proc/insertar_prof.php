<?php

include './conexion.php';

//RECUPERAR DATOS
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$dept = $_POST['dept'];

$sql = "INSERT INTO tbl_professor (`nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `dept`) VALUES ('$nombre', '$apellidos', '$email', '$telefono', $dept);";
$insert = mysqli_query($conexion, $sql);

