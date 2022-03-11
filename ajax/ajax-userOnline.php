<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if (!empty($_SESSION['user_id'])) {

    $update = $db->query('UPDATE `users` SET `last_online` = "' . date('Y-m-d H:i:s', strtotime('+1 minutes')) . '" WHERE id = ' . $_SESSION['user_id']);

}
