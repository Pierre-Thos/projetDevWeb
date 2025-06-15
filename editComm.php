<?php
session_start();

require_once "_header.php";
require_once "_menu.php";
include_once "connection.php";

//Verification du statut de l'utilisateur (doit etre admin pour acceder a cette page)
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@gmail.com') {
    header("Location:login.php?msg=Acces non autorise");
    exit(0);
}

//recupere le id depuis l'URL
$id = $_GET['id'];

//query pour recuperer infos du commentaire depuis l'ID
$query = "SELECT nom, message, date_commentaire FROM commentaires WHERE id=:id";

$stmt_sql = $connexion->prepare($query);
$stmt_sql->execute(['id' => $id]);

$row = $stmt_sql->fetch(PDO::FETCH_ASSOC);

//Variable du commentaire
$nom = $row['nom'];
$message = $row['message'];
$date_commentaire = $row['date_commentaire'];




//bloc pour mettre à jour la BDD depuis les valeurs entrées dans les champs input
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $inputNom = $_POST['inputNom'];
    $inputMessage = $_POST['inputMessage'];
    $inputDate = $_POST['inputDate'];


    //Requete SQL pour m.a.j. Nom, Message, Date
    $updateComm = "UPDATE commentaires SET nom = :inputNom, message = :inputMessage, date_commentaire = :inputDate WHERE id=:id";

    $stmtUpdate = $connexion->prepare($updateComm);
    $stmtUpdate->execute(params: ['id' => $id, 'inputNom' => $inputNom, 'inputMessage' => $inputMessage, 'inputDate' => $inputDate]);
    header("Location:index.php?msg=Commentaire mis à jour");    
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modification de commentaire</title>
</head>

<body>
    <h1>Modification de commentaire</h1>
    <form method="POST">
        <div>
            <label for="inputNom" >Nom</label>
            <input type="text" id="inputNom" name="inputNom" required value="<?php echo htmlspecialchars($nom); ?>">
        </div>
        <div>
            <label for="inputMessage">Message</label>
            <input type="text" id="inputMessage" name="inputMessage" required value="<?php echo htmlspecialchars($message);  ?>" >
        </div>
        <div>
            <label for="inputDate">Date du Commentaire</label>
            <input type="text" id="inputDate" name="inputDate" required value="<?php echo htmlspecialchars($date_commentaire);  ?>" >
        </div>
        <button type="submit">Update</button>
    </form>
</body>

</html>