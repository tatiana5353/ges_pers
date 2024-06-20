<?php

use backend\assets\AppAsset;
use backend\models\Affectation;
use backend\models\Demande;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\TypeTache;
use backend\models\User;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],

                <?php
                $typetaches = TypeTache::find()->where(['statut' => 1])->all();
                foreach ($typetaches as $element1) {
                    $nbr_taches = Tache::find()->where(['in', 'statut', [0, 1]])->andWhere(['idtypetache' => $element1->id])->count() ?? 0;
                    $libelle = $element1->libelle;
                ?>["<?= $libelle ?>", <?= $nbr_taches ?>],
                <?php
                }
                ?>

                //['Work', 11],
            ]);

            var options = {
                title: 'Pourcentage des affectations par types de tâche',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart1'));
            chart.draw(data, options);
        };


        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawCharte);

        function drawCharte() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],

                <?php
                $tachesaff = Tache::find()->where(['statut' => 0])->count() ?? 0;
                $tachesvalide = Tache::find()->where(['not in', 'statut', [0, 3]])->count() ?? 0;

                ?>["Tâches validées", <?= $tachesvalide ?>],
                ["Tâches en cours", <?= $tachesaff ?>],
                <?php

                ?>

            ]);

            var options = {
                title: 'Etats des tâches',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }





        function drawCharte1s() {
            var idUser = $('#iduser').val();

            if (idUser != '') {
                var url_submit = "<?= Yii::$app->request->baseUrl ?>/get_user_infos";
                $.ajax({
                    url: url_submit,
                    type: "GET",
                    data: {
                        idUser: idUser,
                    },
                    success: function(data) {
                        var info_recup = JSON.parse(data);
                        var response = info_recup['status'];
                        if (response === "000") {
                            /* var dataArray = [
                                ['Mois', 'Performance']
                            ]; */
                            var mois_fr = info_recup['mois'];
                            var id_affectations = info_recup['id_affectations'];
                            var nbr_taches_assignees = info_recup['nbr_taches_assignees'];
                            var nbr_taches_validees = info_recup['nbr_taches_validees'];
                            var nbr_suivies = info_recup['nbr_suivies'];

                            for (var mois = 0; mois < 12; mois++) {
                                /* var ce_mois = mois_fr[mois];
                                var id_affectations_month = id_affectations[mois];
                                var nbr_taches_assignees_month = nbr_taches_assignees[mois];
                                var nbr_taches_validees_month = nbr_taches_validees[mois];
                                var nbr_suivies_month = nbr_suivies[mois];

                                if (nbr_suivies_month == 0) {
                                    nbr_suivies_month = 1;
                                }

                                if (nbr_taches_assignees_month == 0) {
                                    nbr_taches_assignees_month = 1;
                                }

                                var performance = (nbr_taches_validees_month / nbr_taches_assignees_month) * (nbr_taches_validees_month / nbr_suivies_month) * 100; */
                                //dataArray.push([ce_mois, performance]);
                                var data = google.visualization.arrayToDataTable([
                                    ['Mois', 'Performance'],
                                    [ce_mois, performance],
                                    /* ['2005', 1170],
                                    ['2006', 660],
                                    ['2007', 1030] */
                                ]);
                            }

                            // var data = google.visualization.arrayToDataTable(dataArray);

                            var options = {
                                title: 'Company Performance',
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                        }
                    }
                });
            }
        }


        google.charts.load('current', {
            'packages': ['table']
        });
        google.charts.setOnLoadCallback(drawTable);

        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('string', 'Numéro');
            data.addColumn('string', 'Nom du personnel');
            data.addColumn('string', 'Type d\'absence');
            data.addColumn('string', 'motif');
            data.addColumn('string', 'Debut-absence');
            data.addColumn('string', 'Fin-absence');

            <?php
            $demandes = Demande::find()->where(['statut' => 1])->orderBy(['created_at' => SORT_ASC])->all();

            foreach ($demandes as $demande) {

                $date = $demande->created_at;

                /* if ($entree->idpartenaire != null) {
          $partenaire = $entree->idpartenaire0->raison_social;
        }else {
          $partenaire = '';
        } */

                $typeabsence = $demande->idtypeconge0->libelle;
                $debutabsence = $demande->debutconge;
                $finabsence = $demande->finconge;
                $motif = $demande->motif;
                $numero = $demande->numero;
                $noms = $demande->iduser0->nom . ' ' . $demande->iduser0->prenoms;

                /*  if ($entree->mode_payement == 'Virement bancaire') {
          $versement_banque = $recette;
        }else {
          $versement_banque = '';
        } */



            ?>data.addRows([
                [
                    '<?= $date ?>',
                    '<?= $numero ?>',

                    '<?= $noms ?>',
                    '<?= $typeabsence ?>',
                    '<?= $motif ?>',
                    '<?= $debutabsence ?>',
                    '<?= $finabsence ?>'
                ],
            ]);


        <?php } ?>




        var table = new google.visualization.Table(document.getElementById('table_div1'));

        table.draw(data, {
            showRowNumber: true,
            width: '100%',
            height: '100%'
        });
        }
    </script>

</head>

<body>

    <!-- <div class="wrap"> -->

    <?=
    $this->render('_haut') ?>
    <?= $this->render('_gauche')
    ?>
    <?= $this->beginBody() ?>


    <section id="main-content">
        <section class="wrapper site-min-height">

            <div class="row mt">
                <div class="col-lg-12">


                    <?= $content ?>

                </div>

            </div>
        </section>
        <!-- /wrapper -->
    </section>



    <!-- </div> -->

    <footer class="footer">
        <?= $this->render('_bas') ?>
    </footer>

    <?php $this->endBody() ?>

    <script type="/text/javascript" src="template/lib/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("template/img/log.jpg", {
            speed: 500
        });
    </script>
</body>

</html>
<?php $this->endPage() ?>