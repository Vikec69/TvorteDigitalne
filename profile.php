<?php 
require "./bts/prihlasenko.php"; 
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Profil";
    require "./layout/hlava.php";

    // Připojení k databázi
try{
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $userpiQ = $conn -> prepare("SELECT ProfilePic FROM users WHERE Username = ?");
    $userpiQ -> bind_param("s", $_SESSION["username"]);
    $userpiQ -> execute();
    $userpic = $userpiQ -> get_result() -> fetch_assoc();
    $userpic = $userpic["ProfilePic"];
}
finally{
    $conn -> close();
    if (isset($userpiQ)){
        $userpiQ -> close();
     }
}
    ?>
</head>
<!-- Změna profilového obrázku -->
<body>
<?php 
    $active4 = "active-link";
    require "./layout/navbar.php";
    ?>
    <div class="login_container">
        <div class="login_content">
            <img src="img/6073424.jpg" alt="login image" class="login_img">
            <form method="POST" class="login_form">
                <div class="responsive">
                    <form action="./bts/upload.php" method="post" enctype="multipart/form-data">
                        <h2 class="pfp_label">Změna profilového obrázku</h2>
                        <img src="<?php echo $userpic ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;" class="pfp_upload" alt="profile_picture">
                        <input class="pfp_upload" type="file" name="fileToUpload" id="fileToUpload">
                        <button class="login_button login_button-ghost" type="submit" name="submit"> Nahrát obrázek </button>
                    </form>
                    <div class="login_buttons">
                        <input type="submit" class="login_button" value="Odhlásit se" name="LOGOUT_BUTTON">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>

    <!-- Tlačítko na odhlášení -->
    <?php
    if(isset($_POST['LOGOUT_BUTTON'])){
       $_SESSION["username"] = null;
       echo '<script>
       alert("Byli jste odhlášeni");
        </script>';
        session_destroy();
        header("refresh:0");
    }
    ?>
</body>
</html>