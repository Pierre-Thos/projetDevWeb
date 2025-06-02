<?php
include "connection.php";
?>
<?php function afficherCommentaires(PDO $connexion)
{
    //Requete pour afficher tout les commentaires (les plus récents d'abord)
    $requete = "SELECT nom, message, date_commentaire FROM commentaires ORDER BY date_commentaire DESC";
    $resultat = $connexion->query($requete);

    //Stockage du resultat dans la variable $rows
    $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

    if ($rows !== null) {
        foreach ($rows as $ligne) {
            //Affiche les commentaires
            echo "<div class='commentaire'>";
            echo "<strong>" . htmlspecialchars($ligne['nom']) . "</strong> <em>(" . $ligne['date_commentaire'] . ")</em><br>";
            echo nl2br(htmlspecialchars($ligne['message']));
            echo "</div>";

        }
    } else {
        ?>
        <p>Aucun commentaire pour le moment.</p>
        <?php
    }
}
?>