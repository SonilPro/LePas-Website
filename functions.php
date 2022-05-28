<?php
if (!defined('_DEFVAR')) {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'index.php';
            </script>";
    die('Restricted Access');
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
