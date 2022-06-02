<?php
define('_DEFVAR', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = json_decode(file_get_contents("php://input"));
    $result = "";
    if (isset($json->layout)) {
        $result = "";
        include_once("adminpagelayout.php");
        $result = getLayout(
            $json->id,
            (isset($json->sort)) ?  $json->sort : "inputTimestamp",
            (isset($json->order)) ?  $json->order : "ASC",
            (isset($json->page)) ?  $json->page : "1"
        );
        echo json_encode($result);
        die();
    } else if (isset($json->edit)) {
        include_once("adminpagelayout.php");
        $result = getObject($json->id, $json->edit);
        echo json_encode($result);
        die();
    } else if (isset($json->objectId)) { //DELETE
        include_once("functions/database.php");
        $result = deleteObject($json->objectId, $json->layoutId);
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

<body style="background-color: #e7f1f5; width: 100vw;">
    <?php include('include/header.php'); ?>
    <div class="adminpage-wrapper" id="all">
        <aside class="adminpage-nav" id="adminpage-nav">
            <input type="checkbox" class="checkbox_toggle" id="checkbox_toggle1" autocomplete="off" />
            <label for="checkbox_toggle1" class="hamburger">
                <span></span>
            </label>
            <ul>
                <li><a href="#" class="button1" nmbr=1>Životinje</a></li>
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
                    echo getLayout($_GET['id'], "inputTimestamp", "ASC", (isset($_GET['page']) != true) ? 1 : $_GET['page']);
                } else {
                    include_once("adminpagelayout.php");
                    echo getLayout(1, "inputTimestamp", "ASC", 1);
                }
                ?>
            </div>
            <div class="card form">
                <?php
                include_once("adminpagelayout.php");
                echo getObject('new', 1);
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script>
        var backLen = 1;
        var get = location.search.substr(1).split("&").reduce((o, i) => (u = decodeURIComponent, [k, v] = i.split("="), o[u(k)] = v && u(v), o), {});
        var layout = (get.id != undefined) ? get.id : 1;
        var formChange = false;
        $(".button1[nmbr=" + layout + "]:not([page])").css("color", "#e4405f");
        $('#checkbox_toggle1').change(function() {
            if ($('#checkbox_toggle1').is(":checked")) {
                $('#adminpage-nav').addClass("visible");
            } else {
                $('#adminpage-nav').removeClass("visible");
            }
        });
        $(document).ready(function() {
            //GET LAYOUT
            $('#all').on('click', 'a.button1', function(event) {
                if (formChange && !$(this).attr('page')) {
                    if (!confirm("Imate nespremljene podatke. Želite li izaći?")) {
                        return;
                    }
                    formChange = false;
                }
                if (!$(this).attr('page')) {
                    $('.adminpage-nav .button1').css("color", "unset");
                    $(this).css("color", "#e4405f")
                };
                var clickBtnValue = $(this).attr('nmbr');
                var pageValue = $(this).attr('page') == null ? 1 : $(this).attr('page');
                layout = clickBtnValue;
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: clickBtnValue,
                        layout: 1,
                        edit: 0,
                        page: pageValue
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        const params = new URLSearchParams(window.location.search);
                        params.set("id", clickBtnValue);
                        params.set("pageNmbr", pageValue);
                        params.delete("objectId");
                        params.delete("editId");

                        history.go(-backLen);
                        setTimeout(function() {
                            if (backLen < 2) {
                                backLen++;
                            }
                            window.history.pushState({}, "", decodeURIComponent(`${window.location.pathname}?${params}`));
                        }, 100);

                        $('.list').html(response);
                    },
                    dataType: "json",
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            //GET FORM
            $('#content').on('click', 'a.button2', function(event) {
                if (formChange) {
                    if (!confirm("Imate nespremljene podatke. Želite li izaći?")) {
                        return;
                    }
                    formChange = false;
                }
                var clickBtnValue = $(this).attr('nmbr');
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: clickBtnValue,
                        edit: 1
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('.form').html(response);
                        document.querySelector('#form').scrollIntoView({
                            behavior: 'smooth'
                        });
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
                window.$_GET = location.search.substr(1).split("&").reduce((o, i) => (u = decodeURIComponent, [k, v] = i.split("="), o[u(k)] = v && u(v), o), {});
                var ajaxurl = 'adminpage.php',
                    data = {
                        id: 1,
                        layout: 1,
                        edit: 0,
                        sort: clickBtnValue,
                        order: order,
                        page: $_GET.pageNmbr
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
                $(":disabled").prop("disabled", false);
                event.preventDefault();
                var formdata = new FormData(this);
                jQuery.ajax({
                    url: "forms/process_animal_form.php",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        document.getElementsByTagName("form")[0].style.display = "none";
                        document.getElementById("conf-msg").style.display = "unset";
                        jQuery('#conf-msg').html(res);
                        $('.button1')[0].click();
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            //DELETE
            $('#content').on('click', 'a.delete', function() {
                if (!confirm("Želite li stvarno obrisati")) {
                    return;
                }
                var objectId = $(this).attr('id');
                var ajaxurl = 'adminpage.php',
                    data = {
                        objectId: objectId,
                        layoutId: layout
                    };
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('.button1')[0].click();
                        console.log(response);
                    },
                    dataType: "json",
                    error: function(result) {
                        console.log(result);
                    }
                });
            });
            $('#content').on('change', '#form table', function() {
                formChange = true;
            });
            window.addEventListener("beforeunload", function(e) {
                if (!formChange) {
                    return undefined;
                }
                var confirmationMessage = 'It looks like you have been editing something. ' +
                    'If you leave before saving, your changes will be lost.';

                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
</body>

</html>