<?php

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

// API et librairies
use PHPMailer\PHPMailer\PHPMailer;

function stripAccents($stripAccents)
{
	return strtr($stripAccents, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

// Permet de select dans la base : 
// 1.0
// $atas = selectDB('*','table','id = "1"',$db,'*');

function selectDB($select, $table, $where, $db, $row)
{

	if (!empty($where)) {
		$return = $db->query('SELECT ' . $select . ' FROM ' . $table . ' WHERE ' . $where);
	} else {
		$return = $db->query('SELECT ' . $select . ' FROM ' . $table);
	}

	if ($row == "1") {
		$return = $return->fetch(PDO::FETCH_ASSOC);
	} else {
		$return = $return->fetchAll(PDO::FETCH_ASSOC);
	}

	return $return;
}


// Permet de récupérer les données de confugration du site : smtp, port smtp, encode... et autres informations de confuguration types.
// $config = getConfig($db);
// 1.0

function getConfig($db)
{

	$infos = $db->query('SELECT * FROM config');
	$infos = $infos->fetchAll(PDO::FETCH_ASSOC);

	$return = array();

	foreach ($infos as $info) {
		$return[$info['tag']] = $info['value'];
	}

	return $return;
}

// Envoi de mails
// 1.0
// echo sendMail($from ,$from_name ,$to ,$to_name ,$reply ,$reply_name ,$subject ,$content ,$config, false);

function sendMail($from, $from_name, $to, $to_name, $reply, $reply_name, $subject, $content, $config, $attachments = array())
{

	if (!empty($to)) {

		if (!class_exists('PHPMailer\PHPMailer\Exception')) {
			require __DIR__ . '/../mail/src/Exception.php';
			require __DIR__ . '/../mail/src/PHPMailer.php';
			require __DIR__ . '/../mail/src/SMTP.php';
		}

		$mail = new PHPMailer();
		$mail->SMTPDebug = 0;
		$mail->CharSet = PHPMailer::CHARSET_UTF8;
		$mail->isHTML();
		$mail->isSMTP();
		$mail->SMTPAuth = true;

		$mail->Host = $config['mail_Host'];
		$mail->Username = $config['mail_Username'];
		$mail->Password = $config['mail_Password'];
		$mail->SMTPSecure = $config['mail_SMTPSecure'];
		$mail->Port = $config['mail_Port'];

		$mail->setFrom($from, $from_name);

		if (!empty($reply) or $reply == '0') {
			if (!empty($$reply_name)) {
				$mail->addReplyTo($reply, $reply_name);
			} else {
				$mail->addReplyTo($reply, $reply);
			}
		}

		$mail->addAddress($to, $to_name);

		if (!empty($attachments)) {
			foreach ($attachments as $attachment) {
				$mail->addStringAttachment(file_get_contents($attachment['url']), $attachment['name']);
			}
		}

		$mail->Subject = $subject;
		$mail->msgHTML($content);
		$mail->AltBody = $content;

		if (!$mail->send()) {

			$return = "Une erreur s'est produite pendant l'envoi du mail";

			// Envoi d'un mail de secours
			// Ne pas décoller ces variables pour que cela soit propre dans le mail

			$sendLogs = '
Bonjour

Ce mail a été envoyé depuis ' . getUrl(true) . '. 
Merci de le transmettre au destinataire initial et de comprendre pourquoi ce mail n\'a pas pu être envoyé.

Récapitulatif du mail :
Envoyé par : ' . $from . ' ' . $from_name . '
Pour : ' . $to . ' ' . $to_name . '
Sujet : ' . $subject . '
Contenu : ' . $content;

			mail($config['mail_error'], 'Erreur : Mail non reçu envoyé depuis  ' . getUrl(true), $sendLogs);
		} else {

			$return = "Votre message a bien été envoyé";
		}
	} else {

		$return = "to empty";
	}

	return $return;
}


// Récupération de l'url en cours
// 1.0
// true : pas de transformation
// www : avec les www

function getUrl($type)
{

	if ($type == "www") {

		return 'www.' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	} else {

		return $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}
}

// Récupération de l'url en cours et ajout du parameter

function addToUrl($url, $key, $value = null)
{
	$query = parse_url($url, PHP_URL_QUERY);
	if ($query) {
		parse_str($query, $queryParams);
		$queryParams[$key] = $value;
		$url = str_replace("?$query", '?' . http_build_query($queryParams), $url);
	} else {
		$url .= '?' . urlencode($key) . '=' . urlencode($value);
	}
	return $url;
}

// Permet de créer dispatcher les attributs de l'url dans le GET
// Sinon nous n'avons qu'au GET['page'], à cause de l'htaccess

function makeGet($value)
{

	$return = array();

	$gets = explode('?', $value);
	if (!empty($gets[1])) {
		$gets = $gets[1];
		$gets = explode('&', $gets);

		foreach ($gets as $get) {
			$get = explode('=', $get);

			$return[$get[0]] = $get[1];
			$_GET[$get[0]] = urldecode($get[1]);
		}
	}

	return $return;
}

$get = makeGet($_SERVER["REQUEST_URI"]);

function generer_mot_de_passe($nb_caractere = 12)
{

	$mot_de_passe = "";

	$chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
	$longeur_chaine = strlen($chaine);

	for ($i = 1; $i <= $nb_caractere; $i++) {
		$place_aleatoire = mt_rand(0, ($longeur_chaine - 1));
		$mot_de_passe .= $chaine[$place_aleatoire];
	}

	return $mot_de_passe;
}

function getBrowser()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version = "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i', $u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Chrome/i', $u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i', $u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i', $u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i', $u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ($version == null || $version == "") {
		$version = "?";
	}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
	);
}
