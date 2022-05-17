<?php

include './conexion.php';

//RECUPERAR DATOS
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = sha1($_POST['password']);
$dept = $_POST['dept'];

$sql = "INSERT INTO tbl_professor (`nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `contra`, `dept`) VALUES ('$nombre', '$apellidos', '$email', '$telefono', '$password', $dept);";
$insert = mysqli_query($conexion, $sql);

