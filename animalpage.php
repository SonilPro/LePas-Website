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
            $images = "";
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
                    $images = $animal['images'];
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
                $files = array_diff(scandir($images), array('.', '..'));
                echo "
                <div class='images'>
                    <nav class='gallery-nav'>
                    <a class='' href='' style='background-image: url($image);' data-image='$image'></a>";

                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION)) {
                        echo "<a class='' href='' style='background-image: url(" . $images .  $file . ");' data-image='" . $images . $file . "'></a>";
                    }
                }
                echo "</nav>
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
        <h4>KAKO UDOMITI PSA ILI MACU?</h4>
        <div class="adopt">
            <div class="text">
                <p>Kao prvi korak u našem procesu zamolit ćemo vas da što detaljnije ispunite naš upitnik za potencijalne udomitelje.</p>
                <p>Nakon što ga ispunite, naši volonteri javljaju se kroz par dana kako bismo telefonski prošli sve detalje upitnika, informacije o psu te naravno, da odgovorimo na sva vaša potencijalna pitanja. </p>
                <p>Ukoliko se usuglasimo, njuškicu prije udomljavanja možete doći i upoznati.</p>
                <p>Svakako je važno da osobno dođete po životinju koju udomljavate popto se prilikom preuzimanja potpisuje ugovor o udomljavanju te sa psom/macom dobivate i sve prateće dokumente.
                    Kada naš štićenik postane novi član vaše obitelji, kreće proces prilagodbe tijekom kojeg smo također tu za vas kako bismo vam našim savjetom pomogli prebroditi inicijalne izazove do kojih može doći.</p>
            </div>
            <form id="form" action="#form" method="post">
                <h3>Obrazac za privremeni smještaj</h3>
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
                            <td><label>Slika/slike smještaja:</label></td>
                            <td class="file-upload">
                                <input type="button" id="click-input" value="Dodaj slike" onclick="document.getElementById('file').click();" />
                                <label for="click-input" id="info" style="height: 10px;"></label>
                                <input type="file" style="display:none;" id="file" name="images[]" accept="image/*" enctype="multipart/form-data" multiple required>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Poruka:</label></td>
                            <td>
                                <textarea name="message" cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="button" type="submit" name="submit" id="submit" value="Pošalji" /></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        </div>
    </section>
    <?php include('include/footer.php') ?>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
    <script src="js/reveal.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.images .gallery-nav a').on('click', function(ele) {
                ele.preventDefault();
                var imageUrl = $(this).attr('data-image');
                $('.images .image').css('background-image', "url(" + imageUrl + ")");
                $('.images .gallery-nav a').each(function(e) {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
            });
        });
    </script>
</body>

</html>