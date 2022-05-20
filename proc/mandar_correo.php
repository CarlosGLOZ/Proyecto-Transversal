<?php
// CON MAIL() - SIN ATTACHMENTS

                // if (!empty($_POST['recipiente']) && !empty($_POST['asunto']) && !empty($_POST['mensaje'])) {
                //     // comentar esta línea para ver el posible error 
                //     error_reporting(E_ALL ^ E_WARNING); 
                    
                //     $exito = mail($_POST['recipiente'], $_POST['asunto'], $_POST['mensaje'], "From: richiSecretaria@gmail.com");

                //     if ($exito) {
                //         echo "EXITO";
                //     } else {
                //         echo "ERROR";
                //     }
                // }

// CON PHPMAILER - CON ATTACHMENTS

include '../proc/validar_sesion.php';
val_sesion();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';
// require 'vendor/autoload.php';

if (!empty($_POST['asunto']) && !empty($_POST['mensaje'])) {

    $asunto = $_POST['asunto'];
    $cuerpo = $_POST['mensaje'];
    // $recipiente = $_POST['recipiente'];

    $email = new PHPMailer(true);

    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->Port = 587;
    $email->SMTPSecure = 'tls';
    $email->SMTPAuth = true;
    $email->Username = 'richiSecretaria@gmail.com';
    $email->Password = 'ptescuela';

    
    $email->SetFrom('richiSecretaria@gmail.com'); //Name is optional
    $email->Subject=$asunto;
    $email->Body=$cuerpo;

    
    foreach ($_POST as $key => $item) {

        $keys = explode("-", $key);

        if ($keys[0] == 'correo') {
            // echo $item."<br>";
            $email->AddAddress( $item );
        }
    }

    // var_dump($_FILES['adjunto']['name']);

    if (!empty($_FILES['adjunto']['name'])) {
        // var_dump($_FILES['adjunto']);
        $localPath = "./archivos_temporales/";
        move_uploaded_file($_FILES['adjunto']["tmp_name"], $localPath.$_FILES['adjunto']["full_path"]);

        $fichero = $localPath.$_FILES['adjunto']['full_path'];
        // echo $fichero;
        $email->AddAttachment( $fichero );
        $email->Send();
        unlink($fichero);
    } else {
        $email->Send();
    }
}