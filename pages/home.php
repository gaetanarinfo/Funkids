<div id="home">

    <?php include 'modules/home/loading.php'; ?>
    <?php include 'modules/home/menu.php'; ?>
    <?php include 'modules/home/new_game.php'; ?>
    <?php include 'modules/home/login_game.php'; ?>
    <?php include 'modules/home/option.php'; ?>
    <?php include 'modules/home/bug.php'; ?>
    <?php include 'modules/home/aide.php'; ?>
    <?php include 'modules/home/copyright.php'; ?>

</div>

<!-- Son Ambiance -->
<audio id="sound_1" loop volume="<?= (!empty($_COOKIE['soundGeneral'])) ? $_COOKIE['soundGeneral'] : "1" ?>">
    <source src="<?= $static_url ?>son/sound-1.mp3" type="audio/mpeg">
</audio>

<!-- Clic bouton -->
<audio id="clic_1" volume="<?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?>">
    <source src="<?= $static_url ?>son/clic-1.mp3" type="audio/mpeg">
</audio>

</div>