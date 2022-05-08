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
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css" />
</head>


<body>
    <?php include('include/header.php'); ?>
    <div class="login-wrapper">
        <form action="" method="post">
            <div class="login-box">
                <h1>Login</h1>

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
        $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $users = $stmt->fetchAll();

        foreach ($users as $user) {
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
        echo "<script language='javascript'>";
        echo "alert('KRIVO IME ILI LOZINKA');";
        echo "</script>";
    }
    ?>

</body>

</html>