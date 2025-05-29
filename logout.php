<?php

session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION);
    session_destroy(); //Finire session (logout)
}

header('Location:login.php');
?>