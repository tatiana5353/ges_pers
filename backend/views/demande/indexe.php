<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Demandes de congés';
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
                    <li class="breadcrumb-item active">Liste des demandes de congés</li>
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


                <div class="row">


                    <div class="col-sm-12">
                        <p>
                            <?= Html::a('Ajouter demande', ['create'], ['class' => 'btn btn-info']) ?>
                        </p>

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
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'id',
                                    [
                                        'label' => 'Numéro',
                                        'value' => 'numero',
                                    ],
                                    [
                                        'label' => 'Type de congé',
                                        'value' => function ($data) {
                                            return $data->idtypeconge0->libelle;
                                        }
                                    ],
                                    [
                                        'label' => 'Début de congé',
                                        'format' => ['date', 'php:d-m-Y'],
                                        'value' => function ($data) {
                                            if (($data->created_by == Yii::$app->user->identity->id)) {
                                                return $data->debutconge;
                                            }
                                        }

                                    ],

                                    [
                                        'label' => 'Fin de congé',
                                        'format' => ['date', 'php:d-m-Y'],
                                        'value' => function ($data) {
                                            if (($data->created_by == Yii::$app->user->identity->id)) {
                                                return date('y-m-d', strtotime($data->finconge));
                                            }
                                        }

                                    ],

                                    [
                                        'attribute' => 'statut',
                                        'header' => 'Statut',
                                        /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            /*  $data = $data['statut']; */
                                            if (($data->statut == 0) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                return '<span class="label label-primary">EN ATTENTE</span>';
                                            } elseif (($data->statut == 1) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                return '<span class="label label-success"> ACCORDEE </span>';
                                                /* } elseif ($data == '2') {
                                            return 'Servie'; */
                                            } elseif (($data->statut == 4) && ($data->created_by == Yii::$app->user->identity->id)) {
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
                                                if (($data->statut == 4) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                    $url = 'view_demande?key_demande=' . $data->key_demande;
                                                    return '<button type="button" class="btn btn-xs btn-success"><a title="' . Yii::t('app', 'Détail') . '" class="" href="#" data-toggle="modal" data-target="#exampleModal2" onclick="affiche_motif(\'' . $data->motif_refus . '\')"> 
                                                <i class=" fa fa-eye" style="color: red;"></i></a> </button>';
                                                } else if (($data->statut == 0) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                    $url = 'view_demande?key_demande=' . $data->key_demande;
                                                    return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                    <i class=" fa fa-eye" style="color: blue;"></i>
                                    </a>';
                                                } else if ($data->created_by == Yii::$app->user->identity->id) {
                                                    $url = 'view_demande?key_demande=' . $data->key_demande;
                                                    return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                    <i class=" fa fa-eye"></i>
                                    </a>';
                                                }
                                            },
                                        ],
                                    ],

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'update' => function ($url, $data) {
                                                if (($data->statut == 0) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                    //$url = 'sup_sortie?key_sortie=' . $data->key_sortie;
                                                    $url = 'update_demande?key_demande=' . $data->key_demande;
                                                    /* print($data->numero);die; */
                                                    return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-xs" href="' . $url . '">
                                                    <i class=" fa fa-pencil"></i>
                                                    </a>';
                                                }
                                            },
                                        ],
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{delete}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'delete' => function ($url, $data) {
                                                if (($data->statut == 0) && ($data->created_by == Yii::$app->user->identity->id)) {
                                                    //$url = 'sup_entree?key_entree=' . $data->key_entree;
                                                    return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-xs" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_demande(\'' . $data->key_demande . '\')">
                                <i class="fa fa-trash"></i>
                                        </a>';
                                                }
                                            },
                                        ],
                                    ]

                                    //['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>


                <!--  </div> -->


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

    function affiche_motif(key_element) {

        document.getElementById('modalTitle2').innerHTML = 'Motif de rejet';
        document.getElementById('modalContent2').innerHTML =
            'Cette demande a été rejeté pour le motif suivant : ';
        document.getElementById('keyElement2').value = key_element;
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