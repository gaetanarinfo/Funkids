<div id="option" class="container">

    <div class="row">

        <div class="col text-center">

            <div class="box">

                <h2>
                    Menu des options
                </h2>

                <div class="body">

                    <div>
                        <label for="soundGeneral" class="form-label">Son général</label>
                        <div id="slider">
                            <input type="range" class="form-range" min="0.1" max="1.0" step="0.1" value="<?= (!empty($_COOKIE['soundGeneral'])) ? $_COOKIE['soundGeneral'] : "1" ?>" id="soundGeneral" onchange="soundGeneralValue.value=value">
                            <output id="soundGeneralValue"><?= (!empty($_COOKIE['soundGeneral'])) ? $_COOKIE['soundGeneral'] : "1" ?></output>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="soundBruitage" class="form-label">Bruitage</label>
                        <div id="slider">
                            <input type="range" class="form-range" min="0.1" max="1.0" step="0.1" value="<?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?>" id="soundBruitage" onchange="soundBruitageValue.value=value">
                            <output id="soundBruitageValue"><?= (!empty($_COOKIE['soundBruitage'])) ? $_COOKIE['soundBruitage'] : "1" ?></output>
                        </div>
                    </div>

                </div>

                <div class="footer">
                    <a id="save_option" class="btn_play">Sauvegarder</a>
                    <a id="quit_option" class="btn_exit">Quitter</a>
                </div>

            </div>

        </div>

    </div>

</div>