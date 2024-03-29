<?php
define('_DEFVAR', 1);
require '../functions.php';
require '../include/phpmailerconf.php';

$firstname = "";
$lastname = "";
$email = "";
$phone = "";
$animalName = "";
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
if (isset($_POST['animalName'])) {
    $animalName = htmlspecialchars(test_input($_POST['animalName']));

    $mail->Subject = "Udomljivanje";

    //Replace the plain text body with one created manually
    $mail->AltBody = "$firstname $lastname $email $phone $message";
    $mail->Body = "
        $firstname $lastname<br/>
        $email<br/>
        $phone<br/>
        <pre>$message</pre><br/>
    ";

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}
