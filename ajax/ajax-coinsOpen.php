<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if (isset($_POST['coins']) && isset($_SESSION['user_id'])) {

    $select = selectDB('*', 'classements', 'id_user = ' . $_SESSION['user_id'], $db, '1');

    switch ($select['difficulte']) {
        case '1':
            $coins = $_POST['coins'];
            break;

        case '2':
            $coins = $_POST['coins'];
            break;

        case '3':
            $coins = $_POST['coins'];
            break;
    }

    $update = $db->query('UPDATE `classements` SET `coins` = `coins` + "' . $coins . '" WHERE id_user = ' . $_SESSION['user_id']);

    $final = ['coinsChest' => true, 'coins' => $select['coins'] + $coins];
} else {
    $final = ['coinsChest' => false];
}

echo json_encode($final);
