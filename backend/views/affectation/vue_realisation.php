<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TACHES REALISEES';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
<div class="affectation-index">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des affectations</li>
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
                        'border' => "0",
                        //'class' ="adv-table"
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['width' => '15'],
                            'header' => 'N°'
                        ],

                        [
                            'label' => 'designation',
                            'value' => 'designation'
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'headerOptions' => ['width' => '15'],
                            'buttons' => [
                                'view' => function ($url, $data) {
                                    $url = Yii::$app->urlManager->createUrl(['tache/view', 'key_tache' => $data->key_tache]);
                                    return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                <i class=" fa fa-eye"></i>
                                </a>';
                                },
                            ],
                        ],

                    ],

                ]); ?>
            </div>
        </div>
    </div>


</div>