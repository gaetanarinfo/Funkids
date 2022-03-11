<?php if (!isset($_GET['level'])) { ?>
    <title>Funkids - Jeu de Réflexion gratuit</title>
    <meta name="description" content="Jeu de Réflexion gratuit sur funkids.site ... Fun kids : jeu de Puzzle gratuit en ligne sur funkids.site." />
<?php } else { ?>
    <title>Funkids - <?= $level_user['name'] ?> - Jeu de Réflexion gratuit</title>
    <meta name="description" content="Jeu de Réflexion gratuit sur funkids.site ... Fun kids : jeu de Puzzle gratuit en ligne sur funkids.site." />
<?php } ?>