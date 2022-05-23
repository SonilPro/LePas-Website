<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Posvoji | LePas</title>
  <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
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
    <h1>Galerija</h1>
  </div>
  <section class="gallery-wrapper">
    <div class="gallery">
      <div class="cards">
        <?php
        define('_DEFVAR', 1);
        include('db/connection.php');
        if (!$conn) {
          echo "<script language='javascript'>";
          echo "console.log(\"" . mysqli_connect_error() . "\");";
          echo "</script>";
        } else {
          $result = mysqli_query($conn, "SELECT * FROM animals ORDER BY inputTimestamp DESC");
          for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            echo "
            <div class='card' style='background-image: url(" . $row["mainImage"] . ")'>
              <a href='animalpage.php?id=" . $row["id"] . "'>
                <div class='description'>
                  <h3>" . $row["name"] . "</h3>
                </div>
              </a>
            </div>
            ";
          }
          mysqli_close($conn);
        }
        ?>
      </div>
    </div>
  </section>
  <?php include('include/footer.php') ?>
</body>

</html>