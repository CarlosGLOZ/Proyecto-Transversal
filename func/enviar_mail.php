<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';


function sendMail($asunto, $cuerpo, $correo) {
    $email = new PHPMailer(true);
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->Port = 587;
    $email->SMTPSecure = 'tls';
    $email->SMTPAuth = true;
    $email->Username = 'richiSecretaria@gmail.com';
    $email->Password = 'ptescuela';

    $email->isHTML(true);
    $email->CharSet = 'UTF-8';
    $email->SetFrom('richiSecretaria@gmail.com');
    $email->Subject=$asunto;
    $email->Body=$cuerpo;
    $email->AddAddress($correo);

    $email->Send();
}


function sendMultipleMail($conexion, $asunto, $cuerpo, $clase) {
    $email = new PHPMailer(true);
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->Port = 587;
    $email->SMTPSecure = 'tls';
    $email->SMTPAuth = true;
    $email->Username = 'richiSecretaria@gmail.com';
    $email->Password = 'ptescuela';

    $email->isHTML(true);
    $email->CharSet = 'UTF-8';
    $email->SetFrom('richiSecretaria@gmail.com');
    $email->Subject=$asunto;
    $email->Body=$cuerpo;

    $sql = "SELECT `email_alu` FROM tbl_alumne WHERE `classe` = $clase";
    $alumnos = mysqli_query($conexion, $sql);
    foreach ($alumnos as $alumno) {
        $email->AddAddress($alumno['email_alu']);
    }

    $email->Send();
}


