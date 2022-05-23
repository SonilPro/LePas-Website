<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vijesti | LePas</title>
  <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <?php include('include/header.php'); ?>
  <aside>
    <div class="socials">
      <a href="https://www.facebook.com/lepas.udruga/" target="_blank" style="background-color: #4267B2;">
        <p>Posjetite nas na<br>Facebooku</p>
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="https://www.instagram.com/lepas_udruga/" target="_blank" style="background-color: #E4405F;">
        <p>Posjetite nas na <br>Instagramu</p>
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
    </div>
  </aside>
  <div class="header-title">
    <h1>Vijesti</h1>
  </div>
  <section class="news-wrapper">
    <div class="news">
      <?php
      define('_DEFVAR', 1);
      include('db/connection.php');
      if (!$conn) {
        echo "<script language='javascript'>";
        echo "console.log(\"" . mysqli_connect_error() . "\");";
        echo "</script>";
      } else {
        $result = mysqli_query($conn, "SELECT * FROM articles ORDER BY inputTimestamp DESC LIMIT 3");
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
          $row = mysqli_fetch_assoc($result);
          echo "
          <a class='news-block' href='newspage.php?id=" . $row["id"] . "'>
            <div class='block-wrapper'>
              <div class='image' style='background-image: url(" . $row["image"] . ");'></div>
              <div class='text'>
                <div class='date-wrapper'>
                  <p class='date'>" . date("j.n.Y.", strtotime($row["inputTimestamp"]))  . "</p>
              </div>
                <h3 class='title'>" . $row["title"] . "</h3>
                <p class='summary'>
                  " . $row["description"] . "
                </p>
              </div>
            </div>
          </a>
            ";
        }
        mysqli_close($conn);
      }
      ?>
    </div>
  </section>
  <?php include('include/footer.php') ?>
</body>

</html>