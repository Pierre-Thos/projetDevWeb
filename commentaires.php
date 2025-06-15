<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "fonctions.php";
include_once "connection.php";
require_once "_header.php";
require_once "_menu.php";

//recuperer ID de recommendation du lien
$id = $_GET['id'];

//recuperer url pour l'attacher a la table commentaires
$fetchURL = "SELECT url FROM reco_item WHERE id=:id";
$stmt = $connexion->prepare($fetchURL);
$stmt->execute(['id' => $id]);
$url = $stmt->fetchColumn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['submitComment'])) {

        //Recuperer nom et message du commentaire depuis le form
        $nom = trim($_POST["nom"]);
        $message = trim($_POST["message"]);


        if (!empty($nom) && !empty($message)) {
            // Anti-spam : attendre 60 secondes entre deux envois
            if (isset($_SESSION['dernier_envoi']) && time() - $_SESSION['dernier_envoi'] < 60) {
                $_SESSION['erreur'] = "Merci d'attendre au moins 60 secondes entre deux commentaires.";
            } else {
                //Requete pour inserer commentaire dans la BDD
                $stmt = $connexion->prepare("INSERT INTO commentaires (nom, message, url) VALUES (:nom, :message, :url)");
                //$stmt = $connexion->prepare("INSERT INTO commentaires (nom, message) VALUES (:nom, :message)");
                $stmt->execute(['nom' => $nom, 'message' => $message, 'url' => $url]);
                //$stmt->execute(['nom' => $nom, 'message' => $message]);

                //Créer la variable dernier_envoi dans $_SESSION
                $_SESSION['dernier_envoi'] = time();

                //Créer la variable confirmation dans $_SESSION
                $_SESSION['confirmation'] = "Merci pour votre commentaire !";
            }
        } else {
            //Créer la variable erreur dans $_SESSION
            $_SESSION['erreur'] = "Tous les champs sont obligatoires.";
        }

        header("Location:reco.php?id=$id");
        exit(0);
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commentaires</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        form {
            margin-bottom: 30px;
        }

        textarea,
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: auto;
            cursor: pointer;
        }

        .commentaire {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }

        .message {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .erreur {
            color: red;
        }

        .confirmation {
            color: green;
        }
    </style>
</head>

<body>

    <h2>Laisser un commentaire</h2>

    <?php if (isset($_SESSION['confirmation'])): ?>
        <p class="messageConfirmation"><?= htmlspecialchars($_SESSION['confirmation']) ?></p>
        <?php unset($_SESSION['confirmation']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['erreur'])): ?>
        <p class="messageErreur"><?= htmlspecialchars($_SESSION['erreur']) ?></p>
        <?php unset($_SESSION['erreur']); ?>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <input type="submit" value="Envoyer" name="submitComment">
    </form>

    <h2>Commentaires récents</h2>
    <?php afficherCommentaires($connexion); ?>

</body>

</html>