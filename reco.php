<?php
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommandation de film</title>
</head>

<body>
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