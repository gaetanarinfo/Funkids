<div id="shop" class="shop">

    <h2>
        La boutique
        <span id="close_shop" class="close_shop">
            <img src="<?= $static_img ?>/close.png">
        </span>
    </h2>

    <div class="body">

        <div class="login_shop">

            <div class="login_chest">
                <img class="w-50" src="<?= $static_img ?>chest.png" alt="">
            </div>

            <div class="form_shop">

                <div class="form">
                    <label for="pseudo_shop_login" class="form-label">Ton pseudo</label>
                    <input type="text" class="form-control" name="pseudo_shop_login" required>
                    <span class="label_error"></span>
                </div>

            </div>

            <div class="footer">
                <a id="btn_shop_games" class="btn_play form mt-0">Continuer</a>
                <a id="quit_shop_login" class="btn_exit">Quitter</a>
            </div>

        </div>

        <div class="grid_sorter hide_shop">
            <div class="item"><span>Filtré par :</span></div>
            <div class="item" data-name="all"><img src="<?= $static_img ?>menu.png" alt=""><span>Tous</span></div>
            <div class="item" data-name="item_ingot"><img src="<?= $static_img ?>level/lingo_1.png" alt=""><span>L'ingot</span></div>
            <div class="item" data-name="item_coin"><img src="<?= $static_img ?>level/coin.png" alt=""><span>Pièce d'or</span></div>
        </div>

        <div class="grid_shop hide_shop">

            <?php foreach ($shop_items as $shop_item) { ?>

                <div class="item_shop item_<?= $shop_item['classe'] ?>">
                    <img src="<?= $static_img ?>level/<?= $shop_item['image'] ?>.png" />
                    <p><?= $shop_item['name'] ?></p>
                    <p class="price"><?= str_replace('.', ',', $shop_item['price']) . ' €' ?></p>
                    <a class="btn_shop_item" data-item="<?= $shop_item['id'] ?>" data-name="<?= $shop_item['name'] ?>" data-image="<?= $shop_item['image'] ?>" data-price="<?= str_replace('.', ',', $shop_item['price']) . ' €' ?>" data-amount="<?= str_replace('.', '', $shop_item['price']) . ' €' ?>">Acheter</a>
                </div>

            <?php } ?>

        </div>

        <div class="footer_grid_shop">
            <a id="quit_shop_login" class="btn_exit">Quitter</a>
        </div>

        <div class="pay">

            <div class="header"></div>

            <div class="stripe"></div>

            <div class="d_back_items">
                <a id="back_items" class="btn_exit">Retour</a>
            </div>

            <div class="lds-ring">

                <h3>Paiement en cours...</h3>

                <img src="<?= $static_img ?>clock-loading.gif" alt="">
            </div>

            <div class="after_paiement">

                <img />
                <h2></h2>
                <p></p>

                <a id="quit_shop_login_end" class="btn_exit">Quitter</a>

            </div>

        </div>

    </div>

</div>