<?php 
require "./bts/common.php"; 
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <?php 
    try {
        $nazevstr = "Video";
        require "./layout/hlava.php";
        $videoID = $_GET["VideoID"];
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Získání dat o videu
        $VideoData = $conn->prepare("SELECT * FROM `videa` WHERE ID = ?");
        $VideoData->bind_param("i", $videoID);
        $VideoData->execute();
        $queryresult = $VideoData->get_result();
        $result = $queryresult->fetch_assoc();

        // Počet lajků
        $like = "lajků";
        $likes = mysqli_num_rows($conn->query("SELECT * FROM `likedby` WHERE VidID = $videoID"));
        if ($likes == 0) {
            $like = "lajků";
        } else if ($likes == 1) {
            $like = "lajk";
        }
        else if ($likes <= 4) {
         $like = "lajky";
      }
      

        // Získání uživatelských dat pro aktuálního uživatele
        $UserData = $conn->prepare("SELECT * FROM `users` WHERE Username = ?");
        $UserData->bind_param("s", $_SESSION["username"]);
        $UserData->execute();
        $queryresult = $UserData->get_result();
        $UserResult = $queryresult->fetch_assoc();

         // Získání dat o uživatelském profilu uploadera (videa tam budu nahrávat jen já)
         $uploaderData = $conn->prepare("
            SELECT users.Username, users.ProfilePic
            FROM users
            LEFT JOIN videa ON videa.UploadedBy = users.ID
            WHERE videa.ID = ?
         ");
         $uploaderData->bind_param("i", $videoID);
         $uploaderData->execute();
         $uploaderDataResult = $uploaderData->get_result();
         $uploaderDataRow = $uploaderDataResult->fetch_assoc();

        // Počet komentářů
        $pocetkom = mysqli_num_rows($conn->query("SELECT * FROM `komentare` WHERE VIDEO_ID = $videoID"));
        
        // Získání komentářů a údajů o uživateli
        $query = "
        SELECT komentare.*, users.Username, users.ProfilePic
        FROM komentare
        LEFT JOIN users ON komentare.WrittenBy = users.ID
        WHERE komentare.VIDEO_ID = ?
         ";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("i", $videoID);
         $stmt->execute();
         $KomentareResult = $stmt->get_result();

        // Přidání komentáře
        if (isset($_POST["addcomment"])) {
            if ($_SESSION["username"] != null) {
                $insertcom = $conn->prepare("INSERT INTO komentare (Content, WrittenBy, DateWritten, VIDEO_ID) VALUES (?,?,?,?)");
                $today = date("Y-m-d");
                $insertcom->bind_param("sisi", $_POST['add_comment'], $UserResult["ID"] , $today, $_GET["VideoID"]);
                $insertcom->execute();
                header("Refresh:0");
            } else {
                header("Location: ./login.php");
            }
        }

        // Odstranění komentáře
        if (isset($_POST["delete_comment"])) {
            mysqli_query($conn, "DELETE FROM komentare WHERE ID = ".$_POST['commentID']);
            header("Refresh:0");
        }

        // Lajk nebo odlajknutí
        if (isset($_POST["LIKE_BTN"])) {
            if ($_SESSION["username"] == null) {
                header("Location: ./login.php");
            } else {
                // Zkontroluj, zda uživatel už dal like
                $checkLike = $conn->prepare("SELECT * FROM `likedby` WHERE VidID = ? AND UserID = ?");
                $checkLike->bind_param("ii", $_GET['VideoID'], $UserResult["ID"]);
                $checkLike->execute();
                $checkLikeResult = $checkLike->get_result();

                if ($checkLikeResult->num_rows > 0) {
                    // Uživatel už dal like, tak ho odeber
                    $deleteLike = $conn->prepare("DELETE FROM `likedby` WHERE VidID = ? AND UserID = ?");
                    $deleteLike->bind_param("ii", $_GET['VideoID'], $UserResult["ID"]);
                    $deleteLike->execute();
                } else {
                    // Uživatel dává like, přidej do tabulky
                    $addLike = $conn->prepare("INSERT INTO `likedby` (VidID, UserID) VALUES (?, ?)");
                    $addLike->bind_param("ii", $_GET['VideoID'], $UserResult["ID"]);
                    $addLike->execute();
                }

                header("Refresh:0");
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</head>
<body>
<?php 
$active3 = "active-link";
require "./layout/navbar.php";
$formattedDate = date("d-m-Y", strtotime($result["DateUploaded"]));
?>
<section class="watch-video">
    <div class="video-container">
        <div class="video">
            <video controls poster="<?php echo $result['Thumbnail']?>" id="video">
                <source src="<?php echo $result['Location']?>" type="video/mp4" />
            </video>
        </div>
        <h3 class="title"><?php echo $result['VidName'] ?></h3>
        <div class="stats">
            <p class="date"><i class="ri-calendar-line"></i><span><?php echo $formattedDate ?></span></p>
            <p class="date"><i class="ri-heart-line"></i><span><?php echo $likes . " " . $like ?></span></p>
        </div>
        <div class="tutor">
            <img src="<?php echo $uploaderDataRow['ProfilePic'] ?>" alt="Uploader's profile picture">
            <div>
                <h3><?php echo $uploaderDataRow['Username'] ?></h3>
            </div>
        </div>
        <p class="description">
        <?php echo $result['Description'] ?>
        </p>
        <form method="post" class="flex">
            <a href="playlist.php?PlaylistID=<?php echo $result['Playlist'] ?>" class="inline-btn">Playlist</a>
            <button type="submit" name="LIKE_BTN"><i class="ri-heart-line"></i><span>Like</span></button>
        </form>
    </div>
</section>

<section class="comments">
    <h1 class="heading">
        <?php
        $koment = "komentářů";
        if ($pocetkom == 0) {
           $koment = "komentářů";
       } else if ($pocetkom == 1) {
           $koment = "komentář";
       }
       else if ($pocetkom <= 4) {
        $koment = "komentáře";
     } 
        echo $pocetkom . " " . $koment
        ?></h1>
    <form method="POST" class="add-comment">
        <h3>Přidat komentář</h3>
        <textarea type="text" name="add_comment" placeholder="Přidat komentář" required maxlength="1000" cols="30" rows="10" style="color:white"></textarea>
        <input type="submit" value="Přidat komentář" class="inline-btn" name="addcomment">
    </form>

    <?php
    try {
        while ($Komentar = $KomentareResult->fetch_assoc()) {
            // Pokud není profilový obrázek, použijeme výchozí
            $userpic = $Komentar["ProfilePic"] ? $Komentar["ProfilePic"] : "./img/pfps/default.png";
            $username = $Komentar["Username"] ? $Komentar["Username"] : $Komentar["WrittenBy"];

            $formattedDW = date("d-m-Y", strtotime($Komentar["DateWritten"]));

            echo '
            <div class="box-container">
                <div class="box">
                    <div class="user">
                        <img src="'.$userpic.'" alt="Profile Picture">
                        <div>
                            <h3>'. $username .'</h3>
                            <span>'. $formattedDW .'</span>
                        </div>
                    </div>
                    <div class="comment-box">'. $Komentar["Content"] .'</div>';
                    if($Komentar["WrittenBy"] == $UserResult["ID"] ) {
                        echo '
                        <form method="POST" class="flex-btn">
                            <input type="submit" value="Odstranit komentář" name="delete_comment" class="inline-delete-btn">
                            <input type="hidden" name="commentID" value="'.$Komentar["ID"].'">
                        </form>       
                    </div>
                </div>
            ';
        }
    } }finally {
        $conn->close();
    } 
    ?>

</section>
<?php require "./layout/footer.html" ?>
</body>
</html>
