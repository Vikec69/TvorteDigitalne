<?php
require './bts/common.php'; // připojení k databázi

if (isset($_POST['submit'])) {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        // Získání komentáře a ID uživatele
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $username = $_SESSION['username']; 

        // Příprava dotazu pro vložení komentáře do databáze
        $query = "INSERT INTO komentare (Username, Content, DateWritten) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $comment);

        // Provedení dotazu
        if ($stmt->execute()) {
            echo "Komentář byl úspěšně přidán!";
        } else {
            echo "Chyba při přidávání komentáře.";
        }

        // Uzavření přípravy a spojení
        $stmt->close();
        $conn->close();
    } else {
        echo "Komentář nemůže být prázdný.";
    }
}
?>
