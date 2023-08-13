<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Demandes d\'absence';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal');
echo $this->render('_modal_motif');
?>
<?= Alert::widget() ?>
<div class="demande-index">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des demandes d'absences</li>
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



                <div class="row">


                    <div class="col-sm-12">


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
                                        'label' => 'Numéro',
                                        'value' => 'numero',
                                    ],
                                    [
                                        'label' => 'Personnel',
                                        'value' => function ($data) {
                                            return $data->createdBy->nom . ' ' . $data->createdBy->prenoms;
                                        }
                                    ],

                                    [
                                        'label' => 'Type d\'absence',
                                        'value' => function ($data) {
                                            return $data->idtypeconge0->libelle;
                                        }
                                    ],
                                    [
                                        'label' => 'Début d\'absence',
                                        'format' => ['date', 'php:d-m-Y H:i'],
                                        'value' => 'debutconge',
                                    ],

                                    [
                                        'label' => 'Fin d\'absence',
                                        'format' => ['date', 'php:d-m-Y H:i'],
                                        'value' => 'debutconge',

                                    ],

                                    [
                                        'attribute' => 'statut',
                                        'header' => 'Statut',
                                        /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            /*  $data = $data['statut']; */
                                            if (($data->statut == 0)) {
                                                return '<span class="label label-info">EN ATTENTE</span>';
                                            } elseif (($data->statut == 1)) {
                                                return '<span class="label label-success"> ACCORDEE </span>';
                                            } elseif (($data->statut == 4)) {
                                                return '<span class="label label-danger"> REJETTEE </span>';
                                            } else {
                                                return '';
                                            }
                                        },
                                    ],

                                    //'motif:ntext',

                                    //'motif_refus:ntext',

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {
                                                $droit = Utils::have_access('traiterdemande');
                                                if ($data->statut == 4) {
                                                    return '<button type="button" class="btn btn-xs btn-info"><a title="' . Yii::t('app', 'Voir') . '" class="" href="#" data-toggle="modal" data-target="#exampleModalRefus" onclick="affiche_motif(\'' . $data->motif_refus . '\')"><i class="fa fa-eye" style="color:white"></i></a> </button>';
                                                } else {
                                                    $url = 'view_demande?key_demande=' . $data->key_demande;
                                                    return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-info" href="' . $url . '"><i class=" fa fa-eye"></i></a>';
                                                } 
                                            },
                                        ],
                                    ],

                                    /*  [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}',
                                    'headerOptions' => ['width' => '15'],
                                    'buttons' => [
                                        'update' => function ($url, $data) {
                                            if (($data->statut == 0) && $data->created_by == Yii::$app->user->identity->id) {
                                                //$url = 'sup_sortie?key_sortie=' . $data->key_sortie;
                                                $url = 'update_demande?key_demande=' . $data->key_demande;
                                                return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-xs" href="' . $url . '">
                                    <i class=" fa fa-pencil"></i>
                                    </a>';
                                            }
                                        },
                                    ],
                                ], */
                                    /* [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                    'headerOptions' => ['width' => '15'],
                                    'buttons' => [
                                        'delete' => function ($url, $data) {
                                            if (($data->statut == 0) && $data->created_by == Yii::$app->user->identity->id) {
                                                //$url = 'sup_entree?key_entree=' . $data->key_entree;
                                                return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-xs" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_demande(\'' . $data->key_demande . '\')">
                                                    <i class="fa fa-trash"></i>
                                                    </a>';
                                            }
                                        },
                                    ],
                                ] */

                                    //['class' => 'yii\grid\ActionColumn'],
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
    function delete_demande(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cette demande de congé. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function affiche_motif(motif_refus) {
        alert('okok');
        document.getElementById('modalTitleRefus').innerHTML = 'Motif de rejet';
        document.getElementById('modalContentRefus').innerHTML = 'Cette demande a été rejeté pour le motif suivant : ';
        document.getElementById('motifRefus').value = '';
        document.getElementById('motifRefus').value = motif_refus;
    }

    function validate_sortie(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de validation';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de valider cette sortie. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_demande";
        let key_element = document.getElementById('keyElement').value;
        if (key_element != '') {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    key_element: key_element
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        }
    }
</script>