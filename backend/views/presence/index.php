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
    <div class="horaire-index">
        <div class="row">
            <div class="row-content">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <div class="btn-lg btn-info waves-light " data-class="bg-info">
                                <marquee behavior="alternate" direction="">
                                    <?= Html::encode($this->title) ?>
                                </marquee>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 p-l-1 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/gespers/admin/accueil">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Presences</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-panel">
            <div class="horaire-index">


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
                                        'format' => ['date', 'php:h:i:s'],
                                        'value' => 'heure_arrivee',
                                    ],
                                    [
                                        'label' => 'Heure de départ',
                                        'format' => ['date', 'php:h:i:s'],
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
                                            } elseif (($data->statut == 3)){
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


        </div>
    </div>


</div>