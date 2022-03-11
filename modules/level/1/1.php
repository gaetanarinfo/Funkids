<div class="level level_<?= $_GET['level'] ?> container mt-5 mb-5">

    <input type="hidden" value="<?= $user['pseudo'] ?>" name="pseudo">
    <input type="hidden" value="<?= $classement_user['level'] ?>" name="level">

    <div class="banniere">
        <img src="<?= $static_img ?>level/level_1.png" alt="">
    </div>


    <div class="header mb-3">

        <div class="left">
            <div><?= $user['pseudo'] ?></div>
            <div class="mt-3">
                <p class="score mt-2 mb-3"><img class="des_trefle" src="<?= $static_img ?>level/trefle.png" /><span class="trefle">0</span></p>
                <p class="score mt-2 mb-3"><img class="des_lingo" src="<?= $static_img ?>level/lingo_1.png" /><span class="ingot"><?= number_format($classement_user['ingot'], 0, ' ', ' ') ?></span></p>
                <p class="score mt-2 mb-3"><img class="des_coin" src="<?= $static_img ?>level/coin.png" /><span class="coin"><?= number_format($classement_user['coins'], 0, ' ', ' ') ?></span></p>

                <img class="des_img" src="<?= $static_img ?>level/des_static.png">
            </div>
        </div>

        <div class="right">

            <div class="d-inline-block"><img class="etoile <?= ($classement_user['difficulte'] >= 3) ? '' : 'etoile_op' ?>" src="<?= $static_img ?>/level/etoile.png" alt="Difficile" title="Difficile"></div>
            <div class="d-inline-block"><img class="etoile <?= ($classement_user['difficulte'] >= 2) ? '' : 'etoile_op' ?>" src="<?= $static_img ?>/level/etoile.png" alt="Moyen" title="Moyen"></div>
            <div class="d-inline-block"><img class="etoile" src="<?= $static_img ?>/level/etoile.png" alt="Normal" title="Facile"></div>

            <div class="mt-3 mb-2">
                <div class="start_des" style="float: right;">

                    <a id="logout"><img src="/assets/img/level/logout.png" alt=""></a>
                    <a id="pig_btn"><img class="pig" src="<?= $static_img ?>level/pig.png" alt=""></a>
                    <a id="chest_btn" data-bs-toggle="modal" href="#chestBonus"><img class="chest_bonus" src="<?= $static_img ?>level/chest_bonus.png" alt=""></a>

                    <?php if ($difficulte_histories['gagne'] != 1) { ?>
                        <a id="start_des" class="btn_play">Lancer</a>
                    <?php } ?>
                </div>
            </div>

        </div>

    </div>

    <div class="rows">

        <?php if ($difficulte_histories['gagne'] != 1) { ?>

            <div id="level_<?= $_GET['level'] ?>">

                <div class="wrapper1">
                    <div id='overlay'></div>
                    <div class="bonus_chest">
                        <img src="<?= $static_img ?>level/chest_bonus.png" alt="">
                    </div>

                    <table class='tbl' style="background: url('<?= $static_img . 'backgrounds/' . $level['background'] ?>') no-repeat center; background-position: top;">
                    </table>
                </div>

            </div>

            <div class="winGame">

                <p>Bravo ! Tu as gagné.</p>

                <img src="<?= $static_img ?>level/wingame.gif" alt="">

                <div class="mt-5 mb-5">
                    <div class="play_after">
                        <a id="play_after" class="btn_play">Continuer</a>
                    </div>
                </div>

            </div>

        <?php } else { ?>

            <div class="winGame" style="display: block;">

                <p>Bravo ! Tu as gagné.</p>

                <img src="<?= $static_img ?>level/wingame.gif" alt="">

                <div class="mt-5 mb-5">
                    <div class="play_after">
                        <?php if ($difficulte_histories['difficulte'] == 3) { ?>
                            <?php if ($classement_user['coins'] >= $level_user['cout_coins']) { ?>
                                <a id="next_level" style="display: block;" class="btn_play level_after">Niveau suivant</a>
                            <?php } else { ?>
                                <div class="empty_coin">
                                    <img src="<?= $static_img ?>level/chest_coin.png" />
                                    <p class="mb-0">Il te faut <?= $level_user['cout_coins'] ?> pièces d'or,</p>
                                    <p class="mt-0">pour continuer.</p>
                                    <a style="display: block;" class="btn_exit coins_after">Acheter</a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <a id="play_after" style="display: block;" class="btn_play">Continuer</a>
                        <?php } ?>
                    </div>
                </div>

            </div>

        <?php } ?>

    </div>

</div>