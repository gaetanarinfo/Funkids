<?php

include '../config/fonctions.php';
include '../config/connexion.php';

if (!empty($_POST)) {

    $user = selectDB('*', 'users', 'pseudo = "' . $_POST['pseudo'] . '"', $db, '1');

    if (!empty($user)) $final = ['user' => true];
    else  $final = ['user' => false];
}

echo json_encode($final);
