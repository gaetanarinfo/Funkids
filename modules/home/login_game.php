<div id="login_game" class="container">

    <div class="new_game">

        <div class="row">

            <div class="col text-center">

                <div class="box">

                    <h2>
                        Connecte toi
                    </h2>

                    <form id="connexion_game" method="POST">

                        <div class="body">

                            <div class="lds-ring">

                                <h3>Chargement de ton compte en cours...</h3>

                                <img src="<?= $static_img ?>clock-loading.gif" alt="">
                            </div>

                            <div class="message_success">
                                <img src="<?= $static_img ?>message-check.png" alt="">
                                <h3></h3>
                                <p></p>
                            </div>

                            <div class="form">
                                <label for="pseudo_login" class="form-label">Ton pseudo</label>
                                <input type="text" class="form-control" name="pseudo_login" required>
                            </div>

                            <div class="form">
                                <label for="password_login" class="form-label">Ton mot de passe</label>
                                <input type="password" class="form-control" name="password_login" required>
                            </div>

                        </div>

                        <div class="footer">
                            <input type="submit" id="btn_login_games" class="btn_play form mt-0" value="Jouer"></input>
                            <a id="quit_new_game" class="btn_exit">Quitter</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>