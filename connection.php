<?php

//Parametres de connexion
$host = "localhost:4022";
$dbname = "reco";
$dbusername = "root";
$dbpassword = "root";


try {
    // Établir la connexion
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    
    // Configurer PDO pour afficher les erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Connexion réussie!";
} catch (PDOException $e) {
    echo "<p>Erreur de connection: " . $e->getMessage() . "<p>";
}

?>