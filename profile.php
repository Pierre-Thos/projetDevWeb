<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location:login.php?msg=Vous n'etes pas connecté");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "_header.php";
?>

<body>
    <?php require_once "_menu.php";?>


    <h1>Profile</h1>

    <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
</body>
</html>