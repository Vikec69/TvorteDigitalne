<?php require "./bts/common.php"; ?>
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

    <!-- Hlavní showcase -->
        <section class = "home section">
            <div class="home_container container grid">
                <div class="profil">
                    <img src="./img/ja/toottoot2.png" class="profil_img">
                    <div class="profil_data">
                        <h1 class="profil_name">Tvořte Digitálně</h1>
                        <div class="profil_buttons">
                            <a href="./projects.php" class="button">Projekty</a>
                            <a href="./navody.php" class="button button_black">Návody</a>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="info_data">
                        <h1 class="info_name">Začněte hned teď!</h1>
                    </div>
                    <div class="info_image">
                        <img src="./img/LOGO/TvorteDigitalne.svg" style="filter: invert();" alt="image" class="info_img">
                    </div>
                    <p class="info_description">
                    Inspirace, návody a tipy, které vás provedou světem focení, natáčení a úprav, aby vaše tvorba byla vždy profesionální a jedinečná
                    </p>
                    <a href="./video.php?VideoID=3" class="button button_black">Reklamní video</a>
                </div>
                <div class="about">
                    <h3 class="about_name">
                        Proč tvořit <b>digitálně?</b>
                    </h3>
                    <p class="about_description">
                        Digitální tvorba nabízí nekonečné možnosti, jak vyjádřit svou kreativitu. Díky novým technologíím máme nástroje, které vám umožní zachytit nezapomenutelné okamžiky, vyprávět příběhy a tvořit obsah, který osloví každého.
                    </p>
                    <div class="about_social">
                        <a href="https://www.instagram.com/cerveney_jezis/" target="_blank" class="about_link">
                            <i class="ri-instagram-line"></i>
                        </a>

                        <a href="https://www.youtube.com/@vikec" target="_blank" class="about_link">
                            <i class="ri-youtube-line"></i>
                        </a>

                        <a href="https://github.com/Vikec69/" target="_blank" class="about_link">
                            <i class="ri-github-fill"></i>
                        </a>
                    </div>
                    <div class="about_image">
                        <img src="./img/ja/toottooot.png" alt="image" class="about_img">
                    </div>
                    <p class="about_note">
                        Nejsem aktivní na sociálních sítích, napište mi skrze stránku.
                    </p>
                    <a href="./contact.php" class="button">Napiš mi</a>
                </div>
                    <div class="skills">
                        <h2 class="skills_title">ZKUŠENOSTI</h2>

                        <div class="skills_items">
                            <img src="img/premiere-icon.svg" alt="image" class="skills_item">
                            <img src="img/ae-icon.svg" alt="image" class="skills_item">
                            <img src="img/photoshop-icon.svg" alt="image" class="skills_item">
                            <img src="img/lightroom-icon.svg" alt="image" class="skills_item">
                        </div>
                    <p class="skills_description">
                        Koukni na moje projekty, 
                        ať vidíš, co vše se můžeš naučit.
                    </p>
                    </div>
            </div>
        </section>

        <!-- Co najdete na mé stránce -->
        <section class="knowledge section">
            <h2 class="section_title">CO ZDE NAJDETE?</h2>
            <div class="knowledge_container container grid">
                <article class="knowledge_card">
                    <div class="knowledge_icon">
                        <div class="knowledge_circle"></div>
                        <i class="ri-video-on-fill"></i>
                    </div>
                    <h3 class="knowledge_name">Praktické návody</h3>
                    <p class="knowledge_description">
                        Jak správně fotit a natáčet, aby vaše záběry vypadaly profesionálně.
                    </p>
                </article>
                <article class="knowledge_card">
                    <div class="knowledge_icon">
                        <div class="knowledge_circle"></div>
                        <i class="ri-camera-fill"></i>
                    </div>
                    <h3 class="knowledge_name">Tipy na úpravy</h3>
                    <p class="knowledge_description">
                        Naučte se krok za krokem editovat fotky a videa s úžasnými efekty.
                    </p>
                </article>
                <article class="knowledge_card">
                    <div class="knowledge_icon">
                        <div class="knowledge_circle"></div>
                        <i class="ri-image-edit-fill"></i>
                    </div>
                    <h3 class="knowledge_name">Inspirace a triky</h3>
                    <p class="knowledge_description">
                        Objevte kreativní postupy a techniky, které vaši tvorbu posunou na další úroveň.
                    </p>
                </article>
            </div>
        </section>

        <!-- Zkušenosti -->
        <section class="experience section">
            <h2 class="section_title">ZKUŠENOSTI NEBO PRÁCE</h2>
        
            <div class="experience_container container grid">
                <article class="experience_card">
                    <h2 class="experience_company">Obchodní akademie a Střední odborná škola logistická</h2>
                        <div class="experience_data">
                            <h3 class="experience_profession">Student</h3>
                                <span class="experience_date">09/21 - 06/25</span>
                                    <p class="experience_description">Studuji informační technologie, abych všemu rozuměl.</p>
                        </div>
                </article>
                <article class="experience_card">
                    <h2 class="experience_company">Obec Mokré Lazce</h2>
                        <div class="experience_data">
                            <h3 class="experience_profession">Fotograf</h3>
                                <span class="experience_date">11/22 -</span>
                                    <p class="experience_description">Fotím všechny typy akcí, od předávání cen hasičům, přes adventy, po dušičky. </p>
                        </div>
                </article>
            </div>
        </section>
<section>

<!-- Tabulka s ceníkem -->
<h2 style="margin-bottom: 2rem; text-align: center;">Mé služby - Ceník</h2>
    <table class="tabulkos" style = "margin-bottom: 3rem;">
        <thead>
            <tr>
                <th>Název</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="name">Úprava fotek</td>
                <td>300 Kč / 10 ks</td>
            </tr>
            <tr>
                <td class="name">Focení</td>
                <td>400 Kč / 1 hod</td>
            </tr>
            <tr>
                <td class="name">Střih videa</td>
                <td>600 Kč / 30 min</td>
            </tr>
        </tbody>
    </table>
</section>
    <?php require "./layout/footer.html"; ?>
</div>
</body>
</html>