var sound_1 = document.getElementById("sound_1"),
    clic_1 = document.getElementById("clic_1"),
    chest = document.getElementById("chest"),
    des = document.getElementById("des");

var player1 = $('<div class="player1 bubble">'),
    currentPlayer = player1,
    totalStepsTakenByP1 = 1,
    clear;

$.cookie.raw = true;

if ($.cookie("soundGeneral") != undefined) {
    sound_1.volume = parseFloat($.cookie("soundGeneral"));
}

if ($.cookie("soundBruitage") != undefined) {
    clic_1.volume = parseFloat($.cookie("soundBruitage"));
    des.volume = parseFloat($.cookie("soundBruitage"));
    chest.volume = parseFloat($.cookie("soundBruitage"));
}

if ($.cookie("difficulte") != undefined) {
    difficulte = $.cookie("difficulte");
}

function playAudio() {
    sound_1.play();
}

function stopAudio() {
    sound_1.pause();
    sound_1.currentTime = 0;
}

function playAudioClic() {
    clic_1.play();
}

function playAudioChest() {
    chest.play();
}

function playAudioDes() {
    des.play();
}

$(document).on('click', '#quit_bug', function (e) {

    e.preventDefault();

    $('#bug').hide();
    $('.level').show();

})

$(document).on('click', '#report_bug', function (e) {

    e.preventDefault();

    $('.level').hide();
    $('#bug').show();

})

$('#form_bug').submit(function (e) {

    e.preventDefault();

    if (!grecaptcha.getResponse()) {

        grecaptcha.execute();

    } else {

    }

})

function recaptchacheck(token) {

    var url = "/ajax/ajax-requestBug.php",
        formData = $("#form_bug").serialize();

    $('#btn_request_bug').attr('disabled', '');

    $("#form_bug :input").prop("disabled", true);
    $('.form').addClass('loading');
    $('.lds-ring').show();
    $("#form_bug").parent().css('min-height', 'auto');
    $('.lds-ring').parent().css('min-height', 'auto');

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        success: function (data) {

            var res = JSON.parse(data);

            setTimeout(() => {
                $('.lds-ring').hide();
            }, 600);

            if (res.submit === true) {
                $('.message_success img').attr('src', res.icone);
                $('.message_success h3').attr('class', res.color);
                $('.message_success h3').html(res.title);
                $('.message_success p').html(res.message);
                $('.message_success').delay(500).fadeIn();
            } else {
                $('.message_success img').attr('src', res.icone);
                $('.message_success h3').attr('class', res.color);
                $('.message_success h3').html(res.title);
                $('.message_success p').html(res.message);
                $('.message_success').delay(500).fadeIn();
            }

        },
        error: function (err) {
            console.log("Error: ", err);
        }
    })

}

var enable = true;

$(document).on('click', '#start_des', function (e) {

    e.preventDefault();

    if (enable == true) {

        enable = false;

        var number = 1 + Math.floor(Math.random() * 6)
        // var number = 15

        $('.des_img').attr('src', '../assets/img/level/des.gif');
        $('.start_des #start_des').addClass('des_load');
        $('.des_img').addClass('des_load');

        playAudioClic();
        playAudioDes();

        setTimeout(() => {
            $('.des_img').attr('src', '../assets/img/level/des_static.png');
            $('.start_des #start_des').removeClass('des_load');
            $('.des_img').removeClass('des_load');
            $('.score .trefle').html(number);
            enable = true;

            playerTurn(number);

        }, 2000);

    }

})

function addOpacity() {
    if (currentPlayer.parent().find('.ladder_small').length) {
        currentPlayer.parent().find('.ladder_small').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.ladder_medium').length) {
        currentPlayer.parent().find('.ladder_medium').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.bombe').length) {
        currentPlayer.parent().find('.bombe').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.potion_1').length) {
        currentPlayer.parent().find('.potion_1').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.monstre_1').length) {
        currentPlayer.parent().find('.monstre_1').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.chest_close').length) {
        currentPlayer.parent().find('.chest_close').css('opacity', '1.0');
    } else if (currentPlayer.parent().find('.coins').length) {
        currentPlayer.parent().find('.coins').css('opacity', '1.0');
    }
}

