<?php 
require "./bts/common.php"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
$activeFilter = $_GET['filter'] ?? 'all';

// Získání všech playlistů
$playlistData = $conn->query("SELECT * FROM `playlisty`");
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
    <?php
    // Filtrační tlačítka
    if (isset($_SESSION["username"])) {
        echo '<form method="GET" style="display:flex; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
            <button type="submit" name="filter" class="login__button ' . ($activeFilter === 'all' ? '' : 'login__button-ghost') . '" style="width:auto;" value="all">Všechny playlisty</button>
            <button type="submit" name="filter" class="login__button ' . ($activeFilter === 'user' ? '' : 'login__button-ghost') . '" style="width:auto;" value="user">Moje playlisty</button>
        </form>';
    }
    ?>
    <div class="projects__container container grid">
<?php 

// Všechny playlisty
if ($activeFilter == "all") {
    if ($playlistData->num_rows > 0) {
        while ($row = $playlistData->fetch_assoc()) {
            echo '<article class="projects__card">
                    <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects__image"><img src="' . $row["PlThumbnail"] . '" alt="thumbnail" class="projects__img">
                    </a>
                    <div class="projects__data">
                        <h3 class="projects__name">' . htmlspecialchars($row["PlName"]) . '</h3>
                        <p class="projects__description">' . htmlspecialchars($row["Description"]) . '</p>
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
}

// User playlisty
elseif ($activeFilter == "user" && isset($_SESSION["username"])) {
    // Získání ID uživatele
    $userQuery = $conn->prepare("SELECT ID FROM users WHERE Username = ?");
    $userQuery->bind_param("s", $_SESSION["username"]);
    $userQuery->execute();
    $userResult = $userQuery->get_result();
    if ($userRow = $userResult->fetch_assoc()) {
        $userID = $userRow['ID'];

        // Získání uložených playlistů
        $savedPlaylists = $conn->prepare("SELECT p.* FROM playlisty p INNER JOIN SavedPl ps ON p.ID = ps.PlaylistID WHERE ps.UserID = ?");
        $savedPlaylists->bind_param("i", $userID);
        $savedPlaylists->execute();
        $savedPlaylistsResult = $savedPlaylists->get_result();

        if ($savedPlaylistsResult->num_rows > 0) {
            while ($row = $savedPlaylistsResult->fetch_assoc()) {
                echo '<article class="projects__card">
                        <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects__image"><img src="' . $row["PlThumbnail"] . '" alt="thumbnail" class="projects__img">
                        </a>
                        <div class="projects__data">
                            <h3 class="projects__name">' . htmlspecialchars($row["PlName"]) . '</h3>
                            <p class="projects__description">' . htmlspecialchars($row["Description"]) . '</p>
                        </div>
                        <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects__button">
                            <i class="ri-links-line"></i>
                            <span>Navštívit playlist</span>
                        </a>
                    </article>';
            }
        } else {
            echo "<p>Žádné uložené playlisty nebyly nalezeny.</p>";
        }
    }
}
?>
    </div>
</section>
<?php require "./layout/footer.html";
$conn->close();
?>
</div>
</body>
</html>