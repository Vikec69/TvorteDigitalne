<section class="playlist-details">
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
        <section class="playlist-details section">
         
            <div class="row">
               <div class="column">
            
                  <div class="thumb">
                     <img src="img/pr thumb.jpg" alt="">
                     <span>3 videa</span>
                  </div>
               </div>
               <div class="column">

                  <div class="details">
                     <h3>Základy Premiere Pro</h3>
                     <p>V tomto playlistu se naučíte jak fungují základní nástroje v Adobe Premiere Pro.</p>
                  </div>

                  <div class="tutor">
                   <img src="img/pfp.jpg" alt="">
                     <div>
                        <h3>Viktor Červenka</h3>
                        <span>09. 12. 2024</span>
                     </div>
                  </div>

                  <form action="" method="post" class="save-playlist">
                    <button type="submit"><i class="ri-bookmark-line"></i> <span>Uložit playlist</span></button>
                 </form>
               </div>
            </div>
         </section>
         
         <section class = "projects section">
            <h2 class="section__title">Videa v playlistu</h2>
            <div class="projects__container container grid">
                <article class="projects__card">
                    <a href="video.html" class="projects__image"><img src="img/pr1.jpg" alt="image" class="projects__img">
                    </a>
        
                    <div class="projects__data">
                        <h3 class="projects__name">Základní nástroje</h3>
                        <p class="projects__description">Vysvětlení funkcí základních nástrojů.</p>
                    </div>
        
                    <div class="projects__skills">
                        <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
                    </div>
        
                    <a href="video.html" class="projects__button">
                        <i class="ri-links-line"></i>
                        <span>Přehrát video</span>
                    </a>
                </article>
        
                <article class="projects__card">
                    <a href="video.html" class="projects__image"><img src="./img/pr2.jpg" alt="image" class="projects__img">
                    </a>
        
                    <div class="projects__data">
                        <h3 class="projects__name">Přidání textu</h3>
                        <p class="projects__description">Jak přidat text, aby vypadal stylově.</p>
                    </div>
        
                    <div class="projects__skills">
                        <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
                    </div>
        
                    <a href="video.html" class="projects__button">
                        <i class="ri-links-line"></i>
                        <span>Přehrát video</span>
                    </a>
                </article>
        
                <article class="projects__card">
                    <a href="video.html" class="projects__image"><img src="./img/pr3.jpg" alt="image" class="projects__img">
                    </a>
        
                    <div class="projects__data">
                        <h3 class="projects__name">Základní efekty</h3>
                        <p class="projects__description">Jak na základní efekty a přechody.</p>
                    </div>
        
                    <div class="projects__skills">
                        <img src="img/icons8-adobe_premiere.svg" alt="image" class="projects__skill">
                    </div>
        
                    <a href="video.html" class="projects__button">
                        <i class="ri-links-line"></i>
                        <span>Přehrát video</span>
                    </a>
                </article>
            </div>
        </section>
        <?php include "footer.html" ?>
</body>
</html>