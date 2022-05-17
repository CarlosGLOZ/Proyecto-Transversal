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
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require './PHPMailer/src/phpmailer.php';
// require 'vendor/autoload.php';

if (!empty($_POST['recipiente']) && !empty($_POST['asunto']) && !empty($_POST['mensaje'])) {

    $asunto = $_POST['asunto'];
    $cuerpo = $_POST['mensaje'];
    $recipiente = $_POST['recipiente'];

    $email = new PHPMailer(true);

    
    $email->SetFrom('richiSecretaria@gmail.com'); //Name is optional
    $email->Subject='holi';
    $email->Body='cuerpo';
    $email->AddAddress( 'cgiraldolozano@gmail.com' );
    // var_dump($email);

    if (!empty($_FILES['adjunto'])) {
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