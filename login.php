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
            <form action="" class="login__form">
                <div>
                    <h1 class="login__title">
                        <span>Vítejte </span>zpět
                    </h1>
                </div>
                <div>
                    <div class="login__inputs">
                        <label for="" class="login__label">Email</label>
                        <input type="email" placeholder="Zadejte emailovou adresu" required class="login__input">
                    </div>

                    <div class="login__inputs">
                        <label for="" class="login__label">Heslo</label>

                        <div class="login__box">
                            <input type="password" placeholder="Zadejte své heslo" required class="login__input" id="input-pass">
                            <i class="ri-eye-line login__eye" id="input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="login__check">
                    <input type="checkbox" class="login__check-input">
                    <label for="" class="login__check-label">Zapamatuj si mě</label>
                </div>

                <div>
                    <div class="login__buttons">
                        <button class="login__button">Přihlásit se</button>
                        <button class="login__button login__button-ghost">Registrace</button>
                    </div>

                    <a href="contact.php" class="login__forgot">Zapomněli jste heslo?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/hesla.js"></script>
</body>
</html>