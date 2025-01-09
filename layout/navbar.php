<?php
    if($_SESSION["username"] == null){
    echo'
<nav class = "nav">
    <ul class ="nav__list">
        <li>
            <a href="./" title="Domů" class="nav__link '. $active1 .'">
                <i class="ri-home-line"></i>
            </a>
        </li>

        <li>
            <a href="./projects.php" title="Projekty" class="nav__link '. $active2 .'">
                <i class="ri-folder-line"></i>
            </a>
        </li>

        <li>
            <a href="./navody.php" title="Návody" class="nav__link '. $active3 .'">
                <i class="ri-file-line"></i>
            </a>
        </li>

        <li>
            <a href="./login.php" title="Přihlášení" class="nav__link '. $active4 .'">
                <i class="ri-honour-line"></i>
            </a>
        </li>

        <li>
            <a href="./contact.php" title="Kontakt" class="nav__link '. $active5 .'">
                <i class="ri-send-plane-line"></i>
            </a>
        </li>
    </ul>
</nav>
';}
    else{
    echo'
<nav class = "nav">
    <ul class ="nav__list">
        <li>
            <a href="./" title="Domů" class="nav__link '. $active1 .'">
                <i class="ri-home-line"></i>
            </a>
        </li>

        <li>
            <a href="./projects.php" title="Projekty" class="nav__link '. $active2 .'">
                <i class="ri-folder-line"></i>
            </a>
        </li>

        <li>
            <a href="./navody.php" title="Návody" class="nav__link '. $active3 .'">
                <i class="ri-file-line"></i>
            </a>
        </li>

        <li>
            <a href="./login.php" title="Profil" class="nav__link '. $active4 .'">
                <i class="ri-account-circle-line"></i>
            </a>
        </li>

        <li>
            <a href="./contact.php" title="Kontakt" class="nav__link '. $active5 .'">
                <i class="ri-send-plane-line"></i>
            </a>
        </li>
    </ul>
</nav>';
}
?>