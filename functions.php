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
function recurseRmdir($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file") && !is_link("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir("$dir");
}
