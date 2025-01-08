<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Návody";
    require "./layout/hlava.php";
    ?>
</head>
<body>
<div id="flex-container">
<?php 
    $active3 = "active-link";
    require "./layout/navbar.php";
    ?>
<section class = "projects section">
    <h2 class="section__title">Návody</h2>
    <div class="projects__container container grid">
        <article class="projects__card">
            <a href="playlist.php" class="projects__image"><img src="img/pr thumb.jpg" alt="image" class="projects__img">
            </a>
            <div class="projects__data">
                <h3 class="projects__name">Základy v Adobe Premiere Pro</h3>
                <p class="projects__description">Vysvětlení zákaldních funkcí.</p>
            </div>
            <div class="projects__skills">
                <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
            </div>
            <a href="playlist.php" class="projects__button">
                <i class="ri-links-line"></i>
                <span>Navštívit playlist</span>
            </a>
        </article>
    </div>
</section>
<?php require "./layout/footer.html" ?>
</div>
</body>
</html>