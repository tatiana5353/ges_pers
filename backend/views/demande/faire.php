<?php

use backend\controllers\Utils;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DemandeDepense */
/* @var $form yii\widgets\ActiveForm */

$currentDate = date('Y-m-d H:i');
?>
<?= Alert::widget() ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <ol class="breadcrumb float-right" style="float: right;">
                <li class="breadcrumb-item">
                    <a href="/gespers/admin/accueil">Accueil</a>
                </li>
                <li class="breadcrumb-item active"> <a href="/gespers/admin/all_demande">Liste des demandes</a></li>
                <li class="breadcrumb-item active">Création d'une demande
                </li>
            </ol>

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #17a2b8;">
        <h3 class="panel-title" style="color: #ffffff;"> Faire une demande d'absence à un employé</h3>
    </div>
    <div class="panel-body">

        <div class="content-panel">

            <div class="row mb-2">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">

                    <div class="task-content">


                        <?php $form = ActiveForm::begin(); ?>


                        <?= $form->field($model, 'iduser')->dropdownlist(
                            ArrayHelper::map($user, 'id', 'nom'),
                            ['prompt' => ' choisir le personnel', 'required' => true]
                        )->error(false)->label('<h5>personnel<span class="text-danger"></span></h5>') ?>

                        <?= $form->field($model, 'idtypeconge')->dropdownlist(
                            ArrayHelper::map($typeconge, 'id', 'libelle'),
                            ['prompt' => 'choisir un type d\'absence', 'required' => true],
                            ['class' => 'ui search dropdown']
                        )->error(false)->label('<span class="text-dark">Type d\'absence</span><span class="text-danger">**</span>') ?>

                        <?= $form->field($model, 'debutconge')->textInput(['type' => 'datetime-local', 'required' => true, 'min' => $currentDate])->label('<span class="text-dark">Debut-Absence</span><span class="text-danger">**</span>') ?>

                        <?= $form->field($model, 'finconge')->textInput(['type' => 'datetime-local', 'required' => true, 'min' => $currentDate])->label('<span class="text-dark">Fin-Absence</span><span class="text-danger">**</span>') ?>

                        <?= $form->field($model, 'motif')->textarea(['rows' => 4, 'required' => true,])->label('<span class="text-dark">Motif</span><span class="text-danger">**</span>') ?>


                        <div class="form-group">
                            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
                            <?= Html::resetButton('Annuler', ['class' => 'btn btn-default']) ?>
                        </div>

                        <?php $form = ActiveForm::end(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>