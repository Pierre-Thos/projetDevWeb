<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Connexion à la BDD
    require_once "connection.php";

    //Recupérer valeurs depuis le form
    $password = $_POST['password'];
    $email = $_POST['email'];


    //Recherche si user existe
    $verification = "SELECT * FROM user WHERE email = :email";
    $stmtVerif = $connexion->prepare($verification);
    $stmtVerif->execute([
        ':email' => $email
    ]);
    $user = $stmtVerif->fetch(PDO::FETCH_ASSOC);
    var_dump($user);

    if (!$user) {
        header("Location:login.php?msg=Utilisateur non trouvé");
        exit(0);
    }

    //Check du password
    if (!password_verify($password, $user['password'])) {
        header("Location:login.php?msg=Mot de passe incorrect");
        exit(0);
    }

    //Creation de la session
    session_start();
    $_SESSION['user'] = $user;

    //Redirection vers profile.php ou login avec le message d'erreur
    header("Location:profile.php");

}
$msg = isset($_GET['msg']) ? $_GET['msg'] : false;

?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once "_header.php";
require_once "_menu.php";
?>

<body>
    <form action="" method="POST">
        <h1>Login</h1>

        <?php if ($msg) { ?>
            <div class="messageErreur"><?php echo $msg; ?></div>
        <?php } ?>


        <div>
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>

</html>