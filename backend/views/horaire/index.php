<?php

use app\models\Horaire;
use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Horaires';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal');
?>

<?= Alert::widget() ?>

<div class="horaire-index">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des horaires</li>
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
                <div class="horaire-index">


                    <div class="row">

                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <p>
                                <?= Html::a('Ajouter un horaire', ['create'], ['class' => 'btn btn-info']) ?>
                            </p>
                            <div class="content-panel">
                                <?= GridView::widget([
                                    'layout' => '{items}{pager}',
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'dataProvider' => $dataProvider,
                                    'tableOptions' => [
                                        'class' => 'table table-bordered',
                                        //'id' => 'hidden-table-info',
                                        'cellpadding' => "0",
                                        'cellspacing' => "0",
                                        'border' => "0",
                                        //'class' ="adv-table"
                                    ],
                                    'columns' => [

                                        [
                                            'label' => 'Heure d\'arrivee',
                                            'format' => ['time', 'H:i'],
                                            'value' => 'heure_arrivee'
                                        ],
                                        [
                                            'label' => 'Heure de départ',
                                            'format' => ['time', 'php:H:i'],
                                            'value' => 'heure_depart'
                                        ],

                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'delete' => function ($url, $data) {

                                                    if ($data->statut == 1) {
                                                        $url = 'off_horaire?key_horaire=' . $data->key_horaire;
                                                        return '<a title="' . Yii::t('app', 'Desactiver') . '"  href="' . $url . '">'
                                                            . '<div class="col-xs-10 col-xs-9">
                                                    <input type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" checked>
                                                  </div>
                                                  </a>';
                                                    } elseif ($data->statut == 2) {
                                                        $url = 'on_horaire?key_horaire=' . $data->key_horaire;
                                                        return '<a title="' . Yii::t('app', 'activer') . '"  href="' . $url . '" >'
                                                            . '<div class="col-xs-10 col-xs-9">
                                                    <input type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree">
                                                  </div></a>';
                                                    } else {
                                                        return null;
                                                    }
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
                                                    // $url = 'index.php?r=horaire/update&key_horaire=' . $data->key_horaire;
                                                    $url = 'horaire/update?key_horaire=' . $data->key_horaire;
                                                    return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-info btn-sm" href="' . $url . '"><i class="fa fa-pencil"></i></a>';
                                                },
                                            ],
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'delete' => function ($url, $data) {
                                                    return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn mini btn-danger btn-sm" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_horaire(\'' . $data->key_horaire . '\')">
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
</div>


<script>
    function delete_horaire(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer ce partenaire. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_horaire";
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