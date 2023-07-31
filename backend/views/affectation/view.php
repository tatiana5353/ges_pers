<?php

use backend\controllers\Utils;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */

$this->title = "Employé " ;
$this->params['breadcrumbs'][] = ['label' => 'Affectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="affectation-view">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/gespers/admin/all_affectation">Affectations</a></li>
                    <li class="breadcrumb-item active">Détail</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="panel panel-default" stle="background-color: #7dc3e8;">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        
                            <div class="panel-heading" style="background-color: #17a2b8;">
                                <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
                            </div>
                        
                        <div class="panel-body">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [

                                    'numero',

                                    [
                                        'label' => 'Nom',
                                        'value' => function ($data) {
                                            return $data->iduser0->nom . " ". $data->iduser0->prenoms ;
                                        }
                                    ]
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        <div class="panel-heading" style="background-color: #17a2b8;">
                            <h3 class="panel-title" style="color: #ffffff;">
                                Les taches de l'employé
                            </h3>
                        </div>
                        <div class="panel-body">
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
                                        'label' => 'Tâches',
                                        'value' => function ($data) {
                                            return $data->designation;
                                        }
                                    ],

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {
                                                //$droit = Utils::have_access('traiteraffectation');
                                                /* if (($data->statut == 4)) {
                                        $url = 'view_affectation?key_affectation=' . $data->key_affectation;
                                        return '<button type="button" class="btn btn-xs btn-success"><a title="' . Yii::t('app', 'Détail') . '" class="
                                    " href="#" data-toggle="modal" data-target="#exampleModal2" onclick="affiche_motif(\'' . $data->motif_refus . '\')"> 
                                    <i class=" fa fa-eye" style="color: red;"></i></a> </button>';
                                    } else if (($data->statut == 0)) { */
                                                $url = 'view_tache?key_tache=' . $data->key_tache;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                <i class=" fa fa-eye"></i>
                                </a>';
                                                // }
                                                /* } else if ($droit == 1) {
                                        $url = 'view_affectation?key_affectation=' . $data->key_affectation;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                <i class=" fa fa-eye"></i>
                                </a>';
                                    } */
                                            },
                                        ],
                                    ],

                                ],

                            ]); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>