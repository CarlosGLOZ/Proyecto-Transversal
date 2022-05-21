<?php

include '../proc/validar_sesion.php';
val_sesion();

include '../func/comprobar_admin.php';

include '../func/enviar_mail.php';

$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$email = $_POST['email'];

sendMail($asunto, $mensaje, $email);