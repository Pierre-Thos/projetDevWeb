<?php
session_start();
include "_menu.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once "connection.php";

    $password = $_POST['password'];
    $email = $_POST['email'];

    $verification = "SELECT * FROM user WHERE email = :email";
    $stmtVerif = $connexion->prepare($verification);
    $stmtVerif->execute([
        ':email' => $email
    ]);
    $user = $stmtVerif->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location:login.php?msg=Utilisateur non trouvé");
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        header("Location:login.php?msg=Mot de passe incorrect");
        exit;
    }

    $_SESSION['user'] = $user;
    header("Location:profile.php");
    exit;
}

$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
        }

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
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .messageErreur {
            background-color: #ffdddd;
            border: 1px solid #ff5c5c;
            color: #a94442;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
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
        <h1>Connexion</h1>

        <?php if ($msg): ?>
            <div class="messageErreur"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <div>
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
</body>
</html>