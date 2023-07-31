<?php

use frontend\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Demande */

$this->title = 'refus de la demande N° : '.' ' . $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Demandes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= Alert::widget() ?>


<div class="demande-create">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item">
                        <a href="/gespers/admin/accueil">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active"> <a href="/gespers/admin/all_demande">Liste des demandes de congés</a></li>
                    <li class="breadcrumb-item active">Création d'une demande de congés
                    </li>
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


                <div class="row mb-2">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="task-content">

                            <div class="demande-refus">

                                <div class="demande-form">

                                    <?php $form = ActiveForm::begin(); ?>

                                    <div class="row">
                                        <div class="col-lg-8">

                                            <?= $form->field($model, 'idtypeconge')->dropdownlist(
                                                ArrayHelper::map($typeconge, 'id', 'libelle'),
                                                ['prompt' => 'choisir un type de congé', 'required' => true, 'disabled' => true,],
                                                ['class' => 'ui search dropdown']
                                            )->error(false)->label('<span class="text-dark">Type de congé</span><span class="text-danger"></span>') ?>

                                            <?= $form->field($model, 'debutconge')->textInput(['type' => 'datetime-local', 'disabled' => true, 'required' => true])->label('<span class="text-dark">Début de congé</span><span class="text-danger"></span>') ?>

                                            <?= $form->field($model, 'finconge')->textInput(['type' => 'datetime-local', 'disabled' => true, 'required' => true])->label('<span class="text-dark">Fin de congé</span><span class="text-danger"></span>') ?>

                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?= $form->field($model, 'motif')->textarea(['rows' => 4, 'required' => true, 'disabled' => true,])->label('<span class="text-dark">Motif du congé</span><span class="text-danger"></span>') ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?= $form->field($model, 'motif_refus')->textarea(['rows' => 4, 'required' => true,])->label('<span class="text-dark">Motif du refus</span><span class="text-danger">**</span>') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="add-task-row">
                                <div class="form-group">
                                    <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-info m-b-10 m-l-5  ']) ?></button>
                                    <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-sm-1">
</div>