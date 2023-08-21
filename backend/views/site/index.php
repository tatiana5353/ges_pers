<?php
/* @var $this yii\web\View */

use backend\models\User;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'GES_PERS';
/* echo $this->render('_modal'); */
?>
<?= Alert::widget();

$totaluser = User::find()->where(['not in', 'status', 30])->count();
$totaluserabsent = User::find()->where(['not in', 'status', 30])
->andwhere([])->count();
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
                <!-- SERVER STATUS PANELS -->
                <div class="col-md-3 col-sm-3 mb">
                    <div class="grey-panel pn donut-chart">
                        <div class="grey-header">
                            <h5>Personnel</h5>
                        </div>
                        <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 goleft">
                                <p><br />Nombre Total:</p>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <h2> <?= $totaluser ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- /grey-panel -->
                </div>
                <!-- /col-md-4-->
                <div class="col-md-3 col-sm-3 mb">
                    <div class="darkblue-panel pn">
                        <div class="darkblue-header">
                            <h5>DROPBOX STATICS</h5>
                        </div>
                        <canvas id="serverstatus02" height="120" width="120"></canvas>
                        <script>
                            var doughnutData = [{
                                    value: 60,
                                    color: "#1c9ca7"
                                },
                                {
                                    value: 40,
                                    color: "#f68275"
                                }
                            ];
                            var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                        </script>
                        <p>April 17, 2014</p>
                        <footer>
                            <div class="pull-left">
                                <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                            </div>
                            <div class="pull-right">
                                <h5>60% Used</h5>
                            </div>
                        </footer>
                    </div>
                    <!--  /darkblue panel -->
                </div>
                <!-- /col-md-4 -->
                <div class="col-md-3 col-sm-3 mb">
                    <!-- REVENUE PANEL -->
                    <div class="green-panel pn">
                        <div class="green-header">
                            <h5>REVENUE</h5>
                        </div>
                        <div class="chart mt">
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                        </div>
                        <p class="mt"><b>$ 17,980</b><br />Month Income</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 mb">
                    <!-- REVENUE PANEL -->
                    <div class="green-panel pn">
                        <div class="green-header">
                            <h5>REVENUE</h5>
                        </div>
                        <div class="chart mt">
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                        </div>
                        <p class="mt"><b>$ 17,980</b><br />Month Income</p>
                    </div>
                </div>
                <!-- /col-md-4 -->
            </div>
            <!-- /row -->

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
            <?= $form->field(new user(), 'id')->dropDownList(
                ArrayHelper::map(User::find()->where(['not in', 'status', 30])->all(), 'id', 'nom'),
                ['prompt' => 'Choisir un Personnel', 'id' => 'iduser'],
                ['class' => 'form-control']
            )->error(false)->label('<h5>Personnel<span class="text-danger"></span></h5>');
            ?>
            <h3>USER VISITS</h3>
            <?php ActiveForm::end(); ?>
        </div>
        <div id="curve_chart">

        </div>

    </div>
    <!-- /col-lg-9 END SECTION MIDDLE -->
    <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->

    <!-- /col-lg-3 -->
</div>
<!-- /row -->
<!-- </section>
    </section> -->
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