<div id="new_game" class="container">

    <div class="new_game">

        <div class="row">

            <div class="col text-center">

                <div class="box">

                    <h2>
                        Crée ton compte
                    </h2>

                    <form id="form_new_game" method="POST">

                        <div class="body">

                            <div class="lds-ring">

                                <h3>Création de ton compte en cours...</h3>

                                <img src="<?= $static_img ?>clock-loading.gif" alt="">
                            </div>

                            <div class="message_success">
                                <img src="<?= $static_img ?>message-check.png" alt="">
                                <h3></h3>
                                <p></p>
                            </div>

                            <div class="form">
                                <label for="pseudo" class="form-label">Ton pseudo</label>
                                <input type="text" class="form-control" id="pseudoNew" name="pseudoNew" required>
                            </div>

                            <div class="form">
                                <label for="email" class="form-label">Ton adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form">
                                <label for="password" class="form-label">Ton mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mt-3 form">
                                <label for="age" class="form-label">Ton âge</label>
                                <input type="number" class="form-control" id="age" name="age" max="99" min="5" minlength="2" required>
                            </div>

                            <div class="mt-3 mb-3 form">
                                <label for="color">Couleur du personnage</label>
                                <select name="color" id="color" class="form-select round">
                                    <?php foreach ($colors as $color) { ?>
                                        <option value="<?= $color['id'] ?>" <?= (!empty($_COOKIE['color']) && $_COOKIE['id'] == $color['id']) ? "selected" : "" ?>><?= $color['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                        <div class="footer">
                            <input type="submit" id="btn_new_game" class="btn_play form mt-0" value="Jouer"></input>
                            <a id="quit_new_game" class="btn_exit">Quitter</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>