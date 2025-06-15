<nav>
    <ul>
    <?php require_once "_header.php"; ?>

        <?php if (!isset($_SESSION['user'])) { ?>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
        <?php } else if ($_SESSION['user']['email'] == "admin@gmail.com"){ ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Deconnexion</a></li>
            <li><a href="admin.php">Page Admin</a></li>
        <?php } else { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Deconnexion</a></li>
       <?php } ?>
    </ul>

</nav>