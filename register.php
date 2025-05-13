<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo "form envoyé !";

        //Recuperation des donnees de la BDD
        $password = $_POST['password'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        
        
        require_once "connection.php";

        //Insertion des donnees
        $sql = "INSERT INTO user (`username`, `email`, `password`) VALUES (:username, :email, :password)";
        $stmt =  $connexion->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header('Location:login.php?msg=Utilisateur créé');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        require_once "_header.php";
        require_once "_menu.php";
    ?>

<body>
    <form action="" method="POST">
        <h1>Register</h1>
        <div>
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password">
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>

</html>