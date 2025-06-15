<?php
include "connection.php";
include "_header.php";


?>

<?php function afficherCommentaires(PDO $connexion)
{

    $recoID = $_GET['id'];
    $stmt = $connexion->prepare("SELECT url FROM reco_item WHERE id=:recoID");
    $stmt->execute(['recoID' => $recoID]);
    $url = $stmt->fetchColumn();

    //Requete pour afficher tout les commentaires (les plus récents d'abord)
    $requete = "SELECT * FROM commentaires INNER JOIN reco_item ON commentaires.url = reco_item.url WHERE reco_item.url = ? ORDER BY date_commentaire DESC";
    //$requete = "SELECT * FROM commentaires WHERE url IN (SELECT url FROM reco_item)";
    $resultat = $connexion->prepare($requete);
    $resultat->execute([$url]);

    //Stockage du resultat dans la variable $rows
    $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);


    //Code pour effacer une entree dans la BDD avec le ID
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //if (isset($_POST['deleteID'])) {
            $id = $_POST['deleteID'];

            $deleteComm = "DELETE FROM commentaires WHERE id = :id";

            $stmtDelete = $connexion->prepare($deleteComm);
            $stmtDelete->execute(['id' => $id]);
       // }
    }

    if ($rows !== null) {
        foreach ($rows as $ligne) {
            //Affiche les commentaires
            echo "<div class='commentaire'>";
            echo "<strong>" . htmlspecialchars($ligne['nom']) . "</strong> <em>(" . $ligne['date_commentaire'] . ")</em>" . htmlspecialchars("\t");
            echo "<button><a href='editComm.php?id=" . $ligne['id'] . "'>Edit</a></button>";
            echo "<form method='POST' onsubmit=\"return confirm('Etes vous sur de vouloir supprimer?')\">";
            echo "<input type='hidden' name='deleteID' value='" . $ligne['id'] . "'>";
            echo "<button>Delete</button>";
            echo "</form>";
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