function removeOpacity() {
    player1.parent().find('.ladder_small').removeAttr('style');
    player1.parent().find('.ladder_medium').removeAttr('style');
    player1.parent().find('.bombe').removeAttr('style');
    player1.parent().find('.potion_1').removeAttr('style');
    player1.parent().find('.monstre_1').removeAttr('style');
}

function startPosition() {
    $('#case_1').append(player1);
}

function playerTurn(randomDiceResult) {

    if (currentPlayer === player1) {

        totalStepsTakenByP1 += randomDiceResult;

        player1.appendTo(`#case_${totalStepsTakenByP1}`);

        painOrPleasureP1();

        if (randomDiceResult === 6) {
            currentPlayer = player1;
        }
    }
    gameOver()
}

function gameOver() {

    if (totalStepsTakenByP1 >= parseInt($('#level_difficulte').val())) {

        $('#level_1').fadeOut(200);
        $('.winGame').fadeIn(300);

        var level = $('#level').val(),
            difficulte_up = $('#difficulte_up').val(),
            id = $('#id_user').val();

        if (difficulte_up != "0") {
            difficulteUp(level, difficulte_up, id);
        }

        resetButton();
    }
}

function resetButton() {
    totalStepsTakenByP1 = 1
    currentPlayer = player1
    player1.appendTo(`#case_${totalStepsTakenByP1}`)
    $('.score span').html(0);
    clearInterval(clear)
}

function createTable() {

    var $tbl = $('.tbl'),
        id = parseInt($('#level_difficulte').val()),
        rowClass = parseInt($('#level_row').val()),
        row = parseInt($('#level_row').val());

    for (var r = 0; r < row; r++) {

        var $row = $('<tr>')

        $row.attr('class', rowClass--)

        for (var c = 0; c < row; c++) {

            var $column = $('<td>')

            $column.css({
                'width': '85px',
                'height': '85px'
            })

            $column.attr('id', 'case_' + id--)

            $column.attr('data-case', id + 1)

            // Level choice
            if ($('#level').val() == "2") {
                $column.attr('data-case') % 2 == 0 ? $column.css('backgroundColor', 'rgba(255, 255, 255, 0.75)') : $column.css('backgroundColor', 'rgba(0, 0, 0, 0.28)');
            } else {
                $column.attr('data-case') % 2 === 0 ? $column.css('backgroundColor', 'rgb(255 255 0 / 28%)') : $column.css('backgroundColor', 'rgb(255 255 253 / 50%)');
            }

            $row.each(function () {
                $(this).attr('class') % 2 === 0 ? $row.append($column) : $row.prepend($column)
            })

            $column.html(id + 1).addClass('cell')

            jQuery.each(painAndPleasureArrayName, function (key) {

                var piege = parseInt(painAndPleasureArrayName[key].piege);
                var name = painAndPleasureArrayName[key].name;
                var cases = parseInt(painAndPleasureArrayName[key].cases);
                var width = parseInt(painAndPleasureArrayName[key].width);
                var height = parseInt(painAndPleasureArrayName[key].height);
                var top = parseInt(painAndPleasureArrayName[key].top);
                var left = parseInt(painAndPleasureArrayName[key].left);
                var rotate = parseInt(painAndPleasureArrayName[key].rotate);
                var position = painAndPleasureArrayName[key].position;


                if (cases == id + 1) {
                    $('#map').append('#case_' + cases + ' .' + name + ' {width: ' + width + 'px; height: ' + height + 'px; top: ' + top + 'px;left: ' + left + 'px; transform: rotate(' + rotate + 'deg); position: ' + position + '}');
                }

                if (cases == id + 1) {
                    $column.html(id + 1 + '<div class="' + name + '" data-case="' + piege + '" data-piege="' + name + '"></div>')
                }

            });

        }

        $tbl.append($row)
    }
}

createTable()
startPosition()

