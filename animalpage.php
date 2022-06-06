<!DOCTYPE html>
<html lang="hr">
<?php
if (!isset($_GET['id'])) {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'index.php';
            </script>";
    die('Restricted Access');
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Posvoji | LePas</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
</head>

<body>
    <?php include('include/header.php'); ?>
    <aside>
        <div class="socials">
            <a href="https://www.facebook.com/lepas.udruga/" target="_blank" class="button" style="background-color: #4267B2;">
                <p>Posjetite nas na<br>Facebooku</p>
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="https://www.instagram.com/lepas_udruga/" target="_blank" class="button" style="background-color: #E4405F;">
                <p>Posjetite nas na <br>Instagramu</p>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
    </aside>
    <div class="header-title white">
        <div class="line reveal"></div>
        <div class="section-title">
            <h2>Udomi me</h2>
        </div>
    </div>
    <section class="animal-page-wrapper">
        <div class="main">
            <?php
            $name = "";
            $description = "";
            $age = "";
            $sex = "";
            $size = "";
            $arrivalDate = "";
            $mainImage = "";
            $breed = "";
            $animalexists = false;
            define('_DEFVAR', 1);
            include('db/connection.php');
            if (!$conn) {
                echo "<script language='javascript'>";
                echo "console.log(\"" . mysqli_connect_error() . "\");";
                echo "</script>";
            } else {
                $stmt = mysqli_prepare($conn, "SELECT * FROM animals JOIN
                                                    animal_sizes ON animals.size_id = animal_sizes.id
                                                WHERE animals.id = ?");
                mysqli_stmt_bind_param($stmt, "i", htmlspecialchars($_GET['id']));
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($animal = mysqli_fetch_assoc($result)) {
                    $animalexists = true;
                    $name = $animal['name'];
                    $description = $animal['description'];
                    $size = $animal['size'];
                    $age = $animal['age'];
                    $sex = $animal['sex'];
                    $arrivalDate = $animal['arrivalDate'];
                    $mainImage = $animal['mainImage'];
                    $breed = $animal['breed'];
                }
            }
            mysqli_close($conn);
            ?>
            <?php

            if ($animalexists) {
                $files = array_diff(scandir($mainImage), array('.', '..'));
                $image = "";
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
                        $image .=  $mainImage . $file;
                    }
                }
                echo "
                <div class='images'>
                    <div class='image' style='background-image: url($image);'></div>
                </div>
                <div class='description'>
                    <h2>" . $name . "</h2>
                    <pre>" . $description . "</pre>
                    <ul class='pet-details'>
                        <li><strong>Starost:</strong>" . $age . "godine</li>
                        <li><strong>Veličina:</strong>" . $size . "</li>
                        <li><strong>Pasmina:</strong>" . $breed . "</li>
                        <li><strong>Dana provedenih kod nas:</strong>" . floor((time() - strtotime($arrivalDate)) / 86400) . "</li>
                        <li><strong>Sex:</strong>" . $sex . "</li>
                    </ul>
                </div>
                ";
            } else {
                echo "
                    <h2 style='margin: 0 auto;'>No pet with id: " . htmlspecialchars($_GET['id']) . " found.</h2>
                ";
            }

            ?>


        </div>
    </section>
    <?php include('include/footer.php') ?>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
    <script src="js/reveal.js"></script>
</body>

</html>