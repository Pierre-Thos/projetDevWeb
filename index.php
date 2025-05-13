<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connection.php";

$sql = 'SELECT * FROM reco_item';

$stmt_sql = $connexion->query($sql);

$rows = $stmt_sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<?php require_once "_header.php"; ?>
<body>
    <?php require_once "_menu.php"; ?>
    <ul>
        <?php foreach ($rows as $item) { ?>
            <li>
                <a href="reco.php?id=<?php echo $item['id'];?>">
                    <?php echo $item['label']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>    
</body>
</html>
