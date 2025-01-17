<?php require "./bts/common.php"; ?>
   <!DOCTYPE html>
    <html lang="cs">
    <head>
       <?php 
    try{
       $nazevstr= "Video";
       require "./layout/hlava.php";
       $videoID = $_GET["VideoID"];
       $conn = mysqli_connect($servername, $username, $password, $dbname);
       $VideoData = $conn -> prepare("SELECT * FROM `videa` WHERE ID = ?");
       $VideoData -> bind_param("i",$_GET['VideoID']);
       $VideoData -> execute();
       $queryresult = $VideoData -> get_result();
       $result = $queryresult -> fetch_assoc();
       $like = "lajků";
       if ($result["LikedBy"] == "") {
         $likes = 0;
       } else {
         $likes = count(explode(separator:",", string: $result["LikedBy"]));
         if ($likes == 1) {
            $like = "lajk";
         } else if ($likes <= 4) {
            $like = "lajky";
         }
       }
       $UserData = $conn -> prepare("SELECT * FROM `users` WHERE Username = ?");
       $UserData -> bind_param("s",$_SESSION["username"]);
       $UserData -> execute();
       $queryresult = $UserData -> get_result();
       $UserResult = $queryresult-> fetch_assoc();  
       $uploaderPic = $conn -> prepare("SELECT * FROM `users` WHERE Username = ?");
       $uploaderPic -> bind_param("s",$result["UploadedBy"]);
       $uploaderPic -> execute();
       $uploaderPicQresult = $uploaderPic -> get_result();
       $uploaderPicResult = $uploaderPicQresult-> fetch_assoc();
       $pocetkom = mysqli_num_rows($conn -> query("SELECT * FROM `komentare` WHERE VIDEO_ID = $videoID"));
       $Komentare = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `komentare` WHERE VIDEO_ID = $videoID"), MYSQLI_ASSOC);
       if (isset($_POST["addcomment"])){
          if($_SESSION["username"] != null){
             $insertcom = $conn -> prepare("INSERT INTO komentare (Content, WrittenBy, DateWritten, VIDEO_ID) VALUES (?,?,?,?)");
             $today = date("d. m. Y");
             $insertcom -> bind_param("sssi", $_POST['add_comment'], $_SESSION['username'], $today, $_GET["VideoID"]);
             $insertcom -> execute();
             header("Refresh:0");
            } else{
               header("Location: ./login.php");
            }}
            if (isset($_POST["delete_comment"])){
               mysqli_query($conn, "DELETE FROM komentare WHERE ID = ".$_POST['commentID']);
               header("Refresh:0");
       }
       if (isset($_POST["LIKE_BTN"])){
         if ($_SESSION["username"] == null){
            header("Location: ./login.php");
         } else {
            $addLike = $conn -> prepare("UPDATE videa set LikedBy=? WHERE ID=?");
            $likes = explode(separator:",", string: $result["LikedBy"]);
            if (in_array($UserResult["ID"], $likes)){
               unset($likes[array_search($UserResult["ID"], $likes)]);
            } else{
               $likes[] = (string) $UserResult["ID"];
            }
            $likes = implode(",", $likes);
            $likes = ltrim($likes, ",");
            $addLike -> bind_param("si", $likes, $_GET['VideoID']);
            $addLike -> execute();
            header("Refresh:0");
         }
       }
      }
   finally{
      $conn -> close();
      $VideoData -> close();
      $UserData -> close();
      if (isset($addLike)){
         $addLike-> close();
      }
      if (isset($uploaderPic)){
         $uploaderPic-> close();
      }
   }
    ?>
    </head>
    <body>
    <?php 
    $active3 = "active-link";
    require "./layout/navbar.php";
    ?>
<section class="watch-video">
    <div class="video-container">
       <div class="video">
          <video src="<?php echo $result['Location'] ?>" controls poster="./img/prthumb.jpg" id="video"></video>
       </div>
       <h3 class="title"><?php echo $result['VidName'] ?></h3>
       <div class="stats">
          <p class="date"><i class="ri-calendar-line"></i><span><?php echo $result['DateUploaded'] ?></span></p>
          <p class="date"><i class="ri-heart-line"></i><span><?php echo $likes." ". $like ?></span></p>
       </div>
       <div class="tutor">
          <img src="<?php echo $uploaderPicResult['ProfilePic']?>" alt="">
          <div>
             <h3><?php echo $result['UploadedBy'] ?></h3>
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
      <?php echo $pocetkom . " # Komentářů"?></h1>
   <form method="POST" class="add-comment">
       <h3>Přidat komentář</h3>
       <textarea type="text" name="add_comment" placeholder="Přidat komentář" required maxlength="1000" cols="30" rows="10" style="color:white"></textarea>
       <input type="submit" value="Přidat komentář" class="inline-btn" name="addcomment">
    </form>
    <?php
    try {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            foreach($Komentare as $Komentar){
                    $userpic = $conn -> prepare("SELECT ProfilePic FROM users WHERE Username = ?");
                    $userpic -> bind_param("s", $Komentar["WrittenBy"]);
                    $userpic -> execute();
                    $userpic = $userpic -> get_result() -> fetch_assoc();
                    $userpic = $userpic["ProfilePic"];
        echo'
               <div class="box-container">
                  <div class="box">
                     <div class="user">
                        <img src="'.$userpic.'" alt="">
                        <div>
                           <h3>'. $Komentar["WrittenBy"] .'</h3>
                           <span>'. $Komentar["DateWritten"] .'</span>
                        </div>
                     </div>
                     <div class="comment-box">'. $Komentar["Content"] .'</div>';
                  if($Komentar["WrittenBy"] == $_SESSION["username"]){
                     echo'
                     <form method="POST" class="flex-btn">
                        <input type="submit" value="Odstranit komentář" name="delete_comment" class="inline-delete-btn">
                        <input type="hidden" name="commentID" value="'.$Komentar["ID"].'">
                     </form>       
                  </div>
             </div>
               ';
            }
         }
} finally{
$conn -> close();
}
          ?>

 </section>
 <?php require "./layout/footer.html" ?>
</body>
</html>