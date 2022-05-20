<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>O nama | LePas</title>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="img/lepas_logo.ico" type="image/x-icon">
    <script type="text/javascript">
        window.addEventListener("scroll", reveal);

        function reveal() {
            var reveals = document.querySelectorAll('.reveal');

            for (var i = 0; i < reveals.length; i++) {
                var windowheight = window.innerHeight;
                var revealtop = reveals[i].getBoundingClientRect().top;
                var revealpoint = 150;

                if (revealtop < windowheight - revealpoint) {
                    reveals[i].classList.add('active');
                }
            }
        }
    </script>
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
        <h1>O nama</h1>
    </div>
    <section class="about-wrapper ">
        <div class="about">
            <div class="content ">
                <div class="text">
                    <h2>O udruzi</h2>
                    <p>
                        LePas je mlada udruga za dobrobit i zaštitu životinja koja je službeno s radom započela 11. rujna
                        2020. godine, no članovi udruge već su godinama aktivni i vrlo iskusni volonteri koji iza sebe imaju
                        jako velik broj spašenih života i udomljenih životinja.
                    </p>
                </div>
                <div class="image">
                    <img src="img/about1.jpg">
                </div>
            </div>
            <div class="content">
                <div class="image">
                    <img src="img/about3.jpg">
                </div>
                <div class="text reveal">
                    <h2>Cilj udruge</h2>
                    <p>
                        Naš cilj i ključni dio naše misije je pomaganje životinjama od kojih drugi okreću glave jer su bolesne, teško udomljive ili stare (skupina na koju smo posebno slabi). Zbog toga smo početkom 2021. godine, nakon što je dio Hrvatske pogodio jedan od najrazornijih potresa ikad zabilježenih, iz zahvaćenih područja preuzeli 94 psa među kojima je najveći postotak upravo ovih “neprimjetnih”.
                    </p>
                </div>
            </div>
            <div class="content">
                <div class="text reveal">
                    <h2>Članovi</h2>
                    <p>
                        Trenutno u udruzi brojimo 4 aktivna člana, dok na skrbi imamo 80-ak pasa i mačaka. Većina ih se nalazi u našem utočištu, koje dijele s dvoje volontera, našom predsjednicom Tihanom te njenim zaručnikom Damirom.
                    </p>
                </div>
                <div class="image">
                    <img src="img/about2.JPEG">
                </div>
            </div>
            <div class="content">
                <div class="image">
                    <img src="img/about4.JPEG">
                </div>
                <div class="text reveal">
                    <h2>Uspjesi</h2>
                    <p>
                        Od početka rada, na skrb smo preuzeli oko 350 pasa i mačaka. Velik smo broj njih već i udomili, no svi koji su nam još uvijek na skrbi zahtijevaju velik angažman, kao i velike financijske izdatke.
                        Poziv koji smo, uz naše poslove i privatne obaveze, preuzeli na sebe ispunjava nas u potpunosti i zaista rado i srčano radimo ovo što radimo, no svjesni smo da nam je u logistici ipak potrebna pomoć u vidu donacija jer nam je na prvom mjestu uvijek činjenica da svaku životinju koju preuzmemo na skrb moramo zbrinuti na kvalitetan način te joj omogućiti sve što joj je potrebno.
                    </p>
                </div>

            </div>
        </div>
    </section>
    <?php include('include/footer.php') ?>
</body>

</html>