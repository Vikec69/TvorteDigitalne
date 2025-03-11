<?php 
require "./bts/common.php"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (isset($_GET['PlaylistID'])) {
    $playlistID = $_GET['PlaylistID'];

    // Načtení playlistu
    $playlistData = $conn->prepare("SELECT * FROM `playlisty` WHERE ID = ?");
    $playlistData->bind_param("i", $playlistID);
    $playlistData->execute();
    $queryResult = $playlistData->get_result();
    $result = $queryResult->fetch_assoc();

    $videoCountQuery = $conn->prepare("SELECT COUNT(*) as count FROM videa WHERE Playlist = ?");
    $videoCountQuery->bind_param("i", $playlistID);
    $videoCountQuery->execute();
    $videoCountResult = $videoCountQuery->get_result();
    $videoCount = $videoCountResult->fetch_assoc()['count'];

    // Načtení údajů o uživateli, který playlist vytvořil
    $UserData = $conn->prepare("SELECT users.Username, users.ProfilePic FROM `playlisty` JOIN users ON playlisty.CreatedBy = users.ID WHERE users.ID = ?");
    $UserData->bind_param("i", $result['CreatedBy']);
    $UserData->execute();
    $queryresult = $UserData->get_result();
    $UserResult = $queryresult->fetch_assoc();
} else {
    die("Chyba: Playlist ID není nastaveno.");
}

// Získání ID uživatele podle jeho username
$userID = null;
if (isset($_SESSION["username"])) {
    $userQuery = $conn->prepare("SELECT ID FROM users WHERE Username = ?");
    $userQuery->bind_param("s", $_SESSION["username"]);
    $userQuery->execute();
    $userQueryResult = $userQuery->get_result();
    if ($userQueryResult->num_rows > 0) {
        $userRow = $userQueryResult->fetch_assoc();
        $userID = $userRow['ID'];
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Playlisty";
    require "./layout/hlava.php";
?>
</head>
<body>
    <?php 
    $active3 = "active-link";
    require "./layout/navbar.php";
    ?>

<!-- Informace o playlistu -->
<section class="playlist-details">
    <section class="playlist-details ">
    <div class="row">
               <div class="column">
                  <div class="thumb">
                     <img src="<?php echo htmlspecialchars($result['PlThumbnail']); ?>" alt="">
                     <span><?php echo $videoCount . " Videa"; ?></span>
                  </div>
               </div>
               <div class="column">
                  <div class="details">
                    <h3><?php echo htmlspecialchars($result["PlName"]); ?></h3>
                     <p><?php echo htmlspecialchars($result["Description"]); ?></p>
                  </div>

                  <div class="tutor">
                   <img src="<?php echo htmlspecialchars($UserResult['ProfilePic']); ?>" alt="">
                     <div>
                        <h3><?php echo htmlspecialchars($UserResult["Username"]); ?></h3>
                        <span><?php echo htmlspecialchars($result["CreatedAt"]); ?></span>
                     </div>
                  </div>

                  <!-- Tlačítko na uložení playlistu -->
                <form method="post" class="save-playlist">
                    <button name = "SavePlaylist" type="submit"><i class="ri-bookmark-line"></i>Uložit playlist</button>
                 </form>
                 <?php
            if (isset($_POST['SavePlaylist']) && $userID !== null) {
                // Kontrola, zda už playlist je uložen
                $userQuery = $conn->prepare("SELECT * FROM SavedPl WHERE UserID = ? AND PlaylistID = ?");
                $userQuery->bind_param("ii", $userID, $result["ID"]);
                $userQuery->execute();
                $userQueryResult = $userQuery->get_result();
                $playlistExists = $userQueryResult->num_rows > 0;

                if ($playlistExists) {
                    // Playlist už je uložen, takže ho smažeme
                    $deleteQuery = $conn->prepare("DELETE FROM SavedPl WHERE UserID = ? AND PlaylistID = ?");
                    $deleteQuery->bind_param("ii", $userID, $result["ID"]);
                    $deleteQuery->execute();
                } else {
                    // Playlist není uložen, tak ho přidáme
                    $insertQuery = $conn->prepare("INSERT INTO SavedPl (UserID, PlaylistID) VALUES (?, ?)");
                    $insertQuery->bind_param("ii", $userID, $result["ID"]);
                    $insertQuery->execute();
                }
            } elseif (!isset($_SESSION["username"])) {
                echo '<p style = "text-align: center; margin-top:1rem;">Musíš být přihlášen, abys mohl uložit playlist.</p>';
            }
            ?>
               </div>
            </div>
            <!-- Výpis videí v playlistu -->
    </section> 
         <section class = "projects section">
            <h2 class="section__title">Videa v playlistu</h2>
            <div class="projects__container container grid">
                <?php
                // Načtení všech videí patřících do daného playlistu
                        $VideoData = $conn->prepare("SELECT * FROM videa WHERE Playlist = ?");
                        $VideoData->bind_param("i", $playlistID);
                        $VideoData->execute();
                        $queryResult = $VideoData->get_result();

                while ($video = $queryResult->fetch_assoc()) {
                echo'
                <article class="projects__card">
                    <a href="video.php?VideoID='. $video["ID"] .'" class="projects__image"><img src="'. $video["Thumbnail"] .'" alt="image" class="projects__img">
                    </a>
        
                    <div class="projects__data">
                        <h3 class="projects__name">'. $video["VidName"] .'</h3>
                        <p class="projects__description">'. $video["Description"].'.</p>
                    </div>

                    <a href="video.php?VideoID='. $video["ID"] .'" class="projects__button">
                        <i class="ri-links-line"></i>
                        <span>Přehrát video</span>
                    </a>
                </article>';
            }
                ?>
            </div>
        </section>
        <?php 
        require "./layout/footer.html";
        if(isset($playlistData)){    
            $playlistData -> close();
        }

        if(isset($UserData)){
            $UserData -> close();
        }
        $conn -> close();
        ?>
</section>
</body>
</html>