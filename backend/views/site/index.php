<?php
/* @var $this yii\web\View */

use backend\models\Affectation;
use backend\models\Demande;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\User;
use frontend\widgets\Alert;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'GES_PERS';
/* echo $this->render('_modal'); */
?>
<?= Alert::widget();
$currentDate = date('Y-m-d H:i');
$totaluser = User::find()->where(['not in', 'status', 30])->count();
$alldemande_id = Demande::find()->select('iduser')->where(['statut' => 1])->andwhere(['>', 'finconge', $currentDate]);
$absentuser = User::find()->where(['not in', 'status', 30])
    ->andwhere(['in', 'id', $alldemande_id])->count();
?>
<div class="site-index">
    <link href="template/img/favicon.png" rel="icon">
    <link href="template/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!--  -->
    <div class="row">
        <div class="col-lg-12 main-chart">
            <!--CUSTOM CHART START -->

            <!--custom chart end-->
            <div class="row mt">
                <div class="col-md-4 col-sm-3 mb">
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>personnels</h5>
                        </div>
                        <h1 class="mt">
                            <i class="fa fa-user fa-3x"></i>
                        </h1>

                        <footer>
                            <div class="pull-left">
                                <h5>Nombre Total</h5>
                            </div>

                            <h2 style="color:white;"><?php echo $totaluser ?></h2>

                        </footer>
                    </div>
                </div>
                <!--  /darkblue panel -->

                <div class="col-md-4 col-sm-3 mb">
                    <div class="grey-panel pn donut-chart">
                        <div class="grey-header">
                            <h5>Absents</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 goleft">
                                <p><br />Nombre Total:</p>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <h2> <?= $absentuser ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /grey-panel -->
                </div>
                <!-- /col-md-4 -->
                <div class="col-md-4 col-sm-3 mb">
                    <!-- REVENUE PANEL -->
                    <div class="green-panel pn">
                        <div class="green-header">
                            <h5>Présents</h5>
                        </div>
                        <h1 class="mt">
                            <i class="fa fa-user fa-3x"></i>
                        </h1>
                        <div class="row">

                            <div class="col-sm-6 col-xs-6 goleft">
                                <h5 style="color:white">
                                    <p><br /><br />Nombre Total:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <h2 style="color:white"> <?= $totaluser - $absentuser ?></h2>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /col-md-4 -->
            </div>
            <!-- /row -->

        </div>
        <div class="row mt">
            <!-- SERVER STATUS PANELS -->

            <div class="col-md-6 col-sm-6 mb">
                <div id="chart1" style="width: 550px; height: 300px;"></div>
            </div>

            <div class="col-md-6 col-sm-6 mb">

                <div id="donutchart" style="width: 550px; height: 300px;"></div>



            </div>
            <!--  /darkblue panel -->
        </div>
    </div>


    <div class="border-head">
        <?php $form = ActiveForm::begin();
        ?>
        <?= $form->field(new User(), 'id')->dropDownList(
            ArrayHelper::map(User::find()->where(['not in', 'status', 30])->all(), 'id', 'nom'),
            [
                'prompt' => 'Choisir un Personnel',
                'id' => 'iduser',
                'class' => 'form-control',
                // Appel de la fonction handleChange avec la valeur sélectionnée
            ]
        )->error(false)->label('<h5>Personnel<span class="text-danger"></span></h5>');
        ?>
        <div class="form-group">
            <?= Html::submitButton('Simuler', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
            <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
        </div>
        <h3>Performance des utilisateurs</h3>
        <?php ActiveForm::end(); ?>
    </div>

    <div id="curve_chart"></div>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharte1);

        $(document).ready(function() {
            drawCharte1(); // Appeler la fonction lorsque la page est prête
        });

        function drawCharte1() {
            var data = google.visualization.arrayToDataTable([
                ['Mois', 'Performance'],
                <?php
                $mois_fr = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Otobre', 'Novembre', 'Decembre'];

                $annee = date('Y');

                for ($mois = 1; $mois <= 12; $mois++) {
                    $ce_mois = $mois_fr[$mois - 1];
                    $id_affectations = Affectation::find()
                        ->select(['id'])
                        ->where(['iduser' => $model->id])
                        ->andWhere(['MONTH(created_at)' => $mois, 'YEAR(created_at)' => $annee]);

                    $nbr_taches_assignees = Tache::find()->where(['in', 'idaffectation', $id_affectations])->count();
                    $taches_validees = Tache::find()->where(['statut' => 1])->andWhere(['in', 'idaffectation', $id_affectations])->all();
                    $nbr_taches_validees = Tache::find()->where(['statut' => 1])->andWhere(['in', 'idaffectation', $id_affectations])->count();

                    $nbr_suvie = 0;
                    foreach ($taches_validees as $tache) {
                        $nbr_suivie = Suivie::find()->where(['idtache' => $tache->id])->count();
                        $nbr_suvie += $nbr_suivie;
                    }
                    /* if ($nbr_suvie == 0) {
                        $nbr_suvie = 1;
                    } */

                    if (($nbr_suvie == 0) || ($nbr_taches_assignees == 0)) {
                        $performance = 0;
                    } else {
                        $performance = ($nbr_taches_validees / $nbr_taches_assignees) * ($nbr_taches_validees / $nbr_suvie) * 100;
                    }


                ?>['<?= $ce_mois ?>', <?= $performance ?>],

                <?php
                }
                ?>
            ]);

            var options = {
                title: 'Ma performance',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

</div>



<script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [{
                    type: "text",
                    label: "Special event",
                    badge: "00"
                },
                {
                    type: "block",
                    label: "Regular event",
                }
            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashio!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
            // (string | optional) the image to display on the left
            image: 'img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: 8000,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
    });
</script>