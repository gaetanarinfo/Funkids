<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user_verif = selectDB('*', 'users', '1 ORDER BY id DESC', $db, '1');

if ($_POST['pseudoNew'] != $user_verif['pseudo']) {

    if ($_POST['email'] != $user_verif['email']) {

        if (!empty($_POST)) {

            $score = 0;

            $difficulte = 1;

            $level = 1;

            $color = $_POST['color'];

            $options = [
                'cost' => 12,
            ];

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

            $insert_user = $db->query('INSERT INTO `users`( `pseudo`, `email`, `password`, `age`, `ip`, `browser`, `os`, `created_at`) VALUES ("' . $_POST['pseudoNew'] . '", "' . $_POST['email'] . '", "' . $password . '", ' . $_POST['age'] . ',"' . $_SERVER['REMOTE_ADDR'] . '","' . $ua['name'] . " " . $ua['version'] . '","' . $os . '","' . date('Y-m-d H:i:s') . '")');

            $lastId = $db->lastInsertId();

            $insert_classement = $db->query('INSERT INTO `classements`(`id_user`, `color`, `score`, `level`, `difficulte`, `created_at`) VALUES (' . $lastId . ',"' . $color . '",' . $score . ', ' . $level . ',' . $difficulte . ', "' . date('Y-m-d H:i:s') . '")');

            $_SESSION['user_id'] = $lastId;

            $final = ['register' => true, 'id' => $lastId, 'level' => $level];
        }
    } else {
        $final = ['register' => false, 'color' => 'error', 'icone' => $static_img . 'message-error.png', 'title' => 'Désolé, une erreur est survenue.', 'message' => 'Un compte existe déjà avec ce peudo ou cet adresse email !'];
    }
} else {
    $final = ['register' => false, 'color' => 'error', 'icone' => $static_img . 'message-error.png', 'title' => 'Désolé, une erreur est survenue.', 'message' => 'Un compte existe déjà avec ce peudo ou cet adresse email !'];
}

echo json_encode($final);