function painOrPleasureP1() {

    jQuery.each(painAndPleasureArrayName, function (key) {

        var piege = parseInt(painAndPleasureArrayName[key].piege),
            name = painAndPleasureArrayName[key].name,
            cases = parseInt(painAndPleasureArrayName[key].cases),
            chest = painAndPleasureArrayName[key].chest,
            chestIngot = painAndPleasureArrayName[key].chestIngot,
            coinsC = painAndPleasureArrayName[key].coinsC,
            coins = painAndPleasureArrayName[key].coins;

        if (player1.parent().data('case') == cases && player1.parent().find('.' + name).data('piege') == name) {

            addOpacity();

            setTimeout(() => {

                removeOpacity();

                totalStepsTakenByP1 = piege;

                player1.appendTo(`#case_` + piege);

            }, 500);

            if (chest != undefined) {
                Chest(chestIngot, `#case_` + piege);

                $(`#case_` + piege).find('div').first().removeAttr('data-piege');
                $(`#case_` + piege).find('div').first().removeAttr('data-case');

            }

            if (coins != undefined) {
                Coins(coins);

                $(`#case_` + piege).find('div').first().removeAttr('data-piege');
                $(`#case_` + piege).find('div').first().removeAttr('data-case');
            }

        } else {
            return totalStepsTakenByP1;
        }

    });

}

// Chest

function Chest(ingot, chest) {

    var url = "/ajax/ajax-chestOpen.php";

    $.ajax({
        url: url,
        method: "POST",
        data: {
            ingot: ingot
        },
        success: function (data) {

            var res = JSON.parse(data);

            if (res.chest === true) {

                $(chest).find('.chest_close').addClass('chest');
                $('.ingot').html(res.ingot);

            }

            if (res.chest === false) {

            }

        }
    })

}

// Coins

function Coins(coins) {

    var url = "/ajax/ajax-coinsOpen.php";

    $.ajax({
        url: url,
        method: "POST",
        data: {
            coins: coins
        },
        success: function (data) {

            var res = JSON.parse(data);

            if (res.coinsChest === true) {

                $('.coin').html(res.coins);

            }

            if (res.coinsChest === false) {

            }

        }
    })

}


// Level Up

function difficulteUp(level, difficulte_up, id) {

    var url = "/ajax/ajax-levelUp.php";

    $.ajax({
        url: url,
        data: {
            level: level,
            difficulte_up: difficulte_up,
            user_id: id
        },
        success: function (data) {

            var res = JSON.parse(data);

            if (res.up === true) {

                if (res.level !== 3) {

                    $('#play_after').css('display', 'block');

                } else {

                    location.reload();

                }

            }

            if (res.up === false) {
                $('#play_after').hide();
            }

        }
    })

}

$(document).on('click', '#play_after', function (e) {

    e.preventDefault();

    playAudioClic();

    location.reload();

})

$(document).on('click', '#logout', function (e) {

    e.preventDefault();

    playAudioClic();

    setTimeout(() => {
        location.href = '/logout';
    }, 1000);

})

$(document).on('click', '#pig_btn', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.level').hide();
    $('#bug').hide();
    $('#shop').show();
    $('.login_shop').hide();
    $('.grid_shop').removeClass('hide_shop');
    $('.footer_grid_shop').show();
    $('.grid_shop').show();

})

$(document).on('click', '.coins_after', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.level').hide();
    $('#bug').hide();
    $('#shop').show();
    $('.login_shop').hide();
    $('.grid_shop').removeClass('hide_shop');
    $('.grid_sorter').removeClass('hide_shop');
    $('.footer_grid_shop').show();
    $('.grid_shop').show();
    $('.grid_sorter').show();

})

$(document).on('click', '#btn_shop', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#shop').fadeIn();
    $('.classement').hide();

    setTimeout(() => {
        if ($(window).width() < 728) {
            $('html, body').animate({
                scrollTop: $(".shop").offset().top + 20
            }, "slow");
        }
    }, 200);

})

$(document).on('click', '#close_shop', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.shop').fadeOut();
    $('.level').fadeIn();

})

