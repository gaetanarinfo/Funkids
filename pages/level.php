<?php include 'modules/level/' . $classement_user['level'] . '/' . $classement_user['level'] . '.php'; ?>

<style id="map"></style>
<style>
    .bubble {
        filter: hue-rotate(<?= $color_user['color'] . 'deg' ?>);
    }
</style>

<div id="bug" class="container">

    <div class="row">

        <div class="col text-center">

            <div class="box">

                <h2>
                    Signaler un bug
                </h2>

                <form id="form_bug" method="POST">

                    <div class="body">

                        <div class="lds-ring">
                            <img src="<?= $static_img ?>clock-loading.gif" alt="">
                        </div>

                        <div class="message_success">
                            <img src="<?= $static_img ?>message-check.png" alt="">
                            <h3></h3>
                            <p></p>
                        </div>

                        <div class="form">
                            <label for="pseudo" class="form-label">Ton pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                        </div>

                        <div class="mt-3 form">
                            <label for="email" class="form-label">Ton adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mt-3 form">
                            <label for="difficulte">La date du bug</label>
                            <input type="date" id="date" name="date" class="form-control" required max="<?= date('Y-m-d'); ?>">
                        </div>

                        <div class="mt-3 form">
                            <label for="difficulte">J'aimerais en savoir plus</label>
                            <textarea id="content" name="content" class="form-control" required></textarea>
                        </div>

                    </div>

                    <div class="footer">
                        <input type="submit" id="btn_request_bug" class="btn_play form" onclick="playAudioClic()" value="Envoyer"></input>
                        <div id='recaptcha' class="g-recaptcha" data-sitekey="6LerJ6IeAAAAAA8I4Kco7s1mIoGxeV1ttJJweeD4" data-callback="recaptchacheck" data-size="invisible"></div>
                        <a id="quit_bug" class="btn_exit" onclick="playAudioClic()">Quitter</a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include 'modules/home/shop.php'; ?>

<?php include 'modules/home/copyright.php'; ?>

<!-- Son Ambiance -->
<audio id="sound_1" loop autoplay volume="<?= (!empty($_COOKIE['soundGeneral'])) ? $_COOKIE['soundGeneral'] : "1" ?>" allow="autoplay">
    <source src="<?= $static_url ?>son/level/sound-<?= $level['id'] ?>.mp3" type="audio/mpeg">
</audio>

<!-- Clic bouton -->
<audio id="clic_1" volume="<?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?>">
    <source src="<?= $static_url ?>son/clic-1.mp3" type="audio/mpeg">
</audio>

<!-- Dés -->
<audio id="des" volume="<?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?>">
    <source src="<?= $static_url ?>son/des.mp3" type="audio/mpeg">
</audio>

<!-- Dés -->
<audio id="chest" volume="<?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?>">
    <source src="<?= $static_url ?>son/level/chest_open.mp3" type="audio/mpeg">
</audio>

<!-- Chest Bonus -->
<div class="modal fade" id="chestBonus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chestBonus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal_chest">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Bonus du jour</h5>
            </div>
            <div class="modal-body text-center">

                <?php if ($classement_user['chest_bonus'] <= date('Y-m-d H:i:s')) { ?>

                    <a id="chest_btn_open">
                        <img class="chest_bonus" src="<?= $static_img ?>level/chest_bonus.png" alt="">
                    </a>

                    <div id="grid_bonus" class="grid_bonus">

                        <div class="item item_ingot"><img src="<?= $static_img ?>level/lingo_1.png" alt=""><span>0</span></div>
                        <div class="item item_coin"><img src="<?= $static_img ?>level/coin.png" alt=""><span>0</span></div>

                    </div>

                    <div class="bonus_time">
                        <span id="countdown_hour">--</span>
                        <span id="countdown_min">--</span>
                        <span id="countdown_sec">--</span>
                    </div>

                <?php } else { ?>

                    <h3>Reviens demain pour récupérer un autre coffre.</h3>

                    <img class="chest_openings" src="<?= $static_img ?>level/chest_bonus_1.png" alt="">

                    <div class="bonus_time" style="display: block;">
                        <span id="countdown_hour">--</span>
                        <span id="countdown_min">--</span>
                        <span id="countdown_sec">--</span>
                    </div>

                <?php } ?>

            </div>
            <div class="modal-footer">
                <button class="btn_play m-0 close_chest_bonus" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Difficulté -->
<?php

$difficulte = selectDB('*', 'difficultes', 'level = ' . $classement_user['level'] . ' ORDER BY id DESC', $db, '1');

echo '<input type="hidden" value="' . $difficulte['level_difficulte'] . '" id="level_difficulte">';
echo '<input type="hidden" value="' . $difficulte['level_row'] . '" id="level_row">';

echo '<input type="hidden" value="' . $classement_user['level'] . '" id="level">';
echo '<input type="hidden" value="2" id="difficulte_up">';

echo '<script>
            var painAndPleasureArrayName = ' . $difficulte['map_name'] . ';
            </script>';

?>