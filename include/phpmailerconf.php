<?php
$lifetime = strtotime('+1 minutes', 0);
session_set_cookie_params($lifetime);
session_start();
if (!defined('_DEFVAR')) {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = '../index.php';
            </script>";
    die('Restricted Access');
}
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = '../index.php';
            </script>";
    die('Restricted Access');
}
if (isset($_SESSION['mail_delay'])) {
    die('Molim pričekajte prije slanja novog maila');
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

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
$mail->Username = 'lepastest@gmail.com';

//Password to use for SMTP authentication
$mail->Password = '';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('lepastest@gmail.com', 'LePas');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
//$mail->addReplyTo($mail, $firstname . $lastname);

//Set who the message is to be sent to
$mail->addAddress('antonio.ereiz@gmail.com', 'Antonio Ereiz');


$mail->IsHTML(true);
