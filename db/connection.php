<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('_DEFVAR')) {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'login.php';
            </script>";
    die('Restricted Access');
}
$servername = "localhost";
$dbname = "lepas";
$username = "root";
$password = "1234";

$conn = mysqli_connect($servername, $username, $password, $dbname);
