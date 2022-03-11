<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if (isset($_GET['level']) && isset($_SESSION['user_id'])) {

    switch ($classement_user['difficulte']) {
        case '1':
            $point = $classement_user['point_by'];
            $update = $db->query('UPDATE `classements` SET `score` = `score` + ' . $point . ', `difficulte` = 2 WHERE id_user = ' . $_SESSION['user_id']);
            $insert = $db->query('INSERT INTO `difficulte_histories`(`id_user`, `level`, `difficulte`, `gagne`) VALUES (' . $_SESSION['user_id'] . ', ' . $_GET['level'] . ', 1, 1)');
            $final = ['up' => true, 'level' => 1];
            break;

        case '2':
            $point = $classement_user['point_by'] * 2;
            $update = $db->query('UPDATE `classements` SET `score` = `score` + ' . $point . ', `difficulte` = 3 WHERE id_user = ' . $_SESSION['user_id']);
            $insert = $db->query('INSERT INTO `difficulte_histories`(`id_user`, `level`, `difficulte`, `gagne`) VALUES (' . $_SESSION['user_id'] . ', ' . $_GET['level'] . ', 2, 1)');
            $final = ['up' => true, 'level' => 2];
            break;

        case '3':
            $point = $classement_user['point_by'] * 4;
            $update = $db->query('UPDATE `classements` SET `score` = `score` + ' . $point . ' WHERE id_user = ' . $_SESSION['user_id']);
            $insert = $db->query('INSERT INTO `difficulte_histories`(`id_user`, `level`, `difficulte`, `gagne`) VALUES (' . $_SESSION['user_id'] . ', ' . $_GET['level'] . ', 3, 1)');
            $final = ['up' => true, 'level' => 3];
            break;
    }

} else {
    $final = ['up' => false];
}

echo json_encode($final);
