<?php
session_start();
session_destroy();
header("Location:login.php?msg=Déconnexion réussie");
exit;