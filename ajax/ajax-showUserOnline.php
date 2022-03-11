<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

$countUserOnline = selectDB('COUNT(id) AS idCount, last_online', 'users', 'last_online >= "' . date('Y-m-d H:i:s') . '" GROUP BY id', $db, '1');

if (!empty($countUserOnline['idCount'])) {
    echo $countUserOnline['idCount'];
} else {
    echo '0';
}
