<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

include '../config/fonctions.php';
include '../config/connexion.php';

if ($_POST['statut_transaction'] == "card_declined" || $_POST['statut_transaction'] == "CANCELED" || $_POST['statut_transaction'] == "ERROR" || !empty($_POST)) {

    $insert = $db->query('INSERT INTO `commandes`(`id_produit`, `pseudo`, `status`, `origin`, `date_paiement_effectue`) VALUES ("' . $_POST['id_produit'] . '","' . $_POST['pseudo'] . '","' . $_POST['statut_transaction'] . '","' . $_POST['origin'] . '","' . date('Y-m-d H:i:s') . '")');

    $select = selectDB('*', 'users', 'pseudo = "' . $_POST['pseudo'] . '"', $db, '1');

    // Client
    $from = 'support@funkids.site';
    $from_name = 'Funkids';
    $to = $select['email'];
    $to_name = $select['pseudo'];
    $reply       = "no-reply@funkids.site";
    $reply_name     = 'Funkids';

    $sujet = 'Echec du paiement !';

    $content = 'Bonjour ' . ucwords(strtolower($select['pseudo'])) . ', <br /><br />';

    $content .= 'Une erreur est survenue lors de la validation de ton paiement, aucune transaction n’a été effectuée. Merci de vérifier tes coordonnées bancaires et de réitérer ta demande.<br/><br/>';

    $content .= 'Si tu rencontre des difficultés, contact nous sur le formulaire de <a href="https://funkids.site">funkids</a>.<br/><br/>';

    $content .= 'Funkids te remercie pour ta confiance.';

    sendMail($from, $from_name, $to, $to_name, $reply, $reply_name, $sujet, $content, $config, false);

}
