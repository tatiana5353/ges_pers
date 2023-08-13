<?php

use backend\controllers\Utils;
use backend\models\Suivie;
use frontend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */

$this->title = "Employé ";
$this->params['breadcrumbs'][] = ['label' => 'Affectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
echo Alert::widget();
echo $this->render('_modal_createtache');
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
                                            return $data->iduser0->nom . " " . $data->iduser0->prenoms;
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
                            <p> <?php
                                echo '<button type="button" onclick="create_tacheaffectation(\'' . $model->id . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#createTacheaffectation"><i class="glyphicon glyphicon-plus"></i> </button>';

                                ?></p>
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
                                        'label' => 'Debut de la tache',
                                        'value' => function ($model) {
                                            $suivie = Suivie::find()
                                                ->where(['idtache' => $model->id])
                                                ->orderBy(['created_at' => SORT_DESC])
                                                ->one();

                                            return $suivie !== null ? date('d-m-Y H:i', strtotime($suivie->date_debut)) : 'Non disponible';
                                        },
                                    ],
                                    [
                                        'label' => 'Fin de la tache',
                                        'value' => function ($model) {
                                            $suivie = Suivie::find()
                                                ->where(['idtache' => $model->id])
                                                ->orderBy(['created_at' => SORT_DESC])
                                                ->one();

                                            return  $suivie !== null ? date('d-m-Y H:i', strtotime($suivie->date_prob)) : 'Non disponible';
                                        },
                                    ],
                                    [
                                        'attribute' => 'statut',
                                        'header' => 'Statut',
                                        /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                        'format' => 'raw',
                                        'label' => 'Etat',
                                        'value' =>  function ($data) {
                                            $suivie = Suivie::find()
                                                ->where(['idtache' => $data->id])
                                                ->orderBy(['created_at' => SORT_DESC])
                                                ->one();
                                            if (($suivie->statut == 0)) {
                                                return '<span style="background-color: #337ab7; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">REALISEE</span>';
                                            } elseif (($suivie->statut == 1)) {
                                                return '<span style="background-color: #5cb85c; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> VALIDEE </span>';
                                            } elseif (($suivie->statut == 2)) {
                                                return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> NON REALISEE </span>';
                                            } else {
                                                return '';
                                            }
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {

                                                $url = 'view_tache?key_tache=' . $data->key_tache;
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
        </div>
    </div>
</div>

<script>
    function create_tacheaffectation(idaffectation) {
        document.getElementById('createTacheTitle').innerHTML = 'Ajout d\'une tache à l\'affectation';
        document.getElementById('idAffectation').value = idaffectation;
    }

    function create_tache_enter() {
        let url = "<?= Yii::$app->homeUrl ?>create_tacheaffectation";
        let idaffectation = document.getElementById('idAffectation').value;
        let designation = document.getElementById('createtacheDesignation').value;
        let dateDebut = document.getElementById('createtacheDebut').value;
        let dateProb = document.getElementById('createtacheProb').value;
        let commentaire = document.getElementById('createtacheCommentaire').value;
        var currentDate = new Date().toISOString().split('T')[0];
        if (dateDebut > currentDate) {
            alert('La date ne peut pas être dans le futur.');
            return false;
        } else {
            if (idaffectation != '') {
                //alert(idaffectation+'g'+designation+'r'+commentaire);
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        idaffectation: idaffectation,
                        designation: designation,
                        datedebut: dateDebut,
                        dateprob: dateProb,
                        commentaire: commentaire
                        /*   idtype_tache: idtype_tache,
                          designation: designation,
                          idprojet: idprojet */
                    },
                    success: function(result) {
                        document.location.reload();
                    }
                });
            }
        }
    }
</script>