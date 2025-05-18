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

//query pour recuperer le nom d'utilisateur et l'email depuis l'ID
$query = "SELECT username, email FROM user WHERE id=:id";

$stmt_sql = $connexion->prepare($query);
$stmt_sql->execute(['id' => $id]);

$row = $stmt_sql->fetch(PDO::FETCH_ASSOC);

//username et email recuperée de la BDD
$username = $row['username'];
$email = $row['email'];


//bloc pour mettre à jour la BDD depuis les valeurs entrées dans les champs input
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $inputUsername = $_POST['inputUsername'];
    $inputEmail = $_POST['inputEmail'];
    $dateActuelle = date('Y-m-d H:i:s');


    //Requete SQL pour m.a.j. username et email
    $updateUser = "UPDATE user SET username = :inputUsername, email = :inputEmail, updated_at = :dateActuelle WHERE id=:id";

    $stmtUpdate = $connexion->prepare($updateUser);
    $stmtUpdate->execute(['id' => $id, 'inputUsername' => $inputUsername, 'inputEmail' => $inputEmail, 'dateActuelle' => $dateActuelle]);
    header("Location:adminUser.php?msg=Utilisateur mis à jour");    
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modification d'utilisateur</title>
</head>

<body>
    <h1>Modification d'utilisateur</h1>
    <form method="POST">
        <div>
            <label for="inputUsername" >Username</label>
            <input type="text" id="inputUsername" name="inputUsername" required value="<?php echo htmlspecialchars($username); ?>">
        </div>
        <div>
            <label for="inputEmail">Email</label>
            <input type="email" id="inputEmail" name="inputEmail" value="<?php echo htmlspecialchars($email);  ?>" >
        </div>
        <button type="submit">Update</button>
    </form>
</body>

</html>