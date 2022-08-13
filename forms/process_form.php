<?php
define('_DEFVAR', 1);
require '../functions.php';
require '../include/phpmailerconf.php';

$firstname = "";
$lastname = "";
$email = "";
$phone = "";
$images = "";
$message = "";
if (isset($_POST['firstname'])) {
    $firstname = htmlspecialchars(test_input($_POST['firstname']));
}
if (isset($_POST['lastname'])) {
    $lastname = htmlspecialchars(test_input($_POST['lastname']));
}
if (isset($_POST['mail'])) {
    $email = htmlspecialchars(test_input($_POST['mail']));
}
if (isset($_POST['phone'])) {
    $phone = htmlspecialchars(test_input($_POST['phone']));
}
if (isset($_POST['message'])) {
    $message = htmlspecialchars(test_input($_POST['message']));
}
if (isset($_FILES['images']['name'])) {
    $images = $_FILES['images']['name'];

    $mail->Subject = "Volontiranje";

    //Replace the plain text body with one created manually
    $mail->AltBody = "$firstname $lastname $email $phone $message";
    $mail->Body = "
        $firstname $lastname<br/>
        $email<br/>
        $phone<br/>
        <pre>$message</pre><br/>
    ";

    //Attach an image file
    for ($i = 0; $i < count($images); $i++) {
        $mail->addAttachment($_FILES['images']['tmp_name'][$i], $_FILES['images']['name'][$i]);
    }

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $_SESSION['mail_delay'] = "30";
        echo 'Message sent!';
    }
} else {
    $mail->Subject = "Kontakt";

    $mail->Body = "
        $firstname $lastname<br/>
        $email<br/>
        $phone<br/>
        <pre>$message</pre><br/>
    ";

    //Replace the plain text body with one created manually
    $mail->AltBody = $firstname . " " . $lastname . " "  . $message;

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        $_SESSION['mail_delay'] = "30";
    }
}
