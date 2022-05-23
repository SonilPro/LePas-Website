<?php
session_start();

if (isset($_SESSION['userType'])) {
    if ($_SESSION['userType'] != 'admin') {
        header("Location: index.php");
        die();
    } else {
        header("Location: adminpage.php");
        die();
    }
}
define('_DEFVAR', 1);
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LePas</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
</head>


<body>
    <?php include('include/header.php'); ?>
    <div class="login-wrapper">
        <form action="" method="post">
            <div class="login-box">
                <h2>Login</h2>

                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="Ime" name="name" value="">
                </div>

                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Lozinka" name="password" value="">
                </div>
                <br />
                <input class="button" type="submit" name="login" value="Sign In">
            </div>
        </form>
    </div>

    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        include_once('db/connection.php');
        $name = test_input($_POST["name"]);
        $password = test_input($_POST["password"]);
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE name = ?");
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                if ($user['isAdmin'] != null) {
                    $_SESSION['userType'] = "admin";
                    header("Location: adminpage.php");
                } else {
                    header("Location: index.php");
                }
                die();
            }
        }
        mysqli_close($conn);
        echo "<script language='javascript'>";
        echo "alert('KRIVO IME ILI LOZINKA');";
        echo "</script>";
    }
    ?>

</body>

</html>