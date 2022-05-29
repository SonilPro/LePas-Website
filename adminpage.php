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
    <div class="adminpage-wrapper">
        <aside class="adminpage-nav" id="adminpage-nav">
            <input type="checkbox" class="checkbox_toggle" id="checkbox_toggle1" autocomplete="off" />
            <label for="checkbox_toggle1" class="hamburger">
                <span></span>
            </label>
            <ul>
                <li><a href="#" class="button1" nmbr=1>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=2>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=3>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=4>Dodaj</a></li>
                <li><a href="#" class="button1" nmbr=5>Dodaj</a></li>
            </ul>
        </aside>
        <div id="content">
            <?php
            if (isset($_GET['id'])) {
                include_once("adminpagelayout.php");
                echo getLayout($_GET['id']);
            }
            ?>
            <div class="card list">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th class="avatar">Avatar</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>
                                <div>
                                    <a href="#"><img class="rounded-circle" src="img/newsImg.jpg" alt=""></a>
                                </div>
                            </td>
                            <td> #5469 </td>
                            <td> <span class="name">Louis Stanley</span> </td>
                            <td> <span class="product">iMax</span> </td>
                            <td><span class="count">231</span></td>
                            <td>
                                <span class="badge badge-complete">Complete</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <form id="form" action="#form" method="post">

                    <h3>Obrazac za dodavanje životinje</h3>
                    <table cellspacing="30px">
                        <tbody>
                            <tr>
                                <td><label>Ime:</label></td>
                                <td><input type="text" name="firstname" required maxlength="32" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Molimo upišite vaše ime')" /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Prezime:</label></td>
                                <td><input type="text" name="lastname" required maxlength="32" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Molimo upišite vaše prezime')" /><br /></td>
                            </tr>
                            <tr>
                                <td><label>E-mail:</label></td>
                                <td><input type="email" name="mail" id="mail" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Email je krivo upisan')" /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Telefon:</label></td>
                                <td><input type="tel" name="phone" id="phone" required /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Poruka:</label></td>
                                <td>
                                    <textarea cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="button" type="submit" name="submit" id="submit" value="Pošalji" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        $('#checkbox_toggle1').change(function() {
            if ($('#checkbox_toggle1').is(":checked")) {
                $('#adminpage-nav').addClass("visible");
            } else {
                $('#adminpage-nav').removeClass("visible");
            }
        });
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