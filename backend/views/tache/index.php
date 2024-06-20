<?php

use backend\controllers\Utils;
use backend\models\Affectation;
use backend\models\Suivie;
use backend\models\User;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liste des tâches';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal');
?>

<?= Alert::widget()
?>

<div class="tache-index">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des taches</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="horaire-index">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #17a2b8;">
                <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">



                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <?= Html::a('Ajouter une tâche', ['create'], ['class' => 'btn btn-info']) ?>
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
                                    [
                                        'class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['width' => '15'],
                                        'header' => 'N°'
                                    ],
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
                                        'value' =>  function ($data) {
                                            $suivie = Suivie::find()
                                                ->where(['idtache' => $data->id])
                                                ->orderBy(['created_at' => SORT_DESC])
                                                ->one();
                                                $nbr = Suivie::find()
                                                ->where(['idtache' => $data->id])
                                                ->count();
                                            if ($data->statut !== 2) {
                                                if (($suivie->statut == 0)) {
                                                    return '<span style="background-color: #808080; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">REALISER</span>';
                                                } elseif (($suivie->statut == 1)) {
                                                    return '<span style="background-color: #5cb85c; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> VALIDEE </span>';
                                                } elseif (($suivie->statut == 2)&& ($nbr == 1)) {
                                                    return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> AFFECTEE </span>';
                                                } elseif (($suivie->statut == 2) && ($nbr > 1)) {
                                                    return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> A REFAIRE </span>';
                                                }
                                                 else {
                                                    return '';
                                                }
                                            } else {
                                                return '<span style="background-color: #D3D3D3; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> NON AFFECTEE </span>';
                                            }
                                        },
                                    ],

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {
                                                $droit = Utils::have_access('traiterdemande');
                                                //if (($data->statut == 0)) {
                                                $url = 'view_tache?key_tache=' . $data->key_tache;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-info" href="' . $url . '">
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
                                                $suivie = Suivie::find()
                                                ->where(['idtache' => $data->id])
                                                ->one();
                                                if ($data->statut == 2 || $suivie->statut == 2 ) {
                                                    $url = 'update_tache?key_tache=' . $data->key_tache;
                                                    return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-primary btn-xs" href="' . $url . '"><i class="fa fa-edit"></i></a>';
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
    function delete_tache(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cette tache. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_tache";
        let key_element = document.getElementById('keyElement').value;
        if (key_element != '') {
           // alert(key_element)
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