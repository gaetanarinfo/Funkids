<!doctype html>
<html lang="fr">

<head>

    <?php include 'titles.php'; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="author" content="Gaëtan Seigneur" />
    <meta charset="utf-8">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://funkids.site/">
    <meta property="og:title" content="Funkids - Jeu de Réflexion gratuit">
    <meta property="og:description" content="Jeu de Réflexion gratuit sur funkids.site ... Fun kids : jeu de Puzzle gratuit en ligne sur funkids.site.">
    <meta property="og:image" content="https://<?= $site . $static_img ?>icons/android-chrome-512x512.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://funkids.site/">
    <meta property="twitter:title" content="Funkids - Jeu de Réflexion gratuit">
    <meta property="twitter:description" content="Jeu de Réflexion gratuit sur funkids.site ... Fun kids : jeu de Puzzle gratuit en ligne sur funkids.site.">
    <meta property="twitter:image" content="https://<?= $site .  $static_img ?>icons/android-chrome-512x512.png">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= $static_img ?>icons/favicon.ico" type="images/x-icon" />
    <meta name="theme-color" content="#ffffff">

    <link href="<?= $static_url ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $static_url ?>css/style.css?<?= time(); ?>" rel="stylesheet" type="text/css" />

    <?php if (!empty($_GET['level'])) { ?>
        <link href="<?= $static_url ?>css/level.css?<?= time(); ?>" rel="stylesheet" type="text/css" />
    <?php } ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">

    <link rel="alternate" hreflang="x-default" href="https://<?= $site ?>/" />

    <!-- Recaptcha v2 -->
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TX2SSZ6XS0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TX2SSZ6XS0');
    </script>

    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

</head>

<body>