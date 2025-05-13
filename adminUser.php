<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@gmail.com') {
    header("Location:login.php?msg=Acces non autorise");
    exit(0);
}

include_once "connection.php";
$fetchUsers = "SELECT * FROM user"; //Requete pour prendre infos des users
$stmt = $connexion->query($fetchUsers);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Code pour effacer une entree dans la BDD avec le ID
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $deleteUser = "DELETE FROM user WHERE id = :id";

    $id = $_POST['deleteID'];
    $stmtDelete = $connexion->prepare($deleteUser);
    $stmtDelete->execute(['id' => $id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once "_header.php";
require_once "_menu.php";   
?>

<body>
    <table class="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $entry) { ?>
                <tr>
                    <td><?php echo $entry['id'] ?></td>
                    <td><?php echo $entry['username'] ?></td>
                    <td><?php echo $entry['email'] ?></td>
                    <td><img src="..    /img/edit_icon.png" alt=""></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="deleteID" value="<?php $rows['id'] ?>">
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>