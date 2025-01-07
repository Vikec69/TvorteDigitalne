<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/LOGO/FavIconW.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.4.0/remixicon.css">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Návody</title>
</head>
<body>
<div id="flex-container">
<?php include "navbar.html"?>
<section class = "projects section">
    <h2 class="section__title">Návody</h2>
    <div class="projects__container container grid">
        <article class="projects__card">
            <a href="playlist.html" class="projects__image"><img src="img/pr thumb.jpg" alt="image" class="projects__img">
            </a>
            <div class="projects__data">
                <h3 class="projects__name">Základy v Adobe Premiere Pro</h3>
                <p class="projects__description">Vysvětlení zákaldních funkcí.</p>
            </div>
            <div class="projects__skills">
                <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
            </div>
            <a href="playlist.html" class="projects__button">
                <i class="ri-links-line"></i>
                <span>Navštívit playlist</span>
            </a>
        </article>
    </div>
</section>
<?php include "footer.html" ?>
</div>
</body>
</html>