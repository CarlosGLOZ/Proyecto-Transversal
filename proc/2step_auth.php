<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';
// require 'vendor/autoload.php';

function genAuthCode(int $length) {
    if ($length < 2) {
        return false;
    } else {
        $chars = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','0'];
        $code_chars = [];
        for ($i=0; $i < $length; $i++) { 
            $code_chars[$i] = $chars[rand(0,count($chars)-1)];
        }
        $code = implode($code_chars);
        return $code;
    }
}


function twostep_auth($user) {

    session_start();
    $_SESSION['codigo_auth'] = genAuthCode(8);
    $asunto = 'AUTENTICACIÓN EN DOS PASOS';
    $cuerpo = '<div style="text-align: center;"><h3>TU CÓDIGO DE AUTENTICACIÓN EN DOS PASOS ES<h3> <h1><b>'.$_SESSION['codigo_auth'].'</b></h1></div>';

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

    $email->AddAddress($user);

    $email->Send();

    return $codigo;
}

