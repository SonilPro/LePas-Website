<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

define('_DEFVAR', 1);
require 'functions.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'index.php';
            </script>";
    die('Restricted Access');
}
$firstname;
$lastname;
$mail;
$phone;
$images;
if (isset($_POST['firstname'])) {
    $firstname = test_input($_POST['firstname']);
}
if (isset($_POST['lastname'])) {
    $lastname = test_input($_POST['lastname']);
}
if (isset($_POST['mail'])) {
    $mail = test_input($_POST['mail']);
}
if (isset($_POST['phone'])) {
    $phone = test_input($_POST['phone']);
}
if (isset($_FILES['images']['name'])) {
    $images = $_FILES['images']['name'];
    // for ($i = 0; $i < count($images); $i++) {
    //     move_uploaded_file($_FILES['images']['tmp_name'][$i], 'upload/' . $_FILES['images']['name'][$i]);
    // }
    $headers = implode("\r\n", [
        "MIME-Version: 1.0",
        "Content-type: text/html; charset=utf-8"
    ]);

    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: antonio.ereiz@gmail.com' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $image_contents = file_get_contents('img/newsImg.jpg');
    $type = pathinfo('img/newsImg.jpg', PATHINFO_EXTENSION);
    $image64 = 'data:image/' . $type . ';base64,' . base64_encode($image_contents);
    $mailBody = "<img src='$image64'/>";


    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = 4;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'd5b3a2d3ec1b7e';

    //Password to use for SMTP authentication
    $mail->Password = 'e1a97c83c65dff';

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom('lepastest@gmail.com', 'Random Name');

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    $mail->addReplyTo('antonio.ereiz90@gmail.com', 'Antonio2 Ereiz');

    //Set who the message is to be sent to
    $mail->addAddress('antonio.ereiz@gmail.com', 'Antonio Ereiz');

    //Set the subject line
    $mail->Subject = 'PHPMailer GMail SMTP test';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->Body = "This is a body";

    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    $mail->addAttachment('img/newsImg.jpg');

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}
