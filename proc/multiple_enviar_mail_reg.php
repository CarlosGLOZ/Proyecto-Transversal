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

sendMultipleMail($conexion, $asunto, $mensaje, $clase);
