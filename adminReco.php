<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@gmail.com') {
    header("Location:login.php?msg=Acces non autorise");
    exit(0);
}

include_once "connection.php";

//Code pour effacer une entree dans la BDD avec le ID
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $deleteReco = "DELETE FROM reco_item WHERE id = :id";

    $id = $_POST['deleteID'];
    $stmtDelete = $connexion->prepare($deleteReco);
    $stmtDelete->execute(['id' => $id]);
}

$fetchReco = "SELECT * FROM reco_item"; //Requete pour prendre infos des Reco
$stmt = $connexion->query($fetchReco);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "_menu.php";


?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once "_header.php";

?>

<body>
    <h1>Page Admin Recommendations</h1>
    <br>
    <table class="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Label</th>
                <th>Description</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $entry) { ?>
                <tr>
                    <td><?php echo $entry['id'] ?></td>
                    <td><?php echo $entry['label'] ?></td>
                    <td><?php echo $entry['description'] ?></td>
                    <td><?php echo $entry['url'] ?></td>
                    <!-- <td><img src="../img/edit_icon.png" alt=""></td> -->
                    <td>
                        <form method="POST" onsubmit="return confirm('Etes vous sur de vouloir supprimer?')">
                            <input type="hidden" name="deleteID" value="<?php echo $entry['id'] ?>">
                            <button>Delete</button>
                        </form>
                    </td>
                    <td><button><a href="editReco.php?id=<?php echo $entry['id']; ?>">Edit</a></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>