<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if (isset($_POST['ingot']) && isset($_SESSION['user_id'])) {

    $select = selectDB('*', 'classements', 'id_user = ' . $_SESSION['user_id'], $db, '1');

    switch ($select['difficulte']) {
        case '1':
            $ingot = $_POST['ingot'];
            break;

        case '2':
            $ingot = $_POST['ingot'];
            break;

        case '3':
            $ingot = $_POST['ingot'];
            break;
    }

    $update = $db->query('UPDATE `classements` SET `ingot` = `ingot` + "' . $ingot . '" WHERE id_user = ' . $_SESSION['user_id']);

    $final = ['chest' => true, 'ingot' => $select['ingot'] + $ingot];
} else {
    $final = ['chest' => false];
}

echo json_encode($final);
