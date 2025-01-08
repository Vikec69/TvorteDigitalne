<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Tvořte Digitálně";
    require "./layout/hlava.php";
    ?>
</head>
<body>
<div id="flex-container">
    <?php 
    $active1 = "active-link";
    require "./layout/navbar.php";
    ?>
        <section class = "home section">
            <div class="home__container container grid">
                <div class="profil">
                    <img src="img/LOGO/TvorteDigitalne.svg" style="filter: invert(); margin-left: auto; margin-right: auto;">
                    <div class="profil__data">
                        <h1 class="profil__name">Tvořte Digitálně</h1>
                        <div class="profil__buttons">
                            <a href="projects.html" class="button">Projekty</a>
                            <a href="navody.html" class="button button__black">Návody</a>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="info__data">
                        <h1 class="info__name">Začněte hned teď!</h1>
                    </div>
                    <div class="info__image">
                        <img src="img/skelly boy spin.gif" alt="image" class="info__img">
                    </div>
                    <p class="info__description">
                    Inspirace, návody a tipy, které vás provedou světem focení, natáčení a úprav, aby vaše tvorba byla vždy profesionální a jedinečná
                    </p>
                    <a href="video.html" class="button button__black">Reklamní video</a>
                </div>
                <div class="about">
                    <h3 class="about__name">
                        Proč tvořit <b>digitálně?</b>
                    </h3>
                    <p class="about__description">
                        Digitální tvorba nabízí nekonečné možnosti, jak vyjádřit svou kreativitu. Díky novým technologíím máme nástroje, které vám umožní zachytit nezapomenutelné okamžiky, vyprávět příběhy a tvořit obsah, který osloví každého.
                    </p>
                    <div class="about__social">
                        <a href="https://www.instagram.com/cerveney_jezis/" target="_blank" class="about__link">
                            <i class="ri-instagram-line"></i>
                        </a>

                        <a href="https://www.youtube.com/@vikec" target="_blank" class="about__link">
                            <i class="ri-youtube-line"></i>
                        </a>

                        <a href="https://github.com/Vikec69/" target="_blank" class="about__link">
                            <i class="ri-github-fill"></i>
                        </a>
                    </div>
                    <div class="about__image">
                        <img src="img/skelly boy cheezit.gif" alt="image" class="about__img">
                    </div>
                    <p class="about__note">
                        Nejsem aktivní na socialních sítích, napište mi skrze stránku.
                    </p>
                    <a href="contact.html" class="button">Napiš mi</a>
                </div>
                    <div class="skills">
                        <h2 class="skills__title">ZKUŠENOSTI</h2>

                        <div class="skills__items">
                            <img src="img/icons8-adobe_premiere.svg" alt="image" class="skills__item">
                            <img src="img/icons8-adobe_ae.svg" alt="image" class="skills__item">
                            <img src="img/icons8-adobe_photoshop.svg" alt="image" class="skills__item">
                            <img src="img/adobe-photoshop-lightroom-cc-icon.svg" alt="image" class="skills__item">
                        </div>
                    <p class="skills__description">
                        Koukni na moje projekty, 
                        ať vidíš co vše se můžeš naučit.
                    </p>
                    </div>
            </div>
        </section>
        <section class="knowledge section">
            <h2 class="section__title">CO ZDE NAJDETE?</h2>
            <div class="knowledge__container container grid">
                <article class="knowledge__card">
                    <div class="knowledge__icon">
                        <div class="knowledge__circle"></div>
                        <i class="ri-video-on-fill"></i>
                    </div>
                    <h3 class="knowledge__name">Praktické návody</h3>
                    <p class="knowledge__description">
                        Jak správně fotit a natáčet, aby vaše záběry vypadaly profesionálně.
                    </p>
                </article>
                <article class="knowledge__card">
                    <div class="knowledge__icon">
                        <div class="knowledge__circle"></div>
                        <i class="ri-camera-fill"></i>
                    </div>
                    <h3 class="knowledge__name">Tipy na úpravy</h3>
                    <p class="knowledge__description">
                        Naučte se krok za krokem editovat fotky a videa s úžasnými efekty.
                    </p>
                </article>
                <article class="knowledge__card">
                    <div class="knowledge__icon">
                        <div class="knowledge__circle"></div>
                        <i class="ri-image-edit-fill"></i>
                    </div>
                    <h3 class="knowledge__name">Inspirace a triky</h3>
                    <p class="knowledge__description">
                        Objevte kreativní postupy a techniky, které vaši tvorbu posunou na další úroveň.
                    </p>
                </article>
            </div>
        </section>
        <section class="experience section">
            <h2 class="section__title">ZKUŠENOSTI NEBO PRÁCE</h2>
        
            <div class="experience__container container grid">
                <article class="experience__card">
                    <h2 class="experience__company">Obchodní akademie a Střední odborná škola logistická</h2>
                        <div class="experience__data">
                            <h3 class="experience__profession">Student</h3>
                                <span class="experience__date">09/21 - 06/25</span>
                                    <p class="experience__description">Studuji informační technologie, abych všemu rozumněl.</p>
                        </div>
                </article>
                <article class="experience__card">
                    <h2 class="experience__company">Obec Mokré Lazce</h2>
                        <div class="experience__data">
                            <h3 class="experience__profession">Fotograf</h3>
                                <span class="experience__date">11/22 -</span>
                                    <p class="experience__description">Fotím všechny typy akcí, od předávání cen hasičům, přes adventy, po dušičky. </p>
                        </div>
                </article>
            </div>
        </section>
    <?php require "./layout/footer.html" ?>
</div>
</body>
</html>