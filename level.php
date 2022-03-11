<?php

include 'config/fonctions.php';
include 'config/connexion.php';
include 'config/config.php';

if(!isset($_SESSION['user_id'])) {
	header('Location: https://' . $site);
}

if (empty($_GET['level'])) {
	
	include 'modules/header.php';
	include 'pages/levelDev.php';
	include 'modules/footer.php';

} else if (!empty($_GET['level']) && !empty($level) && $classement_user['level'] == $_GET['level']) {

	include 'modules/header.php';
	include 'pages/level.php';
	include 'modules/footer.php';
	
} else {

	include 'modules/header.php';
	include 'pages/levelDev.php';
	include 'modules/footer.php';

}
