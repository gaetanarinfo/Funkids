<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

$pseudo = $_POST['pseudo_login'];
$password = $_POST['password_login'];

$login = selectDB('*', 'users', 'pseudo = "' . $pseudo . '"', $db, '1');

if ($pseudo == $login['pseudo']) {

    if(password_verify($password, $login['password'])) {

    $level_verif = selectDB('*', 'classements', 'id_user = "' .  $login['id'] . '"', $db, '1');

    $_SESSION['user_id'] = $login['id'];

    $update = $db->query('UPDATE `users` SET `last_online` = "' . date('Y-m-d H:i:s') . '" WHERE pseudo = "' . $pseudo . '"');

    $final = ['login' => true, 'level' => $level_verif['level']];

    }else{
        $final = ['login' => false, 'color' => 'error', 'icone' => $static_img . 'message-error.png', 'title' => 'Désolé, une erreur est survenue.', 'message' => 'Ton mot de passe n\'est pas bon !'];
    }

} else {
    $final = ['login' => false, 'color' => 'error', 'icone' => $static_img . 'message-error.png', 'title' => 'Désolé, une erreur est survenue.', 'message' => 'Ton compte n\'existe pas avec ce peudo !'];
}

echo json_encode($final);
