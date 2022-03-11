<?php

include '../config/fonctions.php';
include '../config/connexion.php';
include '../config/config.php';

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

if(!empty($_POST)) {

    $insert = $db->query('INSERT INTO `report_bug` (`pseudo`, `email`, `date`, `content`, `created_at`) VALUES ("' . $_POST['pseudo'] . '","' . $_POST['email'] . '","' . $_POST['date'] . '","' . $_POST['content'] . '", "' . date('Y-m-d H:i:s') . '")');

    $from         = $_POST['email'];
    $from_name     = $_POST['pseudo'];
    $to             = 'support@funkids.site';
    $to_name     = 'Assistance - Funkids';
    $reply         = 'no-reply@funkids.site';
    $reply_name     ='Assistance - Funkids';
    $subject     = "Bug sur le site internet";

    $content = 'Bonjour Gaëtan Seigneur,<br/><br/>';

    $content .= 'Une personne à signaler un bug sur le site internet.<br/><br/>';

    $content .= 'Récapitulatif des informations :<br/><br/>';

    $content .= 'Pseudo : ' . $_POST['pseudo'] . '<br/>';
    $content .= 'Adresse email : ' . $_POST['email'] . '<br/><br/>';
    $content .= 'Date : ' . date('d/m/Y', strtotime($_POST['date'])) . '<br/><br/>';
    $content .= 'Message : <br/><br/>' . $_POST['content'] . '<br/><br/>';

    $content .= 'Merci pour votre message.';

    $mail = sendMail($from, $from_name, $to, $to_name, $reply, $reply_name, $subject, $content, $config, false);

    $final = [
        'submit' => true,
        'color' => 'success',
        'icone' => $static_img . 'message-check.png',
        'title' => 'Message envoyer !',
        'message' => 'Merci pour ton message<br> tu recevras une réponse sous 24 h à 48 h.',
        'test' => $mail
    ];

}else{

    $final = [
        'submit' => false,
        'color' => 'error',
        'icone' => $static_img . 'message-error.png',
        'title' => 'Désolé, une erreur est survenue.',
        'message' => 'Ton message n\'a pas été envoyé suite à une erreur !'
    ];

}

echo json_encode($final);