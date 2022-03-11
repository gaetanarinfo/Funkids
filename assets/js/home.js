// home //

// Show user online
setInterval(() => {
    
    $.ajax({
        url: '/ajax/ajax-showUserOnline.php',
        success: function(data) {

            $('.numberPlayer').html(data)

        }
    })

}, 1000);

var sound_1 = document.getElementById("sound_1"),
    clic_1 = document.getElementById("clic_1"),
    timeout_1 = 500;

$.cookie.raw = true;


if ($.cookie("soundGeneral") != undefined) {
    sound_1.volume = parseFloat($.cookie("soundGeneral"));
}

if ($.cookie("soundBruitage") != undefined) {
    clic_1.volume = parseFloat($.cookie("soundBruitage"));
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

$(document).on('click', '#btn_start', function (e) {

    e.preventDefault();

    playAudioClic();

    setTimeout(() => {

        $(this).hide();
        $('#home #loader').show();

    }, timeout_1);

    setTimeout(() => {

        $('#home #loading').hide();
        $('#home #menu').show();

    }, timeout_1 * 7);

})

$(document).on('click', '#btn_exit_game', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #menu').hide();
    $('#home #option').hide();
    $('#home #loader').hide();
    $('#home #new_game').hide();
    $('#home #login_game').hide();
    $('#home #aide').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #loading').show();
    $('#home #btn_start').show();

})

$(document).on('click', '#btn_option', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #menu').hide();
    $('#home #option').show();

})

$(document).on('click', '#quit_option', function (e) {

    e.preventDefault();

    playAudioClic();

    sound_1.volume = $('#sound_1').attr('volume');
    clic_1.volume = $('#clic_1').attr('volume');

    $('#home #option').hide();
    $('#home #menu').show();

})

$(document).on('change', '#soundGeneral', function (e) {

    var value = parseFloat($(this).val());

    sound_1.volume = value;

})

$(document).on('change', '#soundBruitage', function (e) {

    var value = parseFloat($(this).val());

    clic_1.volume = value;

})


$(document).on('click', '#save_option', function (e) {

    e.preventDefault();

    playAudioClic();

    $.cookie("soundGeneral", parseFloat($('#soundGeneral').val()), {
        expires: 365,
        path: '/'
    });

    $.cookie("soundBruitage", parseFloat($('#soundBruitage').val()), {
        expires: 365,
        path: '/'
    });

    $('#sound_1').attr('volume', parseFloat($('#soundGeneral').val()));
    $('#clic_1').attr('volume', parseFloat($('#soundBruitage').val()));

    $('#home #option').hide();
    $('#home #menu').show();

})

$(document).on('click', '#btn_classement_game', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home .classement').fadeIn();
    $('#home #shop').hide();

    setTimeout(() => {
        if ($(window).width() < 728) {
            $('html, body').animate({
                scrollTop: $(".classement").offset().top + 20
            }, "slow");
        }
    }, 200);

})

$(document).on('click', '#close_classement', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home .classement').fadeOut();

})

$(document).on('click', '#quit_bug', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #bug').hide();
    $('#home #menu').show();

})

$(document).on('click', '#report_bug', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #loading').hide();
    $('#home #menu').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #option').hide();
    $('#home #new_game').hide();
    $('#home #login_game').hide();
    $('#home #aide').hide();
    $('#home #bug').show();

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

$(document).on('click', '#btn_play_game', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #menu').hide();
    $('#home #option').hide();
    $('#home #loader').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #aide').hide();
    $('#home #new_game').show();

})

$(document).on('click', '#btn_login_game', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #menu').hide();
    $('#home #option').hide();
    $('#home #loader').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #aide').hide();
    $('#home #new_game').hide();
    $('#home #login_game').show();

})

$('#form_new_game').submit(function (e) {

    e.preventDefault();

    newGame();

})

function newGame() {

    playAudioClic();

    var url = "/ajax/ajax-newGame.php",
        formData = $("#form_new_game").serialize();

    $('#btn_new_game').attr('disabled', '');

    $("#form_new_game :input").prop("disabled", true);
    $('#new_game .form').addClass('loading');
    $('#new_game .lds-ring').show();
    $("#form_new_game").parent().css('min-height', 'auto');
    $('#new_game .lds-ring').parent().css('min-height', 'auto');

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        success: function (data) {

            console.log(data);

            var res = JSON.parse(data);

            if (res.register === true) {

                setTimeout(() => {

                    location.href = '/level/' + res.level;

                }, 1600);

            }

            if (res.register === false) {

                setTimeout(() => {
                    $('.lds-ring').hide();
                    $('#new_game .message_success img').attr('src', res.icone);
                    $('#new_game .message_success h3').attr('class', res.color);
                    $('#new_game .message_success h3').html(res.title);
                    $('#new_game .message_success p').html(res.message);
                    $('#new_game .message_success').show();
                }, 700);

                setTimeout(() => {
                    $("#form_new_game :input").prop("disabled", false);
                    $('#new_game .lds-ring').hide();
                    $('#new_game .form').removeClass('loading');
                    $('#new_game .message_success').hide();
                    $("#new_game .box").removeAttr('style');
                    $('#new_game .body').removeAttr('style');
                }, 2100);


            }

        },
        error: function (err) {
            console.log("Error: ", err);
        }
    })

}

