<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Demande */

$this->title = $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Demandes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('_modal_valider');

//\yii\web\YiiAsset::register($this);
?>
<?= Alert::widget() ?>
<div class="demande-view">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item">
                        <a href="/gespers/admin/accueil">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active"> <a href="/gespers/admin/all_demande">Liste des demandes</a></li>
                    <li class="breadcrumb-item active">Détail
                    </li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- <div class="card">
        <p>
        <div class="row">

            <div class="col-lg-9"> 


            </div> -->
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #17a2b8;">
            <h3 class="panel-title" style="color: #ffffff;"> Détail sur la demande N°:<?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="content-panel">
                <!-- <div class="panel panel-default"> -->
                <!-- <div class="row mt"> -->
                <!-- <div class="col-md-12"> -->
                <!--  <section class="task-panel tasks-widget"> -->

                <!-- // <div class="col-lg-3">
                                <?php $droit_traitement = Utils::have_access('Demande');
                                if ($droit_traitement == 1) { ?>
                                    <?= Html::a('Valider', ['validate', 'key_demande' => $model->key_demande], ['class' => 'btn btn-success ']) ?>
                                <?= Html::a('Supprimer', ['delete', 'key_element' => $model->key_demande], [
                                        'class' => 'btn btn-danger m-b-10 m-l-5',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',

                                        ],
                                    ]) ?>
                                <?php    } ?>
                                    </div>

                                    </div> -->

                <!-- <div class="panel-body"> -->
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' =>
                    [

                        [
                            'attribute' => 'numero',
                            'header' => 'Numéro',
                        ],


                        [
                            'label' => 'Nom du personnel',
                            'value' => function ($data) {
                                return $data->createdBy->nom . ' ' . $data->createdBy->prenoms;
                            }
                        ],



                        [
                            'label' => 'Type de congé',
                            'value' => $model->idtypeconge0->libelle,
                        ],

                        [
                            'attribute' => 'motif',
                            'header' => 'Motif du congé',
                        ],

                        [
                            'attribute' => 'debutconge',
                            'header' => 'Debut de congé',
                        ],
                        [
                            'attribute' => 'finconge',
                            'header' => 'Fin de congé',
                        ],
                        [
                            'attribute' => 'statut',
                            'header' => 'Statut',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $data = $data['statut'];
                                if ($data == '0') {
                                    return 'En attente';
                                } elseif ($data == '1') {
                                    return 'Validée';
                                } elseif ($data == '2') {
                                    return 'Servie';
                                } elseif ($data == '4') {
                                    return 'Rejettée';
                                }
                            },
                        ],
                    ],
                ]) ?>

                <div class="add-task-row">

                    <?php $droit_traitement = Utils::have_access('traiterdemande');
                    $statut = $model->statut;
                    if ($droit_traitement == 1) {
                        if ($statut == 0) {
                    ?>

                            <!-- <= Html::a(
                                        'Valider',
                                        ['validate', 'key_demande' => $model->key_demande],
                                        [
                                            'class' => 'btn btn-info',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'delete' => function ($url, $data) {

                                                    return '<a title="' . Yii::t('app', 'Valider') . '" class="btn mini btn-danger btn-sm" href="#" data-toggle="modal3" data-target="#exampleModal3" onclick="validate_demande(\'' . $data->key_demande . '\')"><i class="fa fa-trash"></i>s</a>';
                                                },
                                            ],
                                        ]
                                            ) ?> -->



                            <!-- <= Html::button('Valider', [
                                                'class' => 'btn mini btn-danger btn-sm',
                                                'data-toggle'=>'modal' ,
                                                'data-target'=>'#exampleModal',
                                                'onclick' => 'validate_demande("' . $model->key_demande . '")',
                                            ]) ?> -->

                            <?php
                            //echo Html::a('<i class="icon fas fa-check">Validé</i>', ['valider', 'key' => $model->key_demande], ['onclick'=>'valider_demande(\'' . $data->key_demande . '\')', 'class' => 'btn btn-info btn-sm']);
                            /* echo Html::a('<i class="icon fas fa-check">Validé</i>', ['valider', 'key' => $model->key_demande],
                                            ['onclick'=>'valider_demande(\'' . $model->key_demande . '\')', 'class' => 'btn btn-info btn-sm']); */
                            /* echo Html::a(
                                                '<i class="icon fas fa-check">Validé</i>',
                                                '#',
                                                ['onclick' => 'valider_demande(\'' . $model->key_demande . '\')', 'class' => 'btn btn-info btn-sm']
                                            ); */
                            echo '<button type="button" onclick="valider_demande(\'' . $model->key_demande . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="icon fas fa-check"></i> Validé</button>';

                            ?>


                            <?= Html::a('Refuser', ['refus', 'key_demande' => $model->key_demande], ['class' => 'btn btn-danger m-b-10 m-l-5']) ?>
                        <?php    } ?>

                    <?php  } ?>
                </div>
                <!--  </div> -->
                <!-- </section> -->
                <!-- </div> -->
                <!-- /col-md-12-->
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<script>
    function valider_demande(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de validation';
        document.getElementById('modalContent').innerHTML =
            'Vous êtes sur le point de valider cette demande. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function valider_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>valider_demande";
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