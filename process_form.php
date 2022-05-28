<?php
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
    if (mail("antonio.ereiz@gmail.com", "Test", $mailBody, $headers)) {
    } else {
        echo "NO";
    }
}
