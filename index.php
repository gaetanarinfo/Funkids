<?php

include 'config/fonctions.php';
include 'config/connexion.php';
include 'config/config.php';

if (empty($_GET['page'])) {
	include 'modules/header.php';
	include 'pages/home.php';
	include 'modules/footer.php';
} else {
}
