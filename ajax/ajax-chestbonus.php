<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if (isset($_POST['coins']) && isset($_POST['ingot'])) {

    if ($classement_user['chest_bonus'] <= date('Y-m-d H:i:s')) {
        $coins = intval($_POST['coins']);
        $ingot = intval($_POST['ingot']);
        $expire_bonus = date('Y-m-d H:i:s', strtotime('+1 days'));

        $update = $db->query('UPDATE `classements` SET `coins` = `coins` + ' . $coins . ', `ingot` = `ingot` + ' . $ingot . ', `chest_bonus` = "' . $expire_bonus . '" WHERE id_user = ' . $_SESSION['user_id']);

        $final = ['chest' => true, 'bonus' => $expire_bonus];
    } else {
        $final = ['chest' => false];
    }
} else {
    $final = ['chest' => false];
}

echo json_encode($final);