$(document).on('click', '.btn_shop_item', function (e) {

    e.preventDefault();

    playAudioClic();

    var item = $(this).data('item'),
        item_name = $(this).data('name'),
        item_price = $(this).data('price'),
        item_price_amount = $(this).data('amount'),
        pseudo = $('input[name=pseudo_shop_login]').val(),
        item_image = $(this).data('image');

    $('.footer_grid_shop').hide();

    $('.grid_shop').hide();
    $('.grid_sorter').hide();

    $('.pay .header').html('<div class="item_shop"><img src="../assets/img/level/' + item_image + '.png" /><p>' + item_name + ' - <span class="price">' + item_price + '</span></p></div>');

    $('.pay').fadeIn(300);

    $('.pay .stripe').html('<div class="card_element"><form id="payment-form"><div id="card-element"></div><button id="submit_card"><div class="spinner hidden" id="spinner"></div><span id="button-text">Payer</span></button></form></div>');

    $('.pay .d_back_items').show();

    $('.pay .header').show();
    $('.pay .stripe').show();


    // Paiement
    var prod = "pk_live_51KZXrwFGWvBXDlKDZbQHkmfwDDBht2rZ8mNw6Cktwn8bHTsnoQeYY8Y7qpkZYmO8Fm2A0mhVX3w2VNTUNkq6CKdQ00B6eEJ0jW",
        stripe,
        api;

    api = prod;

    purchase = {
        items: [{
            id: item,
            amount: parseFloat(item_price_amount),
            description: 'Motif : ' + item_name + ' - Total : ' + item_price + ' - ' + ' Personnage : ' + pseudo
        }]
    };


    // A reference to Stripe.js initialized with your real test publishable API key.
    stripe = Stripe(api);

    // Disable the button until we have Stripe set up on the page
    document.querySelector("#submit_card").disabled = true;

    fetch("/ajax/ajax-card.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(purchase)
        })
        .then(function (result) {
            return result.json();
        }).catch(function (error) {
            console.log(error);
        })
        .then(function (data) {

            var elements = stripe.elements();
            var card = elements.create("card", {
                //style: style
            });

            // Stripe injects an iframe into the DOM

            card.mount("#card-element");

            card.on("change", function (event) {

                // Disable the Pay button if there are no card details in the Element
                document.querySelector("button").disabled = event.empty;

                // Disable the Pay button if there are no card details in the Element
                document.querySelector("button").disabled = event.empty;
            });

            $(document).on('submit', '#payment-form', function (event) {
                event.preventDefault();
                // Complete payment when the submit button is clicked
                payWithCard(stripe, card, data.clientSecret);
            })
            // var form = document.getElementById("payment-form");
            // form.addEventListener("submit", function(event) {

            // });

        }).catch(function (error) {
            console.log(error);
        });

    // Calls stripe.confirmCardPayment
    // If the card requires authentication Stripe shows a pop-up modal to
    // prompt the user to enter authentication details without leaving your page.
    var payWithCard = function (stripe, card, clientSecret) {

        // Show a success message within this page, e.g.
        $(".pay .stripe").fadeOut(300);

        $('.pay #quit_shop_login').hide();
        $('.pay #back_items').hide();

        setTimeout(() => {
            $(".pay .lds-ring").fadeIn(600);
        }, 200);

        stripe
            .confirmCardPayment(clientSecret, {
                // receipt_email: $('input[name=email]').val(),
                payment_method: {
                    card: card
                }
            })
            .then(function (result) {

                if (result.error) {
                    // Show error to your customer

                    if (result.error.type == "card_error") {

                        if (result.error.payment_method != undefined) {
                            showError(result.error.payment_method['id'], result.error.payment_method['code']);
                        } else {
                            showError2(result.error.code);
                        }

                    } else if (result.error.type == "invalid_request_error") {

                        showError3(result.error.payment_method['id'], result.error.payment_method['code']);

                    } else if (result.error.type == "api_error") {

                        showError4(result.error.payment_method['id'], result.error.payment_method['code']);

                    }


                } else {

                    // The payment succeeded!
                    orderComplete(result.paymentIntent.id, result.paymentIntent.status);
                }
            });
    };

    /* ------- UI helpers ------- */
    // Shows a success message when the payment is complete
    var orderComplete = function (paymentIntentId, status) {

        $.ajax({
            url: "/ajax/ajax-paiementSuccessful.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
                origin: "stripe",
                id_produit: item,
                transaction_id: paymentIntentId,
                statut_transaction: status
            },
            cache: false,
            success: function (data) {

                $(".pay .lds-ring").hide();
                $('.pay .stripe').remove();
                $('.pay .header').remove();

                $('.after_paiement img').attr('src', 'assets/img/check.png');
                $('.after_paiement h2').html('Ton paiement est accepter');
                $('.after_paiement p').html('Ton compte à été créditer de <span class="credit"></span>.<br/><br/>');
                $('.after_paiement p').append('Tu as reçu un email de récapitulatif de ta commande.<br/><br/>');
                $('.after_paiement p').append('Tu vas être redirigé dans quelque instant.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

                setTimeout(() => {
                    location.reload();
                }, 1200);

            }

        });

    };

    // Show the customer the error from Stripe if their card fails to charge
    var showError = function (paymentIntentId, status) {

        $.ajax({
            url: "ajax/ajax-paiementCanceled.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
                id_produit: item,
                origin: "stripe",
                transaction_id: "",
                statut_transaction: "CANCELED"
            },
            cache: false,
            success: function (data) {

                $(".pay .lds-ring").hide();
                $('.pay .stripe').remove();
                $('.pay .header').remove();

                $('.after_paiement img').attr('src', 'assets/img/cancel.png');
                $('.after_paiement h2').html('Ton paiement à été refusée');
                $('.after_paiement p').html('Tu n\'a pas été débité sur ton compte bancaire.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

            }

        });

    };

    var showError2 = function () {

        $.ajax({
            url: "/ajax/ajax-paiementCanceled.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
                id_produit: item,
                origin: "stripe",
                transaction_id: "",
                statut_transaction: "CANCELED"
            },
            cache: false,
            success: function (data) {

                $(".pay .lds-ring").hide();
                $('.pay .stripe').remove();
                $('.pay .header').remove();

                $('.after_paiement img').attr('src', 'assets/img/cancel.png');
                $('.after_paiement h2').html('Ton paiement à été refusée');
                $('.after_paiement p').html('Tu n\'a pas été débité sur ton compte bancaire.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

            }

        });

    };

    var showError3 = function () {

        $.ajax({
            url: "/ajax/ajax-paiementError.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
                id_produit: item,
                origin: "stripe",
                transaction_id: "",
                statut_transaction: "CANCELED"
            },
            cache: false,
            success: function (data) {

                $(".pay .lds-ring").hide();
                $('.pay .stripe').remove();
                $('.pay .header').remove();

                $('.after_paiement img').attr('src', 'assets/img/cancel.png');
                $('.after_paiement h2').html('Ton paiement à été refusée');
                $('.after_paiement p').html('Tu n\'a pas été débité sur ton compte bancaire.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

            }

        });

    };

    var showError4 = function () {

        $.ajax({
            url: "/ajax/ajax-paiementError.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
                id_produit: item,
                origin: "stripe",
                transaction_id: "",
                statut_transaction: "CANCELED"
            },
            cache: false,
            success: function (data) {

                $(".pay .lds-ring").hide();
                $('.pay .stripe').remove();
                $('.pay .header').remove();

                $('.after_paiement img').attr('src', 'assets/img/cancel.png');
                $('.after_paiement h2').html('Ton paiement à été refusée');
                $('.after_paiement p').html('Tu n\'a pas été débité sur ton compte bancaire.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

            }

        });
    };

})

