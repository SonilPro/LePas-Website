<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <?php include('include/header.php'); ?>
  <aside>
    <div class="socials">
      <a href="#">
        <img src="img/facebook.gif" alt="facebook" />
      </a>
    </div>
  </aside>
  <div class="imageHeader" id="imageHeader1">
    <h1>LePas</h1>
    <p>Udruga za dobrobit i zaštitu životinja</p>
  </div>
  <div class="options-wrapper">
    <h2>Kako možeš pomoći</h2>
    <div class="options">
      <div class="option" style="
            background-image: url(https://media.4-paws.org/1/4/2/1/1421772709675ddb3eed25eee3a8c78ddf829671/VIER_PFOTEN_2020-12-17_00023-912x684-533x400.jpg);
          ">
        <span class="icon">
          <i class="fas fa-paw fa-3x fa-inverse" aria-hidden="true"></i>
        </span>
        <h3>POSVOJI</h3>
        <p>Svaki novi dom je dobrodošao!</p>
        <a class="button" href="#">POSVOJI</a>
      </div>
      <div class="option" style="
            background-image: url(https://media.4-paws.org/1/4/2/1/1421772709675ddb3eed25eee3a8c78ddf829671/VIER_PFOTEN_2020-12-17_00023-912x684-533x400.jpg);
          ">
        <span class="icon">
          <i class="fas fa-hand-holding-medical fa-3x fa-inverse" aria-hidden="true"></i>
        </span>
        <h3>DONIRAJ</h3>
        <p>Stvorimo bolji svijet za životinje</p>
        <a class="button" href="donation.php">DONIRAJ</a>
      </div>
    </div>
  </div>
  <section class="gallery-wrapper">
    <div class="gallery">
      <h2>Novi članovi</h2>
      <div class="cards">
        <div class="card">
          <a href="#">
            <div class="description">
              <h3>Ime</h3>
            </div>
          </a>
        </div>
        <div class="card" style="background-image: url(img/Cat.png)">
          <a href="#">
            <div class="description">
              <h3>Ime</h3>
            </div>
          </a>
        </div>
        <div class="card" style="background-image: url(img/Cat.png)">
          <a href="#">
            <div class="description">
              <h3>Ime</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <section class="news-wrapper">
    <h2>Novosti</h2>
    <div class="news">
      <div class="news-block">
        <div class="title">
          <a href="#">Lorem ipsum</a>
        </div>
        <p class="date">25.12.2021</p>
        <img src="img/newsImg.jpg" alt="newsImg1" />
        <p class="summary">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati in id architecto placeat voluptas quia
          et, autem magni beatae necessitatibus adipisci quas, possimus eos non eligendi animi, quo illo reiciendis?
        </p>
        <a class="button" href="#">Pročitaj više</a>
      </div>
      <div class="news-block">
        <div class="title">
          <a href="#">Lorem ipsum</a>
        </div>
        <p class="date">25.12.2021</p>
        <img src="img/newsImg.jpg" alt="newsImg1" />
        <p class="summary">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati in id architecto placeat voluptas quia
          et, autem magni beatae necessitatibus adipisci quas, possimus eos non eligendi animi, quo illo reiciendis?
        </p>
        <a class="button" href="#">Pročitaj više</a>
      </div>
      <div class="news-block">
        <div class="title">
          <a href="#">Lorem ipsum</a>
        </div>
        <p class="date">25.12.2021</p>
        <img src="img/newsImg.jpg" alt="newsImg1" />
        <p class="summary">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati in id architecto placeat voluptas quia
          et, autem magni beatae necessitatibus adipisci quas, possimus eos non eligendi animi, quo illo reiciendis?
        </p>
        <a class="button" href="#">Pročitaj više</a>
      </div>
    </div>
  </section>
  <?php include('include/footer.php') ?>
</body>

</html>