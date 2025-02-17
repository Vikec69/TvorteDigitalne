<?php require "./bts/common.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Projekty";
    require "./layout/hlava.php";
    ?>
</head>
<body>
<div id="flex-container">
<?php 
    $active2 = "active-link";
    require "./layout/navbar.php";

try{    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $projekty = $conn -> query("SELECT * FROM projekty");
} finally{
    $conn -> close();
}
    ?>
    <section class = "projects section">
        <h2 class="section__title">PROJEKTY</h2>
        <div class="projects__container container grid">
            <?php
            foreach($projekty as $projekt){
            echo'
            <article class="projects__card">
                <a href="'. $projekt["Odkaz"] .'" target="_blank" class="projects__image"><img src="'. $projekt["Img"] .'" alt="image" class="projects__img">
                </a>
    
                <div class="projects__data">
                    <h3 class="projects__name">'. $projekt["Name"] .'</h3>
                    <p class="projects__description">'. $projekt["Descr"] .'</p>
                </div>
    
                <a href="'. $projekt["Odkaz"] .'" target="_blank" class="projects__button">
                    <i class="ri-links-line"></i>
                    <span>Odkaz na stránky</span>
                </a>
            </article>';
            }
            ?>
        </div>
    </section>
    <?php require "./layout/footer.html" ?>
    </div>
</body>
</html>