<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@gmail.com') {
    header("Location:login.php?msg=Accès non autorisé");
    exit(0);
}

include_once "connection.php";

// Suppression utilisateur
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $deleteUser = "DELETE FROM user WHERE id = :id";
    $id = $_POST['deleteID'];
    $stmtDelete = $connexion->prepare($deleteUser);
    $stmtDelete->execute(['id' => $id]);
}

// Récupération des utilisateurs
$fetchUsers = "SELECT * FROM user";
$stmt = $connexion->query($fetchUsers);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des utilisateurs</title>
    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #8e9eab);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #222;
        }

        table.userTable {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table.userTable thead {
            background-color: #007bff;
            color: white;
        }

        table.userTable th,
        table.userTable td {
            padding: 15px 20px;
            text-align: left;
        }

        table.userTable tbody tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        table.userTable tbody tr:hover {
            background-color: #e6f0ff;
        }

        button,
        .btn-link {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        button:hover,
        .btn-link:hover {
            background-color: #0056b3;
        }

        form {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 600px) {

            table.userTable,
            table.userTable thead,
            table.userTable tbody,
            table.userTable th,
            table.userTable td,
            table.userTable tr {
                display: block;
            }

            table.userTable thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            table.userTable tr {
                margin-bottom: 15px;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                background: white;
                padding: 15px;
            }

            table.userTable td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            table.userTable td::before {
                position: absolute;
                top: 15px;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 700;
                text-align: left;
                content: attr(data-label);
                color: #555;
            }

            /* Hide buttons inline on small screen */
            button,
            .btn-link {
                width: 100%;
                margin-top: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <?php include "_menu.php"; ?>
    <br><br>
    <h1>Administration - Gestion des utilisateurs</h1>

    <table class="userTable" aria-label="Liste des utilisateurs">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Supprimer</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $entry): ?>
                <tr>
                    <td data-label="ID"><?php echo htmlspecialchars($entry['id']); ?></td>
                    <td data-label="Nom d'utilisateur"><?php echo htmlspecialchars($entry['username']); ?></td>
                    <td data-label="Email"><?php echo htmlspecialchars($entry['email']); ?></td>
                    <td data-label="Supprimer">
                        <form method="POST"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            <input type="hidden" name="deleteID" value="<?php echo htmlspecialchars($entry['id']); ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                    <td data-label="Modifier">
                        <a href="editUser.php?id=<?php echo htmlspecialchars($entry['id']); ?>"
                            class="btn-link">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>