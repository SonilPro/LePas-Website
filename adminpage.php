<?php
session_start();
if (isset($_SESSION['userType'])) {
    if ($_SESSION['userType'] != 'admin') {
        echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'login.php';
            </script>";
        die();
    }
} else {
    echo "<script>
            alert('ZABRANJEN PRISTUP');
            window.location.href = 'login.php';
        </script>";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | LePas</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
</head>

<body>
    <?php include('include/header.php'); ?>
    <h2>Hello Admin</h2>
    <button class="button"> Click </button>
    <div class="result"> </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('.button').click(function() {
                var clickBtnValue = $(this).val();
                var ajaxurl = 'functions/logout.php',
                    data = {
                        action: "logout"
                    };
                console.log(data);
                $.post(ajaxurl, data, function(response) {
                    // Response div goes here.
                    window.location.replace("login.php")
                });
            });
        });
    </script>
</body>

</html>