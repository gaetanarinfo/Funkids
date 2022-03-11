<?php

session_start();

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

// Chemin des images
$static_img = '/assets/img/';

// Chemin assets/img/
$static_url = '/assets/';

// Domain
$domain = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$domain = $domain['host'];
$domain = explode(".", $domain);
$domain = $domain[count($domain) - 2] . "." . $domain[count($domain) - 1];

// Version
$version = "v1";

// Site
$site = $_SERVER['SERVER_NAME'];

// Referal
if (!empty($_SERVER['HTTP_REFERER']) && empty($_SESSION['refer'])) {

    $_SESSION['refer'] = $_SERVER['HTTP_REFERER'];
}

// Requête principal

$difficultes = selectDB('*', 'difficultes', '1 ORDER BY id', $db, '*');
$colors = selectDB('*', 'colors', '1 ORDER BY id', $db, '*');
$users = selectDB('u.*, c.*', 'users as u LEFT JOIN classements AS c ON u.id = c.id_user', 'c.score != 0 ORDER BY c.level DESC, c.score DESC LIMIT 40', $db, '*');
$classement = selectDB('SUM(score) AS totalScore', 'classements', '1', $db, '1');
$shop_items = selectDB('*', 'produits', '1 ORDER BY id ASC', $db, '*');

if (!empty($_GET['level'])) $level = selectDB('*', 'level', 'id = ' .  $_GET['level'], $db, '1');

if (!empty($_SESSION['user_id']) && !empty($_GET['level'])) {

    $user = selectDB('*', 'users', 'id = ' .  $_SESSION['user_id'], $db, '1');
    $classement_user = selectDB('*', 'classements', 'id_user = ' . $user['id'], $db, '1');
    $level_user = selectDB('*', 'level', 'id = ' .  $classement_user['level'], $db, '1');
    $color_user = selectDB('*', 'colors', 'id = ' . $classement_user['color'] . ' ORDER BY id', $db, '1');
    $difficulte_histories = selectDB('*', 'difficulte_histories', 'id_user = ' . $_SESSION['user_id'] . ' AND level = "' . $classement_user['level'] . '" AND difficulte = "' . $classement_user['difficulte'] . '" ORDER BY id', $db, '1');
    
}


// Lors de l'inscriptions A NE PAS OUBLIER

$ex = explode(' ', $_SERVER['HTTP_USER_AGENT']);
$os = $ex[4] . ' ' . $ex[5] . ' ' . $ex[6];
// echo 'Browser: '.$ex[0]; 
// echo 'Ip: $_SERVER['REMOTE_ADDR']; 

$ua = getBrowser();

// Views par ip

$view_ip = $db->query('SELECT id FROM views WHERE ip = "' . $_SERVER['REMOTE_ADDR'] . '"')->fetch(PDO::FETCH_COLUMN);

if($view_ip == "1") {
    $update = $db->query('UPDATE `views` SET `count` = `count` + 1 WHERE ip = "' . $_SERVER['REMOTE_ADDR'] . '"');
}else{
    $insert = $db->query('INSERT INTO `views`(`ip`, `created_at`) VALUES ("' . $_SERVER['REMOTE_ADDR'] . '", "' . date('Y-m-d H:i:s') . '")');
}

$countUserRegister = selectDB('COUNT(id) AS idCount', 'users', '1 GROUP BY id', $db, '1');