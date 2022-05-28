<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donacije | LePas</title>
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
            <h2>Volontiranje</h2>
        </div>
    </div>
    <section class="volounteer-wrapper">
        <div class="volounteer">
            <div class="block">
                <div class="image reveal">
                    <div class="main-image">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <clipPath id="clip-it-drawer">
                                <path fill-rule="evenodd" fill="rgb(27, 28, 29)" d="M307.500,4.250 C394.067,-11.895 451.495,30.235 489.775,86.355 C509.129,114.070 524.345,144.235 536.040,172.343 C547.507,200.821 555.454,227.242 555.000,256.000 C555.622,310.647 523.286,365.064 476.347,391.974 C453.011,405.059 426.467,410.019 398.259,405.667 C369.868,401.838 339.813,388.695 305.250,377.625 C237.812,350.668 157.387,360.355 96.129,356.011 C65.697,353.257 40.657,345.229 24.443,327.302 C8.018,309.997 0.419,282.792 -0.000,256.000 C0.623,198.546 30.313,150.093 84.101,107.750 C111.136,86.331 144.668,65.625 183.262,46.575 C221.661,27.854 265.121,10.790 307.500,4.250 "></path>
                            </clipPath>
                        </svg>
                    </div>
                </div>
                <div class="text">
                    <h2>Šetnje</h2>
                    <p>Imamo 50-ak pasa koje je potrebno išetavati i to svaki dan nekoliko puta.</p>
                    <br />
                    <p>Ukoliko biste naš rad željeli podržati kroz šetnju naših šapica, rado ćemo vas ugostiti.</p>
                    <br />
                    <p>Također, ukoliko ste se možda odlučili za udomljenje jedne od naših njuškica, ovo je odličan način da se bolje upoznate. 🙂</p>
                    <br />
                    <p>Molimo vas da nas prije dolaska kontaktirate na mail udruge: <a href="mailto:udruga@lepas.hr">udruga@lepas.hr</a></p>
                </div>
            </div>
            <div class="block">
                <div class="text">
                    <h2>Privremeni smještaj</h2>
                    <p>Imate volju i vremena pomoći, ali niste sigurni kako biste to najbolje mogli?</p>
                    <br />
                    <p>Jedan od izuzetno vrijednih oblika pomoći jest privremeno čuvanje, odnosno - postati teta ili striček čuvalica! 🙂</p><br />
                    <h3>Što to znači?</h3>
                    <p>Biti čuvalica znači primiti psa u svoj dom na oporovaka ili smještaj do njegovog udomljenja.</p>
                    <br />
                    <p>Udruga za svo razdoblje čuvanja osigurava hranu i potrepštine za psa ili mačku te prijevoz do veterinara. Vi s druge strane osiguravate ljubav, pažnju i osnovni odgoj :)</a></p>
                    <br />
                    <a href="#form" id="form-anchor">Ispunite obrazac za privremeni smještaj</a>
                </div>
                <div class="image reveal">
                    <div class="main-image">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <clipPath id="clip-it-drawer">
                                <path fill-rule="evenodd" fill="rgb(27, 28, 29)" d="M307.500,4.250 C394.067,-11.895 451.495,30.235 489.775,86.355 C509.129,114.070 524.345,144.235 536.040,172.343 C547.507,200.821 555.454,227.242 555.000,256.000 C555.622,310.647 523.286,365.064 476.347,391.974 C453.011,405.059 426.467,410.019 398.259,405.667 C369.868,401.838 339.813,388.695 305.250,377.625 C237.812,350.668 157.387,360.355 96.129,356.011 C65.697,353.257 40.657,345.229 24.443,327.302 C8.018,309.997 0.419,282.792 -0.000,256.000 C0.623,198.546 30.313,150.093 84.101,107.750 C111.136,86.331 144.668,65.625 183.262,46.575 C221.661,27.854 265.121,10.790 307.500,4.250 "></path>
                            </clipPath>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <p>
                    Ukoliko ste već naša teta/striček čuvalica, novosti nam možete javljati putem naših društvenih mreža
                </p>
                <div class="buttons">
                    <a href="http://m.me/lepas.udruga" target="_blank" class="button">Facebook</a>
                    <a href="https://www.instagram.com/lepas_udruga/" target="_blank" class="button">Instagram</a>
                </div>
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
                                <textarea cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="button" type="submit" name="submit" id="submit" value="Pošalji" /></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div id="conf-msg">
                <h3>Forma je poslana!</h3>
            </div>
        </div>
    </section>
    <?php include('include/footer.php') ?>
    <script src="https://kit.fontawesome.com/4705ced167.js" crossorigin="anonymous"></script>
    <script src="js/reveal.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        var submit = false;
        fileInputElement = document.getElementById('file');
        fileLabelElement = document.getElementById('info');
        var fileButtonElement = document.getElementById("click-input");
        var errorMsg = "Molimo odaberite barem jednu sliku";
        document.getElementById("file").onchange = function() {
            var count = fileInputElement.files.length;
            if (count > 1) {
                for (var i = 0; i < count; i++) {
                    var file = fileInputElement.files[i];
                    var pattern = "image/*";
                    if (!file.type.match(pattern)) {
                        fileLabelElement.innerHTML = "Molimo odaberite samo slike";
                        errorMsg = "Molimo odaberite samo slike";
                        fileInputElement.value = null;
                        fileButtonElement.style.border = "1px solid red";
                        submit = false;
                        return;
                    } else if ((file.size / 1024 / 1024) > 5) {
                        fileLabelElement.innerHTML = "Veličina slika je prevelika";
                        errorMsg = "Veličina slika je prevelika";
                        fileInputElement.value = null;
                        fileButtonElement.style.border = "1px solid red";
                        submit = false;
                        return;
                    }
                    fileButtonElement.style.border = "1px solid black";
                    fileLabelElement.innerHTML = "Broj unesenih slika: " + count;
                    submit = true;
                }
            } else if (count == 1) {
                var file = fileInputElement.files[0];
                var pattern = "image/*";
                if (!file.type.match(pattern)) {
                    fileLabelElement.innerHTML = "Molimo odaberite samo slike";
                    errorMsg = "Molimo odaberite samo slike";
                    fileInputElement.value = null;
                    fileButtonElement.style.border = "1px solid red";
                    submit = false;
                    return;
                } else if ((file.size / 1024 / 1024) > 5) {
                    fileLabelElement.innerHTML = "Veličina slika je prevelika";
                    errorMsg = "Veličina slika je prevelika";
                    fileInputElement.value = null;
                    fileButtonElement.style.border = "1px solid red";
                    submit = false;
                    return;
                }
                fileButtonElement.style.border = "1px solid black";
                var path = fileInputElement.value;
                fileLabelElement.innerHTML = path.split(/(\\|\/)/g).pop()
                submit = true;
            }
        }

        document.getElementById("submit").onclick = function() {
            if (!submit) {
                fileLabelElement.innerHTML = errorMsg;
                fileLabelElement.focus();
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").on("submit", function(event) {
                event.preventDefault();

                var formdata = new FormData(this);
                jQuery.ajax({
                    url: "process_form.php",
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