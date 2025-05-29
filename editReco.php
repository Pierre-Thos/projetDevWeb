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

//query pour recuperer label, description et url de la recommendation depuis l'ID
$query = "SELECT label, description, url FROM reco_item WHERE id=:id";

$stmt_sql = $connexion->prepare($query);
$stmt_sql->execute(['id' => $id]);

$row = $stmt_sql->fetch(PDO::FETCH_ASSOC);

//label,desc,url recuperés de la BDD
$label = $row['label'];
$description = $row['description'];
$url = $row['url'];




//bloc pour mettre à jour la BDD depuis les valeurs entrées dans les champs input
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $inputLabel = $_POST['inputLabel'];
    $inputDescription = $_POST['inputDescription'];
    $inputUrl = $_POST['inputUrl'];
    $dateActuelle = date('Y-m-d H:i:s');


    //Requete SQL pour m.a.j. label, description, url
    $updateReco = "UPDATE reco_item SET label = :inputLabel, description = :inputDescription, url = :inputUrl, updated_at = :dateActuelle WHERE id=:id";

    $stmtUpdate = $connexion->prepare($updateReco);
    $stmtUpdate->execute(['id' => $id, 'inputLabel' => $inputLabel, 'inputDescription' => $inputDescription, 'inputUrl' => $inputUrl, 'dateActuelle' => $dateActuelle]);
    header("Location:adminReco.php?msg=Recommendation mise à jour");    
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modification d'une recommendation</title>
</head>

<body>
    <h1>Modification d'une recommendation</h1>
    <form method="POST">
        <div>
            <label for="inputLabel" >Label</label>
            <input type="text" id="inputLabel" name="inputLabel" required value="<?php echo htmlspecialchars($label); ?>">
        </div>
        <div>
            <label for="inputDescription">Description</label>
            <input type="text" id="inputDescription" name="inputDescription" required value="<?php echo htmlspecialchars($description);  ?>" >
        </div>
        <div>
            <label for="inputUrl">URL</label>
            <input type="text" id="inputUrl" name="inputUrl" required value="<?php echo htmlspecialchars($url);  ?>" >
        </div>
        <button type="submit">Update</button>
    </form>
</body>

</html>