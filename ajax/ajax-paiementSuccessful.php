<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

include '../config/fonctions.php';
include '../config/connexion.php';

if ($_POST['statut_transaction'] == "COMPLETED" || $_POST['statut_transaction'] == "succeeded" && !empty($_POST)) {

    $insert = $db->query('INSERT INTO `commandes`(`id_produit`, `pseudo`, `status`, `origin`, `date_paiement_effectue`, `transaction_id`) VALUES ("' . $_POST['id_produit'] . '","' . $_POST['pseudo'] . '","' . $_POST['statut_transaction'] . '","' . $_POST['origin'] . '","' . date('Y-m-d H:i:s') . '","' . $_POST['transaction_id'] . '")');

    $lastId = $db->lastInsertId();

    $select = selectDB('*', 'commandes', 'pseudo = "' . $_POST['pseudo'] . '"', $db, '1');

    $shop_items = selectDB('*', 'produits', 'id = "' . $_POST['id_produit'] . '"', $db, '1');

    // WEBHOOK
    $uri = "https://chat.googleapis.com/v1/spaces/AAAAU5DvJsA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=OMtjFjBTKMRXZZ7EtUEm8UmdaxLHM4rLQTVaAVpOFx0%3D";

    $msg = '*Un nouveau paiement a été effectué sur Funkids :*\n\nLe paiement N°' . str_replace("pi_", "", $select['transaction_id'])  . ' est validé.\n\nRécapitulatif de la commande du ' . date('d/m/Y', strtotime($select['date_paiement_effectue'])) . ' à ' . date('H:i', strtotime($select['date_paiement_effectue'])) . '\n\nTotal de la commande ' . number_format($shop_items['price'], 2, ",", "") . ' € TTC\nContenance ' . $shop_items['name'];

    $params = '{"text": "' . $msg . '"}';

    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);

    curl_close($ch);

    $user_commande = selectDB('*', 'users', 'pseudo = "' . $_POST['pseudo'] . '"', $db, '1');

    $update = $db->query('UPDATE `classements` SET `ingot` = `ingot` + ' . $shop_items['ingot'] . ', `coins` = `coins` + ' . $shop_items['coins'] . ' WHERE id_user = ' . $user_commande['id']);

    // Client
    $from = 'support@funkids.site';
    $from_name = 'Funkids';
    $to = $user_commande['email'];
    $to_name = $user_commande['pseudo'];
    $reply       = "no-reply@funkids.site";
    $reply_name     = 'Funkids';

    $sujet = 'Ton paiement est validée !';

    $content = 'Bonjour ' . ucwords(strtolower($select['pseudo'])) . ', <br /><br />';

    $content .= 'Ton paiement N°' . str_replace("pi_", "", $select['transaction_id'])  . ' est validé. Merci de conserver ce mail.<br/><br/>';

    $content .= 'Voici le récapitulatif de ta commande du ' . date('d/m/Y', strtotime($select['date_paiement_effectue'])) . ' à ' . date('H:i', strtotime($select['date_paiement_effectue'])) . ' :<br/><br/>';

    $content .= 'Total de la commande <b>' . number_format($shop_items['price'], 2, ",", "") . ' € TTC</b><br />';
    $content .= 'Contenance de la commande <b>' . $shop_items['name']. '</b><br /><br />';

    $content .= 'N’hésite pas à nous contacter pour toutes questions relatives à ta commande.<br/>';

    $content .= 'Funkids te remercie pour ta confiance.';

    sendMail($from, $from_name, $to, $to_name, $reply, $reply_name, $sujet, $content, $config, false);

    $from = 'support@funkids.site';
    $from_name = 'Funkids';
    $to = 'support@funkids.site';
    $to_name = 'Gaëtan Seigneur';
    $reply       = "no-reply@funkids.site";
    $reply_name     = 'Funkids';

    $sujet = 'Un nouveau paiement a été effectué sur Funkids.';

    $content = 'Bonjour, <br /><br />';

    $content .= 'Le paiement N°' . str_replace("pi_", "", $select['transaction_id'])  . ' est validé.<br/><br/>';

    $content .= 'Voici le récapitulatif de la commande du ' . date('d/m/Y', strtotime($select['date_paiement_effectue'])) . ' à ' . date('H:i', strtotime($select['date_paiement_effectue'])) . ' :<br/><br/>';

    $content .= 'Total de la commande <b>' . number_format($shop_items['price'], 2, ",", "") . ' € TTC</b><br /><br />';
    $content .= 'Contenance de la commande <b>' . $shop_items['name']. '</b>';

    sendMail($from, $from_name, $to, $to_name, $reply, $reply_name, $sujet, $content, $config, false);

}