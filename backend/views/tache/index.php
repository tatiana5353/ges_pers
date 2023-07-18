<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taches';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal');
?>

<?= Alert::widget() 
?>

<div class="tache-index">

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
                                <li class="breadcrumb-item active">Liste des taches</li>
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
                        <p>
                            <?= Html::a('Ajouter une tache', ['create'], ['class' => 'btn btn-info']) ?>
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
                                        'label' => 'Description',
                                        'value' => 'description',
                                    ],
                                
                                    //'heure_debut',
                                    //'heure_fin',
                                    //'key_tache',
                                    //'statut',
                                    //'created_by',
                                    //'created_at',
                                    //'updated_by',
                                    //'updated_at',
                                    //'idaffectation',
                                    'idprojet',
                                   

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
                <div class="col-sm-1">
                </div>

            </div>


        </div>
    </div>





</div>

<script>
    function delete_tache(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cette tache. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_tache";
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