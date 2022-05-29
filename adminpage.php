<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = json_decode(file_get_contents("php://input"));
    if ($json->ajax) {
        $result = "";
        include_once("adminpagelayout.php");
        $result = getLayout($json->id);
        echo json_encode($result);
        die();
    }
}

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
    <div class="adminpage-nav">
        <div>
            <ul>
                <li><a href="#" class="button1" nmbr=1>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=2>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=3>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=4>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=5>Dodaj</a></li>
            </ul>
        </div>
    </div>
    <div id="content">
        <?php
        if (isset($_GET['id'])) {
            include_once("adminpagelayout.php");
            echo getLayout($_GET['id']);
        }
        ?>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('.button1').click(function() {
                var clickBtnValue = $(this).attr('nmbr');
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: clickBtnValue,
                        ajax: 1
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        window.history.pushState("object or string", "Title", window.location.href.substr(0, window.location.href.strlen - 1) + "?id=" + clickBtnValue);
                        console.log(response["id"]);
                        document.getElementById("content").innerHTML = response;
                    },
                    dataType: "json"
                    //window.location.replace("login.php");
                });
            });
        });
    </script>
</body>

</html>