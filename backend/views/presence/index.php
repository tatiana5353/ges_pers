<?php

use backend\controllers\Utils;
use frontend\widgets\Alert as WidgetsAlert;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'les personnes présentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= WidgetsAlert::widget() ?>
<div class="presence-index">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des personnes présentes</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #17a2b8;">
            <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="content-panel">
               <!--  <div class="horaire-index"> -->

                    <div class="content-panel">


                        <div class="row">

                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10">
                                <div class="content-panel">
                                    <?= GridView::widget([
                                        'layout' => '{items}{pager}',
                                        'showOnEmpty' => false,
                                        'emptyText' => Utils::emptyContent(),
                                        'dataProvider' => $dataProvider,
                                        'tableOptions' => [
                                            'class' => 'table table-bordered',
                                            'id' => 'hidden-table-info',
                                            'cellpadding' => "0",
                                            'cellspacing' => "0",
                                            'border' => "0"
                                        ],
                                        'columns' => [

                                            [
                                                'label' => 'Personnel',
                                                'value' => function ($data) {
                                                    return $data->createdBy->nom . ' ' . $data->createdBy->prenoms;
                                                }
                                            ],
                                            // 'justification:ntext',
                                            [
                                                'label' => 'Heure d\'arrivée',
                                                'format' => ['date', 'php:H:i:s'],
                                                'value' => 'heure_arrivee',
                                            ],
                                            [
                                                'label' => 'Heure de départ',
                                                'format' => ['date', 'php:H:i:s'],
                                                'value' => 'heure_depart',
                                            ],
                                            [
                                                'attribute' => 'statut',
                                                'header' => 'Statut',
                                                /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                    /*  $data = $data['statut']; */
                                                    if (($data->statut == 2)) {
                                                        return '<span class="label label-primary">EN RETARD</span>';
                                                    } elseif (($data->statut == 1)) {
                                                        return '<span class="label label-success"> PRESENT </span>';
                                                        /* } elseif ($data == '2') {
                                                return 'Servie'; */
                                                    } elseif (($data->statut == 3)) {
                                                        return '<span class="label label-danger"> ABSENT </span>';
                                                    } else {
                                                        return '';
                                                    }
                                                },
                                            ],
                                            //'key_presence',
                                            //'statut',
                                            //'created_by',
                                            //'created_at',
                                            //'updated_by',
                                            //'updated_at',
                                            //'idhoraire',

                                            /* ['class' => 'yii\grid\ActionColumn'], */
                                        ],
                                    ]); ?>


                                </div>

                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>

                    </div>


                <!-- </div> -->
            </div>
        </div>
    </div>

</div>