$('#connexion_game').submit(function (e) {

    e.preventDefault();

    loginGame();

})

function loginGame() {

    playAudioClic();

    $('#btn_login_games').attr('disabled', '');

    $("#connexion_game :input").prop("disabled", true);
    $('#login_game .form').addClass('loading');
    $('#login_game .lds-ring').show();
    $("#connexion_game").parent().css('min-height', 'auto');
    $('#login_game .lds-ring').parent().css('min-height', 'auto');

    var url = "ajax/ajax-loginGame.php";

    $.ajax({
        url: url,
        type: "POST",
        data: {
            pseudo_login: $('input[name=pseudo_login]').val(),
            password_login: $('input[name=password_login]').val()
        },
        success: function (data) {

            console.log(data);

            var res = JSON.parse(data);

            if (res.login === true) {

                setTimeout(() => {

                    location.href = '/level/' + res.level;

                }, 1600);

            }

            if (res.login === false) {

                setTimeout(() => {
                    $('.lds-ring').hide();
                    $('#login_game .message_success img').attr('src', res.icone);
                    $('#login_game .message_success h3').attr('class', res.color);
                    $('#login_game .message_success h3').html(res.title);
                    $('#login_game .message_success p').html(res.message);
                    $('#login_game .message_success').show();
                }, 700);

                setTimeout(() => {
                    $("#connexion_game :input").prop("disabled", false);
                    $('#login_game .lds-ring').hide();
                    $('#login_game .form').removeClass('loading');
                    $('#login_game .message_success').hide();
                    $("#login_game .box").removeAttr('style');
                    $('#login_game .body').removeAttr('style');
                }, 2100);


            }

        },
        error: function (err) {
            console.log("Error: ", err);
        }
    })

}

$(document).on('click', '#quit_new_game', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#new_game .message_success').hide();
    $('#home #loading').hide();
    $('#home #menu').show();
    $('#home #option').hide();
    $('#home #new_game').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #login_game').hide();
    $('#home #aide').hide();
    $('#home #bug').hide();
    $("#form_new_game :input").prop("disabled", false);
    $('#new_game .form').removeClass('loading');
    $('#btn_new_game').removeAttr('disabled');
    $(".box").parent().removeAttr('css');
    $('.body').parent().removeAttr('css');

})


$(document).on('click', '#btn_aide', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #loading').hide();
    $('#home #menu').hide();
    $('#home #option').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #new_game').hide();
    $('#home #login_game').hide();
    $('#home #aide').show();

})

$(document).on('click', '#btn_quit_aide', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #loading').hide();
    $('#home #menu').show();
    $('#home #option').hide();
    $('#home #classement').hide();
    $('#home #shop').hide();
    $('#home #new_game').hide();
    $('#home #login_game').hide();
    $('#home #aide').hide();
    $('#home #bug').hide();

})


$(document).on('click', '#btn_shop', function (e) {

    e.preventDefault();

    playAudioClic();

    $('#home #shop').fadeIn();
    $('#home .classement').hide();

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

    $('#home .shop').fadeOut();

})

$(document).on('click', '#btn_shop_games', function (e) {

    e.preventDefault();

    playAudioClic();

    var pseudo = $('input[name=pseudo_shop_login]').val();

    if (pseudo < 2) {

        $('input[name=pseudo_shop_login]').addClass('error_input');

        setTimeout(() => {
            $('input[name=pseudo_shop_login]').removeClass('error_input');
        }, 500);

    } else {

        $.ajax({
            url: "/ajax/ajax-verifPseudo.php",
            method: 'POST',
            data: {
                pseudo: pseudo,
            },
            cache: false,
            success: function (data) {

                var res = JSON.parse(data);

                if (res.user === true) {

                    $('#home .login_shop').hide();
                    $('#home .grid_shop').removeClass('hide_shop');
                    $('#home .grid_sorter').removeClass('hide_shop');
                    $('#home .footer_grid_shop').show();

                }

                if (res.user === false) {

                    $('input[name=pseudo_shop_login]').addClass('error_input');
                    $('.label_error').html('Ton compte n\'éxiste pas !');
                    $('.label_error').show();

                    setTimeout(() => {
                        $('input[name=pseudo_shop_login]').removeClass('error_input');
                        $('.label_error').html('');
                        $('.label_error').hide();
                    }, 1200);

                }

            }

        });

    }

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
                $('.after_paiement p').append('Tu as reçu un email de récapitulatif de ta commande.');

                $('.after_paiement .credit').html(item_name);

                setTimeout(() => {
                    $(".after_paiement").show();
                }, 200);

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

    $('#home .shop').fadeOut();

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

// Sorter Shop

$(document).on('click', '.shop .grid_sorter .item', function (e) {

    e.preventDefault();

    var name = $(this).data('name');

    console.log(name);

    if (name == "item_ingot") {
        $('.shop .grid_shop .item_ingot').show();
        $('.shop .grid_shop .item_coin').hide();
    } else if (name == "item_coin") {
        $('.shop .grid_shop .item_coin').show();
        $('.shop .grid_shop .item_ingot').hide();
    } else if (name == "all") {
        $('.shop .grid_shop .item_coin').show();
        $('.shop .grid_shop .item_ingot').show();
    }

})

// home //