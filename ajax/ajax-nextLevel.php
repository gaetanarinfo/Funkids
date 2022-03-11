<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

$classement_user = selectDB('*', 'classements', 'id_user = ' . $_SESSION['user_id'], $db, '1');

$difficulte_histories = selectDB('*', 'difficulte_histories', 'id_user = "' . $_SESSION['user_id'] . '" AND level = "' . $classement_user['level'] . '" ORDER BY id DESC', $db, '1');

if ($difficulte_histories['difficulte'] == 3) {

    if ($classement_user['coins'] >= $level_user['cout_coins']) {

        $update = $db->query('UPDATE `classements` SET `level` = `level` + 1, `difficulte` = 1 WHERE id_user = ' . $_SESSION['user_id']);
        $update = $db->query('UPDATE `classements` SET `coins` = `coins` - "' . $level_user['cout_coins'] . '" WHERE id_user = ' . $_SESSION['user_id']);

        $final = ['nextlevel' => true, 'level' => $classement_user['level'] + 1];

    }else{

        $final = ['nextlevel' => false];

    }
    
}else{

    $final = ['nextlevel' => false];

}


echo json_encode($final);