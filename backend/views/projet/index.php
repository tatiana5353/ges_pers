<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\bootstrap\Alert as BootstrapAlert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projets';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget();
echo $this->render('_modal');
?>
<div class="projet-index">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des projets</li>
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
                <div class="typeconge-index">


                    <div class="row">

                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <p>
                                <?= Html::a('Créer un projet', ['create'], ['class' => 'btn btn-info']) ?>
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
                                        'border' => "0"
                                    ],
                                    'columns' => [

                                        [
                                            'label' => 'Libellé',
                                            'value' => 'libelle'
                                        ],

                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '10'],
                                            'buttons' => [
                                                'view' => function ($url, $data) {
                                                    $url = 'view_projet?key_projet=' . $data->key_projet;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-success btn-sm" href="' . $url . '">
                                            <i class=" fa fa-eye"></i>
                                            </a>';
                                                },
                                            ],
                                        ],

                                       /*  [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            //'visible' => $droits[3] == 1 ? true : false,
                                            'buttons' => [
                                                'update' => function ($url, $data) {
                                                    //$url = 'index.php?r=typeconge/update&key_typeconge=' . $data->key_typeconge;
                                                    $url = 'update_projet?key_projet=' . $data->key_projet;
                                                    return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-sm" href="' . $url . '"><i class="fa fa-edit"></i></a>';
                                                },
                                            ],
                                        ], */

                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'delete' => function ($url, $data) {
                                                    return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-sm" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_projet(\'' . $data->key_projet . '\')">
                                    <i class="fa fa-trash"></i>
                                            </a>';
                                                },
                                            ],
                                        ]
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function delete_projet(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer ce projet. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_projet";
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