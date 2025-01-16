<?php require "./bts/odhlasenko.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Přihlášení";
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
                    <h1 class="login__title">
                        <span>Vítejte </span>zpět
                    </h1>
                </div>
                <div>
                    <div class="login__inputs">
                        <label class="login__label">Jméno uživatele</label>
                        <input autocomplete="username" type="text" placeholder="Zadejte jméno uživatele" name="usrname" required class="login__input">
                    </div>

                    <div class="login__inputs">
                        <label class="login__label">Heslo</label>

                        <div class="login__box">
                            <input autocomplete="password" type="password" placeholder="Zadejte své heslo" name="Passwrd" required class="login__input" id="input-pass">
                            <i class="ri-eye-line login__eye" id="input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="login__check">
                    <input type="checkbox" class="login__check-input">
                    <label class="login__check-label">Zapamatuj si mě</label>
                </div>

                <div>
                    <div class="login__buttons">
                        <input type="submit" class="login__button" value="Přihlásit se" name="LOGIN_BUTTON">
                        <input type="submit" class="login__button login__button-ghost" value="Registrace" name="REG_BUTTON">
                    </div>

                    <a href="contact.php" class="login__forgot">Zapomněli jste heslo?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>

<!-- REGISTRACE -->

<?php 
    if (isset($_POST["REG_BUTTON"])) {
        $message = "";
    try {
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          $message = "Connection failed: ". $conn->connect_error;
          die();
      }

      $checkExistingUser = $conn->prepare("SELECT ID FROM users WHERE Username = ?");
      $checkExistingUser -> bind_param("s", $_POST['usrname'],);
      $checkExistingUser -> execute();
      $queryResult = $checkExistingUser -> get_result();
        if ($queryResult -> num_rows < 1) {
          $insertUser = $conn -> prepare("INSERT INTO users (Username, Passwrd, Date_Created) VALUES (?, ?, ?)");
          $hashedPassword = password_hash($_POST['Passwrd'], PASSWORD_BCRYPT);
          $insertUser -> bind_param("sss", $_POST['usrname'], $hashedPassword, date("d. m. Y"));
          if ($insertUser -> execute()) {
            $_SESSION["username"] = $_POST["usrname"];
            header("Location: ./index.php");
          }
          else {
            $message = $insertUser -> error;
          } 
        } 
        else {
          $message = "Uživatel s jménem '". $_POST['usrname'] . "' již má zaregistrovaný účet.";
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

// LOGIN

if (isset($_POST["LOGIN_BUTTON"])) {
    $message = "";
    try {
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          $message = "Connection failed: ". $conn->connect_error;
          die();
      }

      $checkExistingUser = $conn->prepare("SELECT ID,Passwrd FROM users WHERE Username = ?");
      $checkExistingUser -> bind_param("s", $_POST['usrname'],);
      $checkExistingUser -> execute();
      $queryResult = $checkExistingUser -> get_result();
      $result = $queryResult -> fetch_assoc();
        if ($queryResult -> num_rows == 1) {
            if(password_verify($_POST['Passwrd'], $result['Passwrd'])){
                $_SESSION["username"] = $_POST['usrname'];
                header("Location: ./");
            }
            else {
                $message = "Špatné přihlašovací údaje sigmo. *wink*";
              }
        } 
        else {
            $message = "Špatné přihlašovací údaje sigmo. *wink*";
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