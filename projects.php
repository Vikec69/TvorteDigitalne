<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekty</title>
    <link rel="icon" href="./img/LOGO/FavIconW.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.4.0/remixicon.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="flex-container">
    <section class = "projects section">
        <h2 class="section__title">PROJEKTY</h2>
        <div class="projects__container container grid">
            <article class="projects__card">
                <a href="https://www.mokrelazce.cz/volny-cas/fotografie/" target="_blank" class="projects__image"><img src="img/obec.jpg" alt="image" class="projects__img">
                </a>
    
                <div class="projects__data">
                    <h3 class="projects__name">Fotky pro obec</h3>
                    <p class="projects__description">Moje kariéra fotografa.</p>
                </div>
    
                <div class="projects__skills">
                    <img src="img/icons8-adobe_photoshop.svg" alt="image" class="projects__skill">
                    <img src="img/adobe-photoshop-lightroom-cc-icon.svg" alt="image" class="projects__skill">
                </div>
    
                <a href="https://www.mokrelazce.cz/volny-cas/fotografie/" target="_blank" class="projects__button">
                    <i class="ri-links-line"></i>
                    <span>Stránky Obce</span>
                </a>
            </article>
    
            <article class="projects__card">
                <a href="https://www.youtube.com/watch?v=hlahJDeAEfk" target="_blank" class="projects__image"><img src="./img/letnivideo.jpg" alt="image" class="projects__img">
                </a>
    
                <div class="projects__data">
                    <h3 class="projects__name">Letní video</h3>
                    <p class="projects__description">Ukázka zkušeností stříhání videí.</p>
                </div>
    
                <div class="projects__skills">
                    <img src="img/icons8-adobe_photoshop.svg" alt="image" class="projects__skill">
                    <img src="img/icons8-adobe_ae.svg" alt="image" class="projects__skill">
                    <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
                </div>
    
                <a href="https://www.youtube.com/watch?v=hlahJDeAEfk" target="_blank" class="projects__button">
                    <i class="ri-links-line"></i>
                    <span>Navštívit projekt</span>
                </a>
            </article>
    
            <article class="projects__card">
                <a href="https://www.maxido.cz/" target="_blank" class="projects__image"><img src="./img/postele.jpg" alt="image" class="projects__img">
                </a>
    
                <div class="projects__data">
                    <h3 class="projects__name">Úprava postelí</h3>
                    <p class="projects__description">Různé variace barev.</p>
                </div>
    
                <div class="projects__skills">
                    <img src="img/icons8-adobe_photoshop.svg" alt="image" class="projects__skill">
                </div>
    
                <a href="https://www.maxido.cz/" target="_blank" class="projects__button">
                    <i class="ri-links-line"></i>
                    <span>Navštívit projekt</span>
                </a>
            </article>
        </div>
    </section>
    <?php include "footer.html" ?>
    </div>
</body>
</html>