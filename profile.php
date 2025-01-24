<?php require "./bts/prihlasenko.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Profil";
    require "./layout/hlava.php";

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
<body>
<?php 
    $active4 = "active-link";
    require "./layout/navbar.php";
    ?>
    <div class="login__container">
        <div class="login__content">
            <img src="img/6073424.jpg" alt="login image" class="login__img">
            <form method="POST" class="login__form">
                <div class="responsive">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <h2 class="pfp__label">Změna profilového obrázku</h2>
                        <img src="<?php echo $userpic ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;" class="pfp__upload" alt="profile_picture">
                        <input class="pfp__upload" type="file" name="fileToUpload" id="fileToUpload">
                        <button class="login__button login__button-ghost" type="submit" name="submit"> Nahrát obrázek </button>
                    </form>
                    <div class="login__buttons">
                        <input type="submit" class="login__button" value="Odhlásit se" name="LOGOUT_BUTTON">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>

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