$(document).on('click', '#quit_shop_login', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.shop').fadeOut();
    $('.level').fadeIn();

})

$(document).on('click', '#quit_shop_login_end', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.stripe').html('');
    $('.stripe').hide();
    $('.header').hide();
    $('.d_back_items').hide();
    $('.after_paiement').hide();
    $('.grid_shop').show();
    $('.grid_sorter').show();

})

$(document).on('click', '#back_items', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.stripe').html('');
    $('.stripe').hide();
    $('.header').hide();
    $('.d_back_items').hide();
    $('.after_paiement').hide();
    $('.grid_shop').show();
    $('.grid_sorter').show();

});

$(document).on('click', '#next_level', function (e) {

    e.preventDefault();

    playAudioClic();

    $.ajax({
        url: "/ajax/ajax-nextLevel.php",
        method: 'GET',
        success: function (data) {

            var res = JSON.parse(data);

            if (res.nextlevel === true) {

                setTimeout(() => {
                    location.href = '/level/' + res.level;
                }, 600);


            }

        }

    });

});

$(document).on('click', '#chest_btn', function (e) {

    e.preventDefault();

    playAudioClic();
    playAudioChest();

    $('.tbl').addClass('chest_opening');

});

$(document).on('click', '.close_chest_bonus', function (e) {

    e.preventDefault();

    playAudioClic();

    $('.tbl').removeClass('chest_opening');

});

