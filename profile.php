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
            <img src="./img/profile.jpg" alt="login image" class="profile_img">
                <div class="login_form">
                    <div class="responsive">
                        <form method="post"  enctype="multipart/form-data">
                            <h2 class="pfp_label">Změna profilového obrázku</h2>
                            <img src="<?php echo $userpic ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;" class="pfp_upload" alt="profile_picture">
                            <input class="pfp_upload" type="file" name="fileToUpload" id="fileToUpload">
                            <button class="login_button login_button-ghost" type="submit" name="submit"> Nahrát obrázek </button>
                        </form>
                        <form method="POST" >
                            <div class="login_buttons">
                            <input type="submit" class="logout_button" value="Odhlásit se" name="LOGOUT_BUTTON">
                            </div>
                        </form>
                    </div>
                </div>
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

    if(isset($_POST["submit"])){
        if(empty($_FILES["fileToUpload"]["name"])){
            $mesag = "Musíte vybrat obrázek, který chcete nahrát.";
        }else{
            // Zpracování nahrávání obrázku
            $target_dir = "./img/pfps/";
            $target_file = $target_dir . $_SESSION["username"] . ".jpg";
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Kontrola, zda je obrázek skutečně obrázkem
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Kontrola, zda soubor již existuje
        if (file_exists($target_file)) {
            unlink($target_file);
            $nejakapromena = 1;
        }

        //Kontrola jestli $uploadOk je 0 nebo 1
        if ($uploadOk == 0) {
            $mesag = "Omlouváme se, obrázek nebyl nahrán.";
        // pokud je vše v pořádku, pokusíme se nahrát soubor
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $mesag = "Obrázek byl úspěšně nahrán.";
                // Aktualizace cesty k profilovému obrázku v databázi
                if(isset($nejakapromena)){   
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    $updateQuery = $conn->prepare("UPDATE users SET ProfilePic = ? WHERE Username = ?");
                    $updateQuery->bind_param("ss", $target_file, $_SESSION["username"]);
                    $updateQuery->execute();
                    $updateQuery->close();
                    mysqli_close($conn);
                }
            } else {
                $mesag = "Omlouváme se, došlo k chybě při nahrávání obrázku.";
            }
        }
    }
}
    ?>
</body>
<?php
if(isset($mesag)){
    echo '<script type="text/javascript">alert("'.$mesag.'");</script>';
}
?>
</html>