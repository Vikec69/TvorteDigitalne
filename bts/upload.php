<?php
// Připojení k databázi
require_once "bts/common.php";

// Zkontroluj, zda byl obrázek odeslán
if(isset($_POST['submit'])) {

    // Zkontroluj, zda byl soubor nahrán
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        
        // Získání informace o souboru
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
        $fileName = $_FILES['fileToUpload']['name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileType = $_FILES['fileToUpload']['type'];

        // Získání přípony souboru
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Povolené formáty souborů
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Zkontroluj, jestli má soubor správný formát
        if(in_array($fileExtension, $allowedExtensions)) {

            // Cesta k uložení souboru
            $uploadDir = './img/pfps/';
            if(!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Vytvoření unikátního jména souboru
            $newFileName = $_SESSION['username'] . '.' . $fileExtension;
            $uploadPath = $uploadDir . $newFileName;

            // Přesun souboru na cílové místo
            if(move_uploaded_file($fileTmpPath, $uploadPath)) {
                
                // Připojení k databázi a aktualizace cesty k obrázku v databázi
                try {
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    
                    // Připravíme SQL dotaz pro aktualizaci profilového obrázku
                    $updateQuery = "UPDATE users SET ProfilePic = ? WHERE Username = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param("ss", $uploadPath, $_SESSION['username']);
                    
                    // Spustíme dotaz
                    if($stmt->execute()) {
                        echo '<script>alert("Profilový obrázek byl úspěšně změněn!");</script>';
                    } else {
                        echo '<script>alert("Došlo k chybě při změně profilového obrázku.");</script>';
                    }
                    $stmt->close();
                    $conn->close();
                } catch (Exception $e) {
                    echo "Chyba při připojení k databázi: " . $e->getMessage();
                }
            } else {
                echo '<script>alert("Došlo k chybě při nahrávání souboru.");</script>';
            }
        } else {
            echo '<script>alert("Neplatný formát souboru. Povolené formáty jsou: jpg, jpeg, png, gif.");</script>';
        }
    } else {
        echo '<script>alert("Nahrávání souboru selhalo. Zkuste to znovu.");</script>';
    }
}
?>
