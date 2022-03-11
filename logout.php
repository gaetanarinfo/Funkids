<?php

include 'config/fonctions.php';
include 'config/connexion.php';
include 'config/config.php';

session_start(); //to ensure you are using same session
session_destroy(); //destroy the session

header('Location: https://' . $site);

exit();

?>