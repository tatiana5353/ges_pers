<?php

use backend\controllers\TypetacheController;
use backend\controllers\Utils;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\TypeTache;
use frontend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Projet */

$this->title = 'Projet :' . ' ' . $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<?= Alert::widget();
echo $this->render('_modal');
echo $this->render('_modal_updatetache');
echo $this->render('_modal_createtache');
$typetache = TypeTache::find()
    ->where(['statut' => 1])
    ->all();
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
                <div class="col-lg-4">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        <div class="panel-heading">
                            <div class="panel-heading" style="background-color: #17a2b8;">
                                <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [

                                    'libelle',
                                    [
                                        'attribute' => 'statut',
                                        'header' => 'Statut',
                                        /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            if (($data->statut == 0)) {
                                                return '<span style="background-color: #A0A0A0; color: #fff; padding: 6px 12px; font-size: 12px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">EN COURS</span>';
                                            } elseif (($data->statut == 1)) {
                                                return '<span style="background-color: #5cb85c; color: #fff; padding: 6px 12px; font-size: 12px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> EFFECTUE </span>';
                                            } elseif (($data->statut == 2)) {
                                                return '<span style="background-color: #f0ad4e; color: #fff; padding: 6px 12px; font-size: 12px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> ATTENTE </span>';
                                            } else {
                                                return '';
                                            }
                                        },
                                    ],
                                ],
                            ]) ?>

                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <!--  <button class="btn btn-danger" > 
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button> -->
                                <?php echo Html::a('<i class="glyphicon glyphicon-edit"></i>', ['update', 'key_projet' => $model->key_projet], ['class' => 'btn btn-primary btn-block ']); ?>
                                <!-- <button class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button> -->
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="panel panel-default" stle="background-color: #7dc3e8;">
                        <div class="panel-heading" style="background-color: #17a2b8; color:#ffffff">
                            <h3 class="panel-title">
                                Les taches du projet<!--    <?= Html::encode($this->title) ?> -->
                            </h3>
                        </div>
                        <div class="panel-body">
                            <!-- <p> <php echo Html::a('<i class="glyphicon glyphicon-plus"></i>', ['creates', 'key_projet' => $model->key_projet], ['class' => 'btn btn-primary ']); ?> </p> -->
                            <p> <?php
                                echo '<button type="button" onclick="create_tacheprojet(\'' . $model->id . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#createTache"><i class="glyphicon glyphicon-plus"></i> </button>';

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
                                    ['class' => 'yii\grid\SerialColumn', 'header' => 'N°',],

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
                                    [
                                        'attribute' => 'statut',
                                        'header' => 'Statut',
                                        /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                        'format' => 'raw',
                                        'label' => 'Etat',
                                        'value' => function ($data) {
                                            if (($data->statut == 0)) {
                                                return '<span style="background-color: #337ab7; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">AFFECTEE</span>';
                                            } elseif (($data->statut == 1)) {
                                                return '<span style="background-color: #5cb85c; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> VALIDEE </span>';
                                            } elseif (($data->statut == 2)) {
                                                return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> NON AFFECTEE </span>';
                                            } else {
                                                return '';
                                            }
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                        'headerOptions' => ['width' => '15'],
                                        //'visible' => $droits[3] == 1 ? true : false,
                                        'buttons' => [
                                            'update' => function ($url, $data) {
                                                $suivie = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->one();
                                                if ($data->statut == 2 || $suivie->statut == 2) {
                                                    $url = 'update_tache?key_tache=' . $data->key_tache;
                                                    return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-xs" href="' . $url . '"><i class="fa fa-edit"></i></a>';
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
                                                if ($data->statut == 2) {
                                                    return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-xs" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_tache(\'' . $data->key_tache . '\')">
                                        <i class="fa fa-trash"></i>
                                                </a>';
                                                }
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

<script>
    //Delete tache
    function delete_tacheprojet(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cette tache. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_tacheprojet";
        let key_element = document.getElementById('keyElement').value;
        if (key_element != '') {
            //alert('ggggg');
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

    //Update tache
    function update_tacheprojet(key_tache, type_tache, designation) {
        document.getElementById('updateTacheTitle').innerHTML = 'Modification de la tache';
        //document.getElementById('updateTacheContent').innerHTML = 'Vous êtes sur le point de supprimer cette tache. Cette action est irréversible';

        document.getElementById('tache-idtypetache').value = type_tache;
        document.getElementById('tacheDesignation').value = designation;
        document.getElementById('keyTache').value = key_tache;
    }

    function update_tache_enter() {
        let url = "<?= Yii::$app->homeUrl ?>update_tacheprojet";
        let key_tache = document.getElementById('keyTache').value;
        let idtype_tache = document.getElementById('tache-idtypetache').value;
        let designation = document.getElementById('tacheDesignation').value;
        if (key_tache != '') {
            alert(idtype_tache);
            if (idtype_tache != '') {


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        idtype_tache: idtype_tache,
                        designation: designation,
                        key_tache: key_tache
                    },
                    success: function(result) {
                        document.location.reload();
                    }
                });
            }else{
                var err = '<div class="alert alert-danger alert-dismissible" role="alert">' +
                            ' Veuillez renseigner tous les champs obligatoires' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';
                        //$('#alert_place_g').show();
                        $('#alert_place').html(err);
            }
        }
    }

    //create tache

    function create_tacheprojet(idprojet) {
        document.getElementById('createTacheTitle').innerHTML = 'Ajout d\'une tache au projet';
        document.getElementById('idProjet').value = idprojet;
    }

    function create_tache_enter() {
        let url = "<?= Yii::$app->homeUrl ?>create_tacheprojet";
        let idprojet = document.getElementById('idProjet').value;
        let idtype_tache = document.getElementById('idCreatetypetache').value;
        let designation = document.getElementById('createtacheDesignation').value;
        if (idprojet != '') {
            if (idtype_tache != '') {
            //alert(idprojet+'g'+idtype_tache+'r'+designation);
            if (designation != '') {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    idtype_tache: idtype_tache,
                    designation: designation,
                    idprojet: idprojet
                },
                success: function(result) {
                    document.location.reload();
                }
            });
         } else{
            var err = '<div class="alert alert-danger alert-dismissible" role="alert">' +
                            ' Veuillez la désignation de la tâche' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';
                        //$('#alert_place_g').show();
                        $('#alert_place').html(err);
            }
        }else{
                var err = '<div class="alert alert-danger alert-dismissible" role="alert">' +
                            ' Veuillez renseigner tous les champs obligatoires' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';
                        //$('#alert_place_g').show();
                        $('#alert_place').html(err);
            }
        }
    }
</script>