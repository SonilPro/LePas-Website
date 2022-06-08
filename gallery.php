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
  <script src="js/reveal.js"></script>
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
      <h2>Galerija</h2>
    </div>
  </div>
  <?php
  define('_DEFVAR', 1);
  include('db/connection.php');
  if (!$conn) {
    echo "<script language='javascript'>";
    echo "console.log(\"" . mysqli_connect_error() . "\");";
    echo "</script>";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM animals ORDER BY inputTimestamp DESC");
    $queryResultSize = mysqli_query($conn, "SELECT * FROM animal_sizes");
  }
  ?>
  <section class="gallery-wrapper">
    <div class="gallery">
      <div class="filter">
        <form>
          <label>Spol:</label>
          <select name='sex'>
            <option value='M'>M</option>
            <option value='Ž'>Ž</option>
          </select>
          <label>Veličina:</label>
          <select name='size'>
            <?php
            while ($size = mysqli_fetch_assoc($queryResultSize)) {
              echo "<option value='$size[id]'>$size[size]</option>";
            }
            ?>
          </select>
          <a href="#">Poništi</a>
        </form>
      </div>
      <div class="cards">
        <?php
        if (!$conn) {
          echo "<script language='javascript'>";
          echo "console.log(\"" . mysqli_connect_error() . "\");";
          echo "</script>";
        } else {
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
            <div class='card' style='background-image: url(" .  $mainImage . ")'>
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
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("form").on("change", function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        jQuery.ajax({
          url: "forms/process_gallery_form.php",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          success: function(res) {
            $(".cards").html(res);
          }
        });
      });
      $("form a").on("click", function() {
        jQuery.ajax({
          url: "forms/process_gallery_form.php",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(res) {
            $(".cards").html(res);
          }
        });
      });
    });
  </script>
</body>

</html>