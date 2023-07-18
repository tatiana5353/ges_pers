<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tache-form">

    <!-- <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtypetache')->textInput() ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heure_debut')->textInput() ?>

    <?= $form->field($model, 'idprojet')->textInput() ?>

    <?= $form->field($model, 'idaffectation')->textInput() ?>

    <?= $form->field($model, 'heure_fin')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?> -->

</div>

<div class="row mb-2">
    <div class="col-sm-0">
    </div>
    <div class="col-sm-12">

        <div class="task-content">

            <div class="demande-refus">

                <div class="demande-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row">
                        <div class="col-lg-6">

                            <?= $form->field($model, 'idtypetache')->dropdownlist(
                                ArrayHelper::map($typetache, 'id', 'libelle'),
                                ['prompt' => 'choisir un type de tache', 'required' => true],
                                ['class' => 'ui search dropdown']
                            )->error(false)->label('<h5>Type de tache<span class="text-danger">**</span></h5>') ?>

                            <?= $form->field($model, 'designation')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Désignation<span class="text-danger">**</span></h5>') ?>

                            <!--  <?= $form->field($model, 'heure_debut')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Heure-Début<span class="text-danger">**</span></h5>') ?> -->

                        </div>
                        <div class="col-lg-6">
                            <!--  <?= $form->field($model, 'idprojet')->dropdownlist(
                                        ArrayHelper::map($projet, 'id', 'libelle'),
                                        ['prompt' => 'choisir un projet',],
                                        ['class' => 'ui search dropdown']
                                    )->error(false)->label('<h5>Projet<span class="text-danger"></span></h5>') ?>

                            <?= $form->field($model, 'idaffectation')->dropdownlist(
                                ArrayHelper::map($affectation, 'id', 'id'),
                                ['prompt' => 'choisir une affectation',],
                                ['class' => 'ui search dropdown']
                            )->error(false)->label('<h5>Affectation<span class="text-danger"></span></h5>') ?> -->

                            <!--  <?= $form->field($model, 'heure_fin')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Heure-Fin<span class="text-danger">**</span></h5>') ?> </div> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <?= $form->field($model, 'idprojet')->textInput() ?>

                        <?= $form->field($model, 'idaffectation')->textInput() ?>

                        <?= $form->field($model, 'heure_fin')->textInput() ?> </div> -->
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $form->field($model, 'description')->textarea(['rows' => 4])->label('<h5>Description<span class="text-danger"></span></h5>') ?>
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