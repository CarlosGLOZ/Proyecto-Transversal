<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';


if (!isset($_POST['asunto']) || !isset($_POST['asunto']) || !isset($_POST['asunto'])) {
    die();
}

if (empty($_POST['asunto']) || empty($_POST['asunto']) || empty($_POST['asunto'])) {
    die();
}

include '../proc/conexion.php';
include '../func/enviar_mail.php';

$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$clase = $_POST['clase'];

// test
echo $asunto."<br>";
echo $mensaje."<br>";
echo isset($_FILES['adjunto'])."<br>";
echo var_dump($_FILES['adjunto']);
// /test

if (isset($_FILES['adjunto'])) {
    $adjunto = $_FILES['adjunto']; // adjunto no se está recogiendo bien, probar con POST

    $localPath = "../proc/archivos_temporales/";
    move_uploaded_file($adjunto["tmp_name"], $localPath.$adjunto["name"]);
    
    $fichero = $localPath.$adjunto['name'];
    sendMultipleMail($conexion, $asunto, $mensaje, $clase, $fichero);
} else {
    sendMultipleMail($conexion, $asunto, $mensaje, $clase);
}

sendMultipleMail($conexion, $asunto, $mensaje, $clase);
