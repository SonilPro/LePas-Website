<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LePas - udruga za dobrobit i zaštitu životinja</title>
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
  <div class="imageHeader" id="imageHeader1">
    <h1>LePas</h1>
    <p>Udruga za dobrobit i zaštitu životinja</p>
  </div>
  <hr>
  <div class="options-wrapper">
    <div class="section-title">
      <div class="line reveal"></div>
      <h2>Kako možeš pomoći</h2>
    </div>
    <div class="options">
      <div class="option" style="
            background-image: url(img/option_adopt.jpg);
          ">
        <span class="icon">
          <i class="fas fa-paw fa-3x fa-inverse" aria-hidden="true"></i>
        </span>
        <h3>POSVOJI</h3>
        <p>Svaki novi dom je dobrodošao!</p>
        <a class="button" href="#">POSVOJI</a>
      </div>
      <div class="option" style="
            background-image: url(img/option_donate.jpg);
          ">
        <span class="icon">
          <i class="fas fa-hand-holding-medical fa-3x fa-inverse" aria-hidden="true"></i>
        </span>
        <h3>DONIRAJ</h3>
        <p>Stvorimo bolji svijet za životinje</p>
        <a class="button" href="donation.php">DONIRAJ</a>
      </div>
      <div class="option" style="
            background-image: url(img/option_volounteer.jpg);
          ">
        <span class="icon">
          <i class="fas  fa-hand-paper fa-3x fa-inverse" aria-hidden="true" style="position: relative; right:2px"></i>
        </span>
        <h3>VOLONTIRAJ</h3>
        <p>Pomozi našim njuškicama</p>
        <a class="button" href="volounteer.php">VOLONTIRAJ</a>
      </div>
    </div>
  </div>
  <hr>
  <?php
  define('_DEFVAR', 1);
  include('db/connection.php');
  if (!$conn) {
    echo "<script language='javascript'>";
    echo "console.log(\"" . mysqli_connect_error() . "\");";
    echo "</script>";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM animals ORDER BY inputTimestamp DESC LIMIT 3");
    if (mysqli_num_rows($result) > 0) {
      echo "
            <section class='gallery-wrapper'>
            <div class='section-title'>
              <div class='line reveal'></div>
              <h2>Novi članovi</h2>
            </div>
            <div class='gallery'>
              <div class='cards'>
            ";
      for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_assoc($result);
        $files = array_diff(scandir($row['mainImage']), array('.', '..'));
        $mainImage = "";
        foreach ($files as $file) {
          if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
            $mainImage .=  $row['mainImage'] . $file;
          }
        }
        echo "
              <div class='card' style='background-image: " . (empty($mainImage) ? "" : "url(" . $mainImage . ")") . "'>
                <a href='animalpage.php?id=" . $row["id"] . "'>
                  <div class='description'>
                      <h3>" . $row["name"] . "</h3>
                  </div>
                </a>
              </div>
             ";
      }
      echo "
        </div>
        </div>
      </section>
      ";
    }

    mysqli_close($conn);
  }
  ?>
  <section class="achievement-wrapper">
    <div class="achievement">
      <div>
        <h2 class="count" data-number="200">0</h2>
        <p>Ukupno udomljenih životinja</p>
        <i class="fas  fa-bone fa-5x fa-inverse" aria-hidden="true" style="position: relative; right:2px"></i>
      </div>
      <div>
        <h2 class="count" data-number="1500">0</h2>
        <p>Životinja za koje trenutno brinemo</p>
        <i class="fas  fa-heart fa-5x fa-inverse" aria-hidden="true" style="position: relative; right:2px;"></i>
      </div>
    </div>
  </section>

  <?php
  include('db/connection.php');
  if (!$conn) {
    echo "<script language='javascript'>";
    echo "console.log(\"" . mysqli_connect_error() . "\");";
    echo "</script>";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM articles ORDER BY inputTimestamp DESC LIMIT 3");
    if (mysqli_num_rows($result) > 0) {
      echo "
          <section class='news-wrapper'>
            <div class='section-title'>
            <div class='line reveal'></div>
              <h2>Novosti</h2>
            </div>
            <div class='news'>
          ";
      for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_assoc($result);
        $files = array_diff(scandir($row['image']), array('.', '..'));
        $mainImage = "";
        foreach ($files as $file) {
          if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
            $mainImage .=  $row['image'] . $file;
          }
        }
        echo "
                <a class='news-block' href='newspage.php?id=" . $row["id"] . "'>
                  <div class='block-wrapper'>
                    <div class='image' style='background-image: " . (empty($mainImage) ? "" : "url($mainImage)")  . ";'></div>
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
      echo "
      </div>
    </section>
    ";
    }
    mysqli_close($conn);
  }
  ?>
  <hr>
  <section class="instagram-wrapper">
    <div data-mc-src="6459abf6-4213-4a7d-8e22-06413a50a4a9#instagram"></div>
    <script src="https://cdn2.woxo.tech/a.js#62876629205adf0021b8bf7a" async data-usrc></script>
    <p></p>
  </section>
  <?php include('include/footer.php') ?>
  <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
  <script src="js/counterup.js"></script>
  <script src="js/reveal.js"></script>
</body>

</html>