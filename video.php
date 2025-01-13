<?php require "./bts/common.php"; ?>
   <!DOCTYPE html>
    <html lang="cs">
    <head>
    <?php 
    try{
      $nazevstr= "Video";
      require "./layout/hlava.php";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $VideoData = $conn -> prepare("SELECT * FROM `videa` WHERE ID = ?");
      $VideoData -> bind_param("i",$_GET['VideoID']);
      $VideoData -> execute();
      $queryresult = $VideoData -> get_result();
      $result = $queryresult -> fetch_assoc();
      $UserData = $conn -> prepare("SELECT * FROM `users` WHERE Username = ?");
      $UserData -> bind_param("s",$result['UploadedBy']);
      $UserData -> execute();
      $queryresult = $UserData -> get_result();
      $UserResult = $queryresult-> fetch_assoc();
   }
   finally{
      $conn -> close();
      $VideoData -> close();
      $UserData -> close();
   }
    ?>
    </head>
    <body>
    <?php 
    $active2 = "active-link";
    require "./layout/navbar.php";
    ?>
<section class="watch-video">
    <div class="video-container">
       <div class="video">
          <video src="<?php echo $result['Location'] ?>" controls poster="./img/pr thumb.jpg" id="video"></video>
       </div>
       <h3 class="title"><?php echo $result['VidName'] ?></h3>
       <div class="stats">
          <p class="date"><i class="ri-calendar-line"></i><span><?php echo $result['DateUploaded'] ?></span></p>
          <p class="date"><i class="ri-heart-line"></i><span>69 lajků</span></p>
       </div>
       <div class="tutor">
          <img src="<?php echo $UserResult['ProfilePic'] ?>" alt="">
          <div>
             <h3><?php echo $result['UploadedBy'] ?></h3>
          </div>
       </div>
       <p class="description">
       <?php echo $result['Description'] ?>
       </p>
       <form action="" method="post" class="flex">
         <a href="playlist.php?PlaylistID=<?php echo $result['Playlist'] ?>" class="inline-btn">Playlist</a>
         <button><i class="ri-heart-line"></i><span>Like</span></button>
      </form>
    </div>
 
 </section>
 
 <section class="comments">
 
    <h1 class="heading"># Komentářů</h1>
 
    <form action="" class="add-comment">
       <h3>Přidat komentář</h3>
       <textarea name="comment_box" placeholder="enter your comment" required maxlength="1000" cols="30" rows="10"></textarea>
       <input type="submit" value="Přidat komentář" class="inline-btn" name="add_comment">
    </form>
 
    <div class="box-container">
 
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>pikec</h3>
                <span>09. 12. 2024</span>
             </div>
          </div>
          <div class="comment-box">raketa vikecc</div>
          <form action="" class="flex-btn">
             <input type="submit" value="Odstranit komentář" name="delete_comment" class="inline-delete-btn">
          </form>
       </div>
 
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>trikec</h3>
                <span>09. 12. 2024</span>
             </div>
          </div>
          <div class="comment-box">awesome tutorial!
             keep going!</div>
       </div>
 
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>swag</h3>
                <span>09. 12. 2024</span>
             </div>
          </div>
          <div class="comment-box">amazing way of teaching!
             thank you so much!
          </div>
       </div>
 
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>hovnival</h3>
                <span>09. 12. 2024</span>
             </div>
          </div>
          <div class="comment-box">loved it, thanks for the tutorial!</div>
       </div>
 
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>john pork</h3>
                <span>09. 12. 20242</span>
             </div>
          </div>
          <div class="comment-box">this is what I have been looking for! thank you so much!</div>
       </div>
       <div class="box">
          <div class="user">
             <img src="img/pfp.jpg" alt="">
             <div>
                <h3>Meatball Martin</h3>
                <span>09. 12. 2024</span>
             </div>
          </div>
          <div class="comment-box">thanks for the tutorial!
             how to download source code file?
          </div>
       </div>
    </div>
 </section>
 <?php require "./layout/footer.html" ?>
</body>
</html>