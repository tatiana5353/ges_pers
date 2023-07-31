<?php

use backend\controllers\TypetacheController;
use backend\controllers\Utils;
use backend\models\TypeTache;
use frontend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Projet */

$this->title = 'Projet:' . ' ' . $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= Alert::widget();
echo $this->render('_modal');
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
                                                return '<span style="background-color: #337ab7; color: #fff; padding: 6px 12px; font-size: 12px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">EN COURS</span>';
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
                        <div class="panel-heading" style="background-color: #17a2b8;">
                            <h3 class="panel-title">
                                Les taches du projet<!--    <?= Html::encode($this->title) ?> -->
                            </h3>
                        </div>
                        <div class="panel-body">
                            <p> <?php echo Html::a('<i class="glyphicon glyphicon-plus"></i>', ['creates', 'key_projet' => $model->key_projet], ['class' => 'btn btn-primary ']); ?> </p>

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