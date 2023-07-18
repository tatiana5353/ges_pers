<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilisateurs';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal');
?>
<?= Alert::widget() ?>
<div class="user-index">
    <div class="demande-index">
        <div class="container-fluid">

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
                </div>


                <div class="col-lg-4 p-l-1 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/gespers/admin/accueil">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Liste des demandes</li>
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
                            <?= Html::a('Ajouter un employé', ['create'], ['class' => 'btn btn-info']) ?>
                        </p>

                        <div class="content-panel">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => '{items}{pager}',
                                'showOnEmpty' => false,
                                'emptyText' => Utils::emptyContent(),
                                'tableOptions' => [
                                    'class' => 'table table-hover'
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'id',
                                    [
                                        'label' => 'Nom',
                                        'value' => 'nom'
                                    ],
                                    [
                                        'label' => 'Prenoms',
                                        'value' => 'prenoms'
                                    ],
                                    [
                                        'label' => 'Sexe',
                                        'value' => 'sexe'
                                    ],
                                    [
                                        'label' => 'Date de naissance',
                                        'format' => ['date', 'php:d-m-Y'],
                                        'value' => 'date_naiss',

                                    ],


                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'view' => function ($url, $data) {
                                                $url = 'view_user?auth_key=' . $data->auth_key;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-info btn-xs" href="' . $url . '">
                        <i class=" fa fa-eye"></i>
                        </a>';
                                            },
                                        ],
                                    ],

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'update' => function ($url, $data) {
                                                $url = 'update_user?auth_key=' . $data->auth_key;
                                                return '<a title="' . Yii::t('app', 'Modifier') . '" class="btn btn-success btn-xs" href="' . $url . '">
                        <i class=" fa fa-edit"></i>
                        </a>';
                                            },
                                        ],
                                    ],



                                    //delete
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{delete}',
                                        'headerOptions' => ['width' => '15'],
                                        'buttons' => [
                                            'delete' => function ($url, $data) {
                                               // $url = 'delete_user?auth_key=' . $data->auth_key;
                                                return '<a title="' . Yii::t('app', 'Supprimer') . '" class="btn btn-xs btn-danger" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_user(\'' . $data->auth_key . '\')">
                                                        <i class=" fa fa-trash"></i>
                                                        </a>';
                                            },
                                        ],

                                    ],
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
    function delete_user(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cet Employé. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_user";
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