<div id="menu" class="container">

    <div class="row show_mobile">

        <div class="col text-center hide_mobile">

            <div class="title mb-2">
                <h1 class="fw-bold">
                    <div>F</div>
                    <div>u</div>
                    <div>n</div>
                    <div></div>
                    <div>K</div>
                    <div>i</div>
                    <div>d</div>
                    <div>s</div>
                </h1>
            </div>

            <div class="garcon_play">
                <img src="<?= $static_img ?>idea.png" alt="">
            </div>

            <a id="btn_play_game" class="btn_play">Nouvelle partie</a>

            <a id="btn_login_game" class="btn_play">Jouer</a>

            <div class="chest_shop">
                <img src="<?= $static_img ?>level/chest_close.png" />
            </div>

            <a id="btn_shop" class="btn_shop">Boutique</a>

            <a id="btn_aide" class="btn_aide">Comment jouer ?</a>

            <a id="btn_classement_game" class="btn_classement">Classement</a>
            <a id="btn_option" class="btn_option">Option</a>
            <a id="btn_exit_game" class="btn_exit" onclick="stopAudio()">Quitter</a>
        </div>

        <div class="col text-center">

            <div class="new_game_loader">

                <h2>
                    Chargement du jeu en cours...
                </h2>

                <div class="lds-ring">
                    <img src="/assets/img/clock-loading.gif" alt="">
                </div>
            </div>

            <div class="classement">

                <h2>
                    Classement des joueurs
                    <span id="close_classement" class="close_classement">
                        <img src="<?= $static_img ?>/close.png">
                    </span>
                </h2>

                <div class="body">

                    <table>

                        <thead>

                            <th></th>
                            <th>Prénom</th>
                            <th class="text-center">Âge</th>
                            <th class="text-center">Niveau</th>
                            <th class="text-center">Score</th>

                        </thead>

                        <tbody>

                            <?php

                            $count = 0;

                            if (count($users) != 0) {

                                foreach ($users as $key => $user) {

                                    $count++;

                            ?>

                                    <tr>
                                        <td class="text-center">

                                            <?php if ($count == 1) { ?>
                                                <img src="<?= $static_img ?>numero-1.png" alt="Position <?= $count ?>">
                                            <?php } ?>

                                            <?php if ($count == 2) { ?>
                                                <img src="<?= $static_img ?>medaille-2.png" alt="Position <?= $count ?>">
                                            <?php } ?>

                                            <?php if ($count == 3) { ?>
                                                <img src="<?= $static_img ?>medaille-3.png" alt="Position <?= $count ?>">
                                            <?php } ?>

                                            <?php if ($count > 3 && $count <= 10) { ?>
                                                <span class="mi_avant"><?= $count ?></span>
                                            <?php } ?>

                                            <?php if ($count >= 11 && $count < 24) { ?>
                                                <span class="avant"><?= $count ?></span>
                                            <?php } ?>

                                            <?php if ($count >= 24) { ?>
                                                <span class="dernier"><?= $count ?></span>
                                            <?php } ?>

                                        </td>
                                        <td><?= $user['pseudo'] ?></td>
                                        <td class="text-center"><?= $user['age'] ?></td>
                                        <td class="text-center"><?= $user['level'] ?></td>
                                        <td class="text-center"><?= $user['score'] ?></td>
                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td class="text-center" colspan="5">
                                        Aucun classement pour le moment.
                                    </td>
                                </tr>

                            <?php } ?>


                        </tbody>

                        <tfoot>

                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end" colspan="2">Score total</td>
                                <td><?= ($classement['totalScore'] != 0) ? $classement['totalScore'] : 'Aucun score' ?></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end" colspan="2">Joueur total</td>
                                <td><?= (count($users) != 0) ? count($users) : '0 joueur' ?></td>
                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

            <?php include 'shop.php'; ?>

        </div>

    </div>

</div>