<?php
define('_DEFVAR', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = json_decode(file_get_contents("php://input"));
    $result = "";
    if ($json->layout) {
        $result = "";
        include_once("adminpagelayout.php");
        $result = getLayout(
            $json->id,
            (isset($json->sort)) ?  $json->sort : "inputTimestamp",
            (isset($json->order)) ?  $json->order : "ASC"
        );
        echo json_encode($result);
        die();
    } else if ($json->edit) {
        include_once("adminpagelayout.php");
        $result = getObject($json->id, $json->edit);
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

<body style="background-color: #e7f1f5;">
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
            <div class='card list'>
                <?php
                if (isset($_GET['id'])) {
                    include_once("adminpagelayout.php");
                    echo getLayout($_GET['id'], "name", "DESC");
                } else {
                    include_once("adminpagelayout.php");
                    echo getLayout(1, "name", "DESC");
                }
                ?>
            </div>
            <div class="card form">

            </div>
        </div>
    </div>
    <script type=" text/javascript" src="js/jquery.js"></script>
    <script>
        $('#checkbox_toggle1').change(function() {
            if ($('#checkbox_toggle1').is(":checked")) {
                $('#adminpage-nav').addClass("visible");
            } else {
                $('#adminpage-nav').removeClass("visible");
            }
        });
        $(document).ready(function() {
            //NAVIGATION
            $('.button1').click(function() {
                var clickBtnValue = $(this).attr('nmbr');
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: clickBtnValue,
                        layout: 1,
                        edit: 0
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        window.history.pushState("object or string", "Title", window.location.href.substr(0, window.location.href.strlen - 1) + "?id=" + clickBtnValue);
                        $('.list').html(response);
                    },
                    dataType: "json",
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            //GET FORM
            $('#content').on('click', 'a.button2', function() {
                var clickBtnValue = $(this).attr('nmbr');
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: clickBtnValue,
                        layout: 0,
                        edit: 1
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('.form').html(response);
                        window.history.pushState("object or string", "Title", window.location.href.substr(0, window.location.href.strlen - 1) + "?objectId=" + clickBtnValue);
                    },
                    dataType: "json",
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            //SORTING
            $('#content').on('click', 'a.sort', function() {
                var clickBtnValue = $(this).attr('column');
                var order = $(this).attr('order');
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: 1,
                        layout: 1,
                        edit: 0,
                        sort: clickBtnValue,
                        order: order
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('.list').html(response);
                        $("a[column='" + clickBtnValue + "']").attr('order', (order == 'DESC') ? 'ASC' : 'DESC');
                        var others = $(".sort i").each(function() {
                            $(this).addClass("fas fa-sort");
                        });
                        var sort_icon = (order == 'DESC') ? '-up' : '-down';
                        $("a[column='" + clickBtnValue + "'] i").addClass("fas fa-sort" + sort_icon);
                    },
                    dataType: "json",
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            //FORM SUBMIT
            $("#content").on("submit", 'form', function(event) {
                event.preventDefault();
                var formdata = new FormData(this);
                jQuery.ajax({
                    url: "forms/add_animal_form.php",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        document.getElementsByTagName("form")[0].style.display = "none";
                        document.getElementById("conf-msg").style.display = "unset";
                        jQuery('#conf-msg').html(res);
                    }
                });
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
</body>

</html>