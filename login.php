<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Přihlášení";
    require "./layout/hlava.php";
    require "./bts/odhlasenko.php";
    $active4 = "active-link";
    require "./layout/navbar.php";
    ?>
    <div class="login__container">
        <div class="login__content">
            <img src="./img/login-bg.jpg" alt="login image" class="login__img">
            <form method="POST" class="login__form">
                <div>
                    <h1 class="login_title">
                        <span>Vítejte </span>zpět
                    </h1>
                </div>
                <div>
                    <div class="login_inputs">
                        <label class="login_label">Jméno uživatele</label>
                        <input autocomplete="username" type="text" placeholder="Zadejte jméno uživatele" name="usrname" class="login_input">
                    </div>

                    <div class="login_inputs">
                        <label class="login_label">Heslo</label>

                        <div class="login_box">
                            <input autocomplete="password" type="password" placeholder="Zadejte své heslo" name="Passwrd" class="login_input" id="input-pass">
                            <i class="ri-eye-line login_eye" id="input-icon"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="login_buttons">
                        <input type="submit" class="login_button" value="Přihlásit se" name="LOGIN_BUTTON">
                        <input type="button" class="login_button login_button-ghost" value="Registrovat" name="REG_BUTTON" onclick="location.href='register.php';">
                    </div>
                    <a href="./contact.php" class="login_forgot">Zapomněli jste heslo?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>

    <?php
// LOGIN

if (isset($_POST["LOGIN_BUTTON"])) {
    $message = "";
    try {
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          $message = "Connection failed: ". $conn->connect_error;
          die();
      }

      $checkExistingUser = $conn->prepare("SELECT ID,Passwrd,Username FROM users WHERE Username = ?");
      $checkExistingUser -> bind_param("s", $_POST['usrname'],);
      $checkExistingUser -> execute();
      $queryResult = $checkExistingUser -> get_result();
      $result = $queryResult -> fetch_assoc();
        if ($queryResult -> num_rows == 1) {
            if(password_verify($_POST['Passwrd'], $result['Passwrd'])){
                $_SESSION["username"] = $result["Username"];
                header("Location: ./");
            }
            else {
                $message = "Špatné přihlašovací údaje.";
              }
        } 
        else {
            $message = "Špatné přihlašovací údaje.";
          }
        
    } 
    finally {
        if(isset($insertUser)){
            $insertUser->close();
        }
        $queryResult->close();
        $checkExistingUser->close();
        $conn->close();
      if ($message) {
        echo '<script>
                alert("'.addslashes($message).'");
              </script>';
      }
  }

}
?>
</body>
</html>