<?php

use backend\assets\AppAsset;
use backend\models\Affectation;
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

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharte1);

        function drawCharte1() {
            var data = google.visualization.arrayToDataTable([
                ['Mois', 'Performance'],
                <?php
                $user = User::find()->where(['id' => 3])->one();
                $mois_fr = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Otobre', 'Novembre', 'Decembre'];

                $annee = date('Y');

                
                for ($mois = 1; $mois <= 12; $mois++) {
                    $ce_mois = $mois_fr[$mois-1];
                    $id_affectations = Affectation::find()
                        ->select(['id'])
                        ->where(['iduser' => $user->id])
                        ->andWhere(['MONTH(created_at)' => $mois, 'YEAR(created_at)' => $annee])
                        ->all();
                    $nbr_taches_assignees = Tache::find()->where(['in', 'idaffectation', $id_affectations])->count();
                    $taches_validees = Tache::find()->where(['statut' => 1])->andWhere(['in', 'idaffectation', $id_affectations])->all();
                    $nbr_taches_validees = Tache::find()->where(['statut' => 1])->andWhere(['in', 'idaffectation', $id_affectations])->count();

                    $nbr_suvie = 0;
                    foreach ($taches_validees as $tache) {
                        $nbr_suivie = Suivie::find()->where(['idtache' => $tache->id])->count() ?? 1;
                        $nbr_suvie += $nbr_suivie;
                    }
                    if ($nbr_suvie == 0) {
                        $nbr_suvie = 1;
                    }

                    if ($nbr_taches_assignees == 0) {
                        $nbr_taches_assignees = 1;
                    }
                    
                    $performance = ($nbr_taches_validees/$nbr_taches_assignees)*($nbr_taches_validees/$nbr_suvie)*100;
                    //$performance = (0/2)*(0/1)*100;

                ?>['<?= $ce_mois ?>', <?= $performance ?>],

                <?php
                }
                ?>
            ]);

            var options = {
                title: 'Performance des employés',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
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