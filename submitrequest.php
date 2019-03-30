<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// true enables exceptions
$mail = new PHPMailer(true);

// fields
$name = @trim(stripslashes($_POST['inputName']));
$from = @trim(stripslashes($_POST['inputEmail']));
$message = @trim(stripslashes($_POST['inputMessage']));

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host = 'mail179.extendcp.co.uk';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'enquiries@valkyrie-design.co.uk';      // SMTP username
    $mail->Password   = 'D.M.xrKNU';                            // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('enquiries@valkyrie-design.co.uk', $name);
    $mail->addAddress('enquiries@valkyrie-design.co.uk', 'Valkyrie Design');     // Add a recipient
    $mail->addReplyTo($from, $name);

    // Content
    $mail->isHTML(true);                            // Set email format to HTML
    $mail->Subject = 'Valkyrie Design Enquiry';
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();

    header('Location: contact-success.html');
    die();

} catch (Exception $e) {
    header('Location: contact-failure.html?error=' . $e->errorMessage());
    die();
}