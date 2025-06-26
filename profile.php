<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location:login.php?msg=Vous n'êtes pas connecté");
    exit;
}

include "_menu.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .welcome-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
            width: 350px;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 25px;
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user']['username']); ?> !</h1>
        <p>Votre email : <?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>