<?php 
require "./bts/common.php"; 
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $playlistData = $conn -> prepare("SELECT * FROM `playlisty` WHERE ID = ?");
    $playlistData -> bind_param("i",$_GET['PlaylistID']);
    $playlistData -> execute();
    $queryResult = $playlistData -> get_result();
    $result = $queryResult -> fetch_assoc();
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
    <section class="playlist-details">
        <section class="playlist-details section">
            <div class="row">
               <div class="column">
            
                  <div class="thumb">
                     <img src="<?php echo $result['PlThumbnail']?>" alt="">
                     <span><?php 
                        $splitington = explode(",", $result['VIDEO_ID']);
                        echo count($splitington) . " Videa";
                        ?></span>
                  </div>
               </div>
               <div class="column">

                  <div class="details">
                    <h3><?php                     
                        echo $result["PlName"];
                    ?></h3>
                     <p><?php                     
                        echo $result["Description"];
                    ?></p>
                  </div>

                  <div class="tutor">
                   <img src="img/pfp.jpg" alt="">
                     <div>
                        <h3><?php                     
                        echo $result["CreatedBy"];
                    ?></h3>
                        <span>09. 12. 2024</span>
                     </div>
                  </div>

                <form method="post" class="save-playlist">
                    <button> <i class="ri-bookmark-line"></i><input name = "SavePlaylist" type="submit" value = "Uložit playlist"></button>
                 </form>
                 <?php
                 if(isset($_POST['SavePlaylist'])){
                    if($_SESSION["username"] != null){
                        $playlistsSaved = explode(",", mysqli_fetch_assoc($conn -> query("SELECT Pl_Saved FROM users WHERE Username = '".$_SESSION["username"]."'"))["Pl_Saved"]);      
                        $playlistsSaved[] = (string) $result["ID"];
                        $playlistsSaved = implode(",", $playlistsSaved);
                        $conn -> query("UPDATE users SET Pl_Saved = '".$playlistsSaved."' WHERE Username = '".$_SESSION["username"]."'");
                    }
                    else{
                        echo "Musíš být přihlášen, abys mohl uložit playlist.";
                    };
                }
                 ?>
               </div>
            </div>
         </section>
         
         <section class = "projects section">
            <h2 class="section__title">Videa v playlistu</h2>
            <div class="projects__container container grid">
                <?php
                foreach($splitington as $video_id){
                    $VideoData = $conn -> prepare("SELECT * FROM `videa` WHERE ID = ?");
                    $VideoData -> bind_param("i", $video_id);
                    $VideoData -> execute();
                    $queryResult = $VideoData -> get_result();
                    $result = $queryResult -> fetch_assoc();
                echo'
                <article class="projects__card">
                    <a href="video.php?VideoID='. $video_id .'" class="projects__image"><img src="'. $result["Thumbnail"] .'" alt="image" class="projects__img">
                    </a>
        
                    <div class="projects__data">
                        <h3 class="projects__name">'. $result["VidName"] .'</h3>
                        <p class="projects__description">'. $result["Description"].'.</p>
                    </div>

                    <a href="video.php?VideoID='. $video_id .'" class="projects__button">
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
        $conn -> close();
        ?>
</section>
</body>
</html>