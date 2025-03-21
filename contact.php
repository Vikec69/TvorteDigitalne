<?php require "./bts/common.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<?php 
    $nazevstr= "Kontakt";
    require "./layout/hlava.php";
    ?>
</head>
<body>
<div id="flex-container">
<?php 
    $active5 = "active-link";
    require "./layout/navbar.php";
    ?>
    <section class="contact section">
        <h2 class="section_title">KONTAKTUJ MĚ</h2>
        <div class="contact_container container grid">
            <form action="" class="contact_form grid" id="contact-form">
                <div class="contact_group grid">
                    <input type="text" name="user_name" placeholder="Jméno" required class="contact_input">
                    <input type="email" name="user_email" placeholder="Email" required class="contact_input">
                </div>
                <textarea name="user_message" placeholder="Zpráva" class="contact_input contact_area"></textarea>
                <button type="submit" class="button contact_button">Poslat zprávu</button>
                <p class="contact_message" id="contact-message"></p>
            </form>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="js/mail.js"></script>
</body>
</html>