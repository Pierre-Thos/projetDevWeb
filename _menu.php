<style>
    nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #007bff;
        padding: 15px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    nav ul {
        list-style: none;
        display: flex;
        justify-content: center;
        gap: 30px;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        padding: 8px 16px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    nav ul li a:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* Pour compenser la hauteur du menu en haut */
    body {
        padding-top: 70px;
    }

    @media (max-width: 600px) {
        nav ul {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
    }
</style>


<nav>
    <ul>
        <?php require_once "_header.php"; ?>

        <?php if (!isset($_SESSION['user'])) { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php } else if ($_SESSION['user']['email'] == "admin@gmail.com"){ ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
            <li><a href="admin.php">Page Admin</a></li>
        <?php } else { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        <?php } ?>
    </ul>
</nav>
