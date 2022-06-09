<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vijesti | LePas</title>
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
    <section class="news-page-wrapper">
        <div class="main">
            <?php
            $title = "";
            $content = "";
            $mainImage = "";
            $inputTimestamp = "";
            $lastEdit = "";
            $articleexists = false;
            define('_DEFVAR', 1);
            include('db/connection.php');
            if (!$conn) {
                echo "<script language='javascript'>";
                echo "console.log(\"" . mysqli_connect_error() . "\");";
                echo "</script>";
            } else {
                $stmt = mysqli_prepare($conn, "SELECT * FROM articles WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", htmlspecialchars($_GET['id']));
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($article = mysqli_fetch_assoc($result)) {
                    $articleexists = true;
                    $title = $article['title'];
                    $content = $article['content'];
                    $files = array_diff(scandir($article['image']), array('.', '..'));
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
                            $mainImage .=  $article['image'] . $file;
                        }
                    }
                    $inputTimestamp = $article['inputTimestamp'];
                    $lastEdit = $article['lastEdit'];
                }
            }
            mysqli_close($conn);
            if ($articleexists) {
                echo "
                    
                    <h2>$title</h2>
                    <img src=" . $mainImage . ">
                    <pre>" . $content . "</pre>
                    <p class='date'>" . date("j.n.Y.", strtotime($inputTimestamp)) . "</p>
                ";
            }

            ?>

        </div>
    </section>
    <?php include('include/footer.php') ?>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
</body>

</html>