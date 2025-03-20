<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Návody";
    require "./layout/hlava.php";
    require "./bts/common.php"; 
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $activeFilter = $_GET['filter'] ?? 'all';
    $playlistData = $conn->query("SELECT * FROM `playlisty`");
    $active3 = "active-link";
    require "./layout/navbar.php";
    ?>
</head>
<body>
<div id="flex-container">
<section class="projects section">
    <h2 class="section_title">Návody</h2>
    <?php
    // Filtrační tlačítka
    if (isset($_SESSION["username"])) {
        echo '<form method="GET" style="display:flex; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
            <button type="submit" name="filter" class="login_button ' . ($activeFilter === 'all' ? '' : 'login_button-ghost') . '" style="width:auto;" value="all">Všechny playlisty</button>
            <button type="submit" name="filter" class="login_button ' . ($activeFilter === 'user' ? '' : 'login_button-ghost') . '" style="width:auto;" value="user">Mé playlisty</button>
        </form>';
    }
    ?>
    <div class="projects_container container grid">
<?php 

// Všechny playlisty
if ($activeFilter == "all") {
    if ($playlistData->num_rows > 0) {
        while ($row = $playlistData->fetch_assoc()) {
            echo '<article class="projects_card">
                    <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects_image"><img src="' . $row["PlThumbnail"] . '" alt="thumbnail" class="projects_img">
                    </a>
                    <div class="projects_data">
                        <h3 class="projects_name">' . htmlspecialchars($row["PlName"]) . '</h3>
                        <p class="projects_description">' . htmlspecialchars($row["Description"]) . '</p>
                    </div>
                    <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects_button">
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
        $savedPlaylists = $conn->prepare("SELECT playlisty.* FROM playlisty INNER JOIN SavedPl ON playlisty.ID = SavedPl.PlaylistID WHERE SavedPl.UserID = ?");
        $savedPlaylists->bind_param("i", $userID);
        $savedPlaylists->execute();
        $savedPlaylistsResult = $savedPlaylists->get_result();

        if ($savedPlaylistsResult->num_rows > 0) {
            while ($row = $savedPlaylistsResult->fetch_assoc()) {
                echo '<article class="projects_card">
                        <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects_image"><img src="' . $row["PlThumbnail"] . '" alt="thumbnail" class="projects_img">
                        </a>
                        <div class="projects_data">
                            <h3 class="projects_name">' . htmlspecialchars($row["PlName"]) . '</h3>
                            <p class="projects_description">' . htmlspecialchars($row["Description"]) . '</p>
                        </div>
                        <a href="playlist.php?PlaylistID='. $row["ID"] .'" class="projects_button">
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