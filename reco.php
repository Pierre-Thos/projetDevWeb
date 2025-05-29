<?php
session_start();
include "connection.php";

$id = $_GET['id'];
$sql = "SELECT * FROM reco_item WHERE id=:id";

$stmt_sql = $connexion->prepare($sql);
$stmt_sql->execute(['id' => $id]);

$row = $stmt_sql->fetch(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "_header.php"; ?>
    <title>Recommandation de film</title>
</head>

<body>
    <?php require_once "_menu.php"; ?>
    <h1>
        <?php
        echo $row['label'];
        ?>
    </h1>
    <p>
        <?php
        echo $row['description'];
        ?>
        <a href="<?php $row['url']; ?>">
            Link to Movie
        </a>
    </p>
</body>

</html>