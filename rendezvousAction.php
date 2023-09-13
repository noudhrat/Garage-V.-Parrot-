<?php

$nom = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['phone'];
$object = $_POST['object'];
$horaire = $_POST['schedule'];
$message = $_POST['message'];

$message = "Nom : ".$nom."\n"." Email : ".$email."\n"." Tel : ".$tel."\n"." Objet : ".$object."\n"." Horaire : ".$horaire."\n"." Message : ".$message;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'victorparrot25@gmail.com';                    
    $mail->Password   = 'hekabgnrebonkpbl';                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                

    $mail->setFrom('from@example.com', 'Garagevparrot');
    $mail->addAddress('victorparrot25@gmail.com');     



    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Rendez-vous';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'message envoyé';
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
}