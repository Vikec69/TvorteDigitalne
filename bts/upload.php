<?php
session_start();
require "../bts/common.php"; // připoj k databázi

if (isset($_POST['submit'])) {
    if (isset($_FILES['fileToUpload'])) {
        // Cesta k souboru, kam bude obrázek uložen
        $target_dir = "../img/pfps/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        // Získání rozšíření souboru
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Zkontroluj, jestli soubor je obrázek
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "Soubor je obrázek - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Soubor není obrázek.";
                $uploadOk = 0;
            }
        }

        // Zkontroluj, zda soubor již existuje
        if (file_exists($target_file)) {
            echo "Soubor již existuje.";
            $uploadOk = 0;
        }

        // Ověř velikost souboru
        if ($_FILES["fileToUpload"]["size"] > 500000) { // limit 500KB
            echo "Soubor je příliš velký.";
            $uploadOk = 0;
        }

        // Povolené formáty souborů
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Povolené formáty jsou JPG, JPEG, PNG a GIF.";
            $uploadOk = 0;
        }

        // Zkontroluj, zda je $uploadOk na 0, pokud byl problém s uploadem
        if ($uploadOk == 0) {
            echo "Soubor se nepodařilo nahrát.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Soubor byl úspěšně nahrán.";

                // Ulož cestu k souboru do databáze
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $newProfilePic = "img/pfps/" . basename($_FILES["fileToUpload"]["name"]);
                $updateQuery = $conn->prepare("UPDATE users SET ProfilePic = ? WHERE Username = ?");
                $updateQuery->bind_param("ss", $newProfilePic, $_SESSION["username"]);
                $updateQuery->execute();
                $conn->close();

                // Přesměruj zpět na profil
                header("Location: ../profil.php");
            } else {
                echo "Chyba při nahrávání souboru.";
            }
        }
    }
}
?>
