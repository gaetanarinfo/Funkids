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
                        <input type="submit" id="btn_request_bug" class="btn_play form" value="Envoyer"></input>
                        <div id='recaptcha' class="g-recaptcha" data-sitekey="6LerJ6IeAAAAAA8I4Kco7s1mIoGxeV1ttJJweeD4" data-callback="recaptchacheck" data-size="invisible"></div>
                        <a id="quit_bug" class="btn_exit">Quitter</a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>