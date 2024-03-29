<!-- Script -->
<script src="<?= $static_url ?>js/bootstrap.min.js"></script>
<script src="<?= $static_url ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $static_url ?>js/jquery.cookie.js"></script>

<?php if (empty($_GET['level'])) { ?>
    <script src="<?= $static_url ?>js/home.js?<?= time() ?>"></script>
<?php } else { ?>
    <script src="<?= $static_url ?>js/level.js?<?= time() ?>"></script>
<?php } ?>

<?php if (!empty($_SESSION['user_id']) && $classement_user['chest_bonus'] <= date('Y-m-d H:i:s')) { ?>

<?php } else { ?>

    <script>
        countdownManager = {
            // Configuration
            targetTime: new Date('<?= $classement_user['chest_bonus'] ?>'), // Date cible du compte à rebours (00:00:00)
            displayElement: { // Elements HTML où sont affichés les informations
                day: null,
                hour: null,
                min: null,
                sec: null
            },

            // Initialisation du compte à rebours (à appeler 1 fois au chargement de la page)
            init: function() {
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
            tick: function() {
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
            dateDiff: function(date1, date2) {
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

        jQuery(function($) {
            // Lancement du compte à rebours au chargement de la page
            countdownManager.init();
        });
    </script>

<?php } ?>

</body>

</html>