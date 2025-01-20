<?php 
require "./bts/common.php"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
$playlistData = $conn -> query("SELECT * FROM `playlisty`");

?>
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
<section class="projects section">
    <h2 class="section__title">Návody</h2>

    <form method="GET" action="" style="display:flex; justify-content: center; gap: 1.5rem;">
        <button type="submit" name="filter" class="login__button" style="width:10%;" value="all">Všechny playlisty</button>
        <button type="submit" name="filter" class="login__button login__button-ghost" style="width:10%" value="user">Moje playlisty</button>
    </form>

    <div class="projects__container container grid">
<?php 
if ($playlistData->num_rows > 0) {
    while ($row = $playlistData->fetch_assoc()) {
        echo '<article class="projects__card">
                <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects__image"><img src="' . $row["PlThumbnail"] . '" alt="thumbnail" class="projects__img">
                </a>
                <div class="projects__data">
                    <h3 class="projects__name">'
                        . $row["PlName"] . '
                    </h3>
                    <p class="projects__description">' . $row["Description"] . '</p>
                </div>
                <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects__button">
                    <i class="ri-links-line"></i>
                    <span>Navštívit playlist</span>
                </a>
            </article>';
    }
} else {
    echo "<p>Žádné playlisty nebyly nalezeny.</p>";
}
        ?>
    </div>
</section>
<?php require "./layout/footer.html";
    $conn -> close();
    $playlistData -> close();
?>
</div>
</body>
</html>