<?php $page = basename($_SERVER['PHP_SELF']);
$page = substr($page, 0, strpos($page, "."));
?>
<div style="height: 85px;">
    <header>
        <nav>
            <a href="index.php">
                <img src="img/lepas_logo.png" class="logo" />
            </a>
            <ul class="nav-links">
                <input type="checkbox" id="checkbox_toggle" autocomplete="off" />
                <label for="checkbox_toggle" class="hamburger">
                    <span></span>
                </label>
                <div class="menu">
                    <li class="<?php echo ($page == "index" ? "current" : "") ?>"><a href="index.php">Naslovnica</a></li>
                    <li class="<?php echo ($page == "about" ? "current" : "") ?>"><a href="about.php">O nama</a></li>
                    <li class="<?php echo ($page == "gallery" ? "current" : "") ?>"><a href="gallery.php">Galerija</a></li>
                    <li class="<?php echo ($page == "news" ? "current" : "") ?>"><a href="news.php">Novosti</a></li>
                    <!-- <li class="services">
              <a class="" href="novosti.html">Novosti</a>
              <ul class="dropdown">
                <li><a href="#">Dropdown 1 </a></li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
              </ul>
            </li> -->
                    <li class="<?php echo ($page == "donation" ? "current" : "") ?>"><a href="donation.php">Donacije</a></li>
                    <li class="<?php echo ($page == "contact" ? "current" : "") ?>"><a href="contact.php">Kontakt</a></li>
                </div>
            </ul>
        </nav>
        <div class="donate">
            <a class="button" href="donation.php">DONIRAJ</a>
        </div>
    </header>
</div>