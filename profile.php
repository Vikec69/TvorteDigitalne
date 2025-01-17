<?php require "./bts/prihlasenko.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Profil";
    require "./layout/hlava.php";
    ?>
</head>
<body>
<?php 
    $active4 = "active-link";
    require "./layout/navbar.php";
    ?>
    <div class="login__container">
        <div class="login__content">
            <img src="img/Untitled-2.png" alt="login image" class="login__img">
            <form method="POST" class="login__form">
                <div>
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