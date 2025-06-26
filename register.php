<?php 
include "_menu.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $password = $_POST['password'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    require_once "connection.php";

    $sql = "INSERT INTO user (`username`, `email`, `password`) VALUES (:username, :email, :password)";
    $stmt =  $connexion->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header('Location:login.php?msg=Utilisateur créé');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #8e9eab);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .link-login {
            text-align: center;
            margin-top: 15px;
        }

        .link-login a {
            text-decoration: none;
            color: #007bff;
        }

        .link-login a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            form {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <h1>Créer un compte</h1>

        <div>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div>
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required minlength="6">
        </div>

        <div>
            <input type="submit" value="S'inscrire">
        </div>

        <div class="link-login">
            <p>Déjà un compte ? <a href="login.php">Connecte-toi ici</a></p>
        </div>
    </form>
</body>
</html>