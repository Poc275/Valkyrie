<?php
ob_start();

use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// fields
$name = @trim(stripslashes($_POST['inputName']));
$from = @trim(stripslashes($_POST['inputEmail']));
$material = @trim(stripslashes($_POST['inputMaterial']));
$number = @trim(stripslashes($_POST['inputNumber']));
$details = @trim(stripslashes($_POST['inputDetails']));
$uploadedFileName = "";

// upload file to dropbox
if(isset($_FILES["inputModelFile"])) {
    $file = $_FILES['inputModelFile'];
    $app = new DropboxApp("985cddj05ciocbd", "61ueg40xnjkyybz", "9OVoG8FwHl8AAAAAAAAATuU85vO9S7Pn_vlhO-c7S4rrqlHxXbkHizHhCjWLGpVj");
    $dropbox = new Dropbox($app);

    try {
        $dropboxFile = new DropboxFile($file['tmp_name']);
        $uploadedFile = $dropbox->upload($dropboxFile, "/" . $file['name'], ['autorename' => true]);
        $uploadedFileName = $uploadedFile->getPathDisplay();
    } catch(DropboxClientException $e) {
        header('Location: contact-failure.html?error=' . $e->getMessage());
        die();
    }
}

// send email
// true enables exceptions
$mail = new PHPMailer(true);

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
    $mail->isHTML(true);
    $mail->Subject = 'Valkyrie Design 3D Printing Request';
    $mail->Body    = '<ul><li>Material: ' . $material . '</li><li>Required: ' . $number . '</li><li>Details: ' . 
                        $details . '</li><li>File: ' . $uploadedFileName . '</li></ul>';
    $mail->AltBody = "Material: " . $material . "\r\n" . "Required: " . $number . "\r\n" . "Details: " . $details . "\r\n" . 
                        "File: " . $uploadedFileName;

    $mail->send();

    header('Location: contact-success.html');
    die();

} catch (Exception $e) {
    header('Location: contact-failure.html?error=' . $e->errorMessage());
    die();
}
