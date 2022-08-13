<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontakt | LePas</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  <div class="header-title">
    <div class="line reveal"></div>
    <div class="section-title">
      <h2>Kontakt</h2>
    </div>
  </div>
  <section class="contact-wrapper">
    <div class="contact">
      <div class="form">
        <form>
          <table cellspacing="30px">
            <tbody>
              <tr>
                <td><label>Ime:</label></td>
                <td><input type="text" name="firstname" /><br /></td>
              </tr>
              <tr>
                <td><label>Prezime:</label></td>
                <td><input type="text" name="lastname" /><br /></td>
              </tr>
              <tr>
                <td><label>E-mail:</label></td>
                <td><input type="email" name="mail" /><br /></td>
              </tr>
              <tr>
                <td><label>Telefon:</label></td>
                <td><input type="tel" name="phone" /><br /></td>
              </tr>
              <tr>
                <td><label>Poruka:</label></td>
                <td>
                  <textarea name="message" cols="30" rows="10"></textarea>
                </td>
              </tr>
              <tr>
                <td></td>
                <td><input class="button" type="submit" name="submit" value="Pošalji" /></td>
              </tr>
            </tbody>
          </table>
        </form>
        <div id="conf-msg">
          <h3>Forma je poslana!</h3>
        </div>
      </div>
      <div class="info">
        <div>
          <i class="fa-solid fa-3x fa-location-dot"></i>
          <div>
            <h3>Udruga za dobrobit i</h3>
            <h3>zaštitu životinja LePas</h3>
            <p>Ul. Slavka Kolara 33</p>
            <p>10410 Velika Gorica</p>
          </div>
        </div>
        <div>
          <i class="fas fa-paw fa-3x" aria-hidden="true"></i>
          <div>
            <h3>Radno vrijeme:</h3>
            <p>Radnim danom: 8-20</p>
            <p>Subotom 8-15</p>
          </div>
        </div>
        <div>
          <i class="fa-solid fa-3x fa-envelope"></i>
          <div>
            <h3>E-mail</h3>
            <a href="mailto:udruga@lepas.hr">udruga@lepas.hr</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include('include/footer.php') ?>
  <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
  <script src="js/reveal.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("form").on("submit", function(event) {
        event.preventDefault();

        var formdata = new FormData(this);
        jQuery.ajax({
          url: "forms/process_form.php",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          success: function(res) {
            document.getElementsByTagName("form")[0].style.display = "none";
            document.getElementById("conf-msg").style.display = "unset";
            jQuery('#conf-msg').html(res);
          }
        });
      });
    });
  </script>
</body>

</html>