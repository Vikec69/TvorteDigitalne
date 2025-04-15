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
</head>
<body>
    <div class="login_container">
        <div class="login_content">
            <img src="./img/reg.jpg" alt="login image" class="login_img">
            <form method="POST" class="login_form">
                <div>
                    <h1 class="login_title">
                        <span>Vítejte </span>
                    </h1>
                </div>
                <div>
                    <div class="login_inputs">
                        <label class="login_label">Jméno uživatele</label>
                        <input autocomplete="username" type="text" placeholder="Zadejte jméno nového uživatele" name="usrname" class="login_input">
                    </div>

                    <div class="login_inputs">
                        <label class="login_label">Heslo</label>

                        <div class="login_box">
                            <input autocomplete="password" type="password" placeholder="Zadejte nové jedinečné heslo" name="Passwrd" class="login_input" id="input-pass">
                            <i class="ri-eye-line login_eye" id="input-icon"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="login_buttons">
                        <input type="button" class="login_button login_button-ghost" value="Přihlásit se" name="LOGIN_BUTTON" onclick="location.href='login.php';">
                        <input type="submit" class="login_button" value="Registrovat" name="REG_BUTTON" >
                    </div>
                    <a href="./contact.php" class="login_forgot">Zapomněli jste heslo?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>

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
      $checkExistingUser -> bind_param("s", $_POST['usrname']);
      $checkExistingUser -> execute();
      $queryResult = $checkExistingUser -> get_result();
        if ($queryResult -> num_rows < 1) {
          $insertUser = $conn -> prepare("INSERT INTO users (Username, Passwrd, Date_Created) VALUES (?, ?, ?)");
          $hashedPassword = password_hash($_POST['Passwrd'], PASSWORD_BCRYPT);
          $insertUser -> bind_param("sss", $_POST['usrname'], $hashedPassword, date("Y-m-d"));
          if ($insertUser -> execute()) {
            $_SESSION["username"] = $_POST["usrname"];
            header("Location: ./index.php");
          }
          else {
            $message = $insertUser -> error;
          } 
        } 
        else {
          $message = "Uživatel již existuje.";
        }
    } 
    finally {
        $conn->close();
  }
  if ($message) {
    echo '<script>
            alert("'.addslashes($message).'");
          </script>';
  }

}

?>
</body>
</html>