$(document).on('click', '#chest_btn_open', function (e) {

    e.preventDefault();

    playAudioClic();

    $(this).find('img').attr('style', 'animation: ChestOpen 0.5s cubic-bezier(.36, .07, .19, .97) infinite;');

    var ingot = Math.floor(1 + Math.random() * 4);
    var coin = Math.floor(1 + Math.random() * 4);

    $('.grid_bonus .item_ingot span').html(ingot);
    $('.grid_bonus .item_coin span').html(coin);

    setTimeout(() => {
        $(this).find('img').attr('style', 'animation: none');
        $(this).find('img').attr('src', '../assets/img/level/chest_bonus_1.png');
        $('.grid_bonus').attr('style', 'display: flex;');
        $(this).addClass('disabled');

        $.ajax({
            url: '/ajax/ajax-chestbonus.php',
            type: 'POST',
            data: {
                ingot: ingot,
                coins: coin
            },
            success: function (data) {

                var res = JSON.parse(data);

                if (res.chest === true) {

                    setTimeout(() => {

                        countdownManager = {
                            // Configuration
                            targetTime: new Date(res.bonus), // Date cible du compte à rebours (00:00:00)
                            displayElement: { // Elements HTML où sont affichés les informations
                                day: null,
                                hour: null,
                                min: null,
                                sec: null
                            },

                            // Initialisation du compte à rebours (à appeler 1 fois au chargement de la page)
                            init: function () {
                                // Récupération des références vers les éléments pour l'affichage
                                // La référence n'est récupérée qu'une seule fois à l'initialisation pour optimiser les performances
                                this.displayElement.hour = jQuery('#countdown_hour');
                                this.displayElement.min = jQuery('#countdown_min');
                                this.displayElement.sec = jQuery('#countdown_sec');

                                // Lancement du compte à rebours
                                this.tick(); // Premier tick tout de suite
                                window.setInterval("countdownManager.tick();", 1000); // Ticks suivant, répété toutes les secondes (1000 ms)
                            },

                            // Met à jour le compte à rebours (tic d'horloge)
                            tick: function () {
                                // Instant présent
                                var timeNow = new Date();

                                // On s'assure que le temps restant ne soit jamais négatif (ce qui est le cas dans le futur de targetTime)
                                if (timeNow > this.targetTime) {
                                    timeNow = this.targetTime;
                                }

                                // Calcul du temps restant
                                var diff = this.dateDiff(timeNow, this.targetTime);

                                this.displayElement.hour.text(diff.hour);
                                this.displayElement.min.text(diff.min);
                                this.displayElement.sec.text(diff.sec);
                            },

                            // Calcul la différence entre 2 dates, en jour/heure/minute/seconde
                            dateDiff: function (date1, date2) {
                                var diff = {} // Initialisation du retour
                                var tmp = date2 - date1;

                                tmp = Math.floor(tmp / 1000); // Nombre de secondes entre les 2 dates
                                diff.sec = tmp % 60; // Extraction du nombre de secondes
                                tmp = Math.floor((tmp - diff.sec) / 60); // Nombre de minutes (partie entière)
                                diff.min = tmp % 60; // Extraction du nombre de minutes
                                tmp = Math.floor((tmp - diff.min) / 60); // Nombre d'heures (entières)
                                diff.hour = tmp % 24; // Extraction du nombre d'heures
                                diff.day = tmp;

                                return diff;
                            }
                        };

                        jQuery(function ($) {
                            // Lancement du compte à rebours au chargement de la page
                            countdownManager.init();
                        });

                        $('.bonus_time').fadeIn(200);
                    }, 200);

                }

                if (res.chest === false) {

                }

            }
        });
    }, 1600);


});

setInterval(() => {

    $.ajax({
        url: '/ajax/ajax-userOnline.php',
        success: function (data) {}
    })

    $.ajax({
        url: '/ajax/ajax-showUserOnline.php',
        success: function (data) {

            $('.numberPlayer').html(data)

        }
    })

}, 1000);