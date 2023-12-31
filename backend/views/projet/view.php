<?php

use backend\controllers\Utils;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Projet */

$this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projet-view">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/gespers/admin/all_projet"> Liste des projets</a></li>
                    <li class="breadcrumb-item active">Détail</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="panel panel-default" stle="background-color: #7dc3e8;">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <h1><?= Html::encode($this->title) ?></h1>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [

                                    'libelle',

                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <!--    <?= Html::encode($this->title) ?> -->
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
                                    ['class' => 'yii\grid\SerialColumn'],

                                    // 'id',
                                    [
                                        'label' => 'Type de tache',
                                        'value' => function ($data) {
                                            return $data->idtypetache0->libelle;
                                        }
                                    ],
                                    [
                                        'label' => 'Désignation',
                                        'value' => 'designation',
                                    ],
                                    /*  [
                                        'label' => 'Description',
                                        'value' => 'description',
                                    ], */

                                    //'heure_debut',
                                    //'heure_fin',
                                    //'key_tache',
                                    //'statut',
                                    //'created_by',
                                    //'created_at',
                                    //'updated_by',
                                    //'updated_at',
                                    //'idaffectation',
                                    //'idprojet',


                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {
                                                $droit = Utils::have_access('traiterdemande');
                                                //if (($data->statut == 0)) {
                                                $url = 'view_tache?key_tache=' . $data->key_tache;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                        <i class=" fa fa-eye"></i>
                                        </a>';
                                                //}
                                            },
                                        ],
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                        'headerOptions' => ['width' => '15'],
                                        //'visible' => $droits[3] == 1 ? true : false,
                                        'buttons' => [
                                            'update' => function ($url, $data) {
                                                $url = 'update_tache?key_tache=' . $data->key_tache;
                                                return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-xs" href="' . $url . '"><i class="fa fa-edit"></i></a>';
                                            },
                                        ],
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{delete}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'delete' => function ($url, $data) {
                                                return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-xs" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_tache(\'' . $data->key_tache . '\')">
                                        <i class="fa fa-trash"></i>
                                                </a>';
                                            },
                                        ],
                                    ]
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>