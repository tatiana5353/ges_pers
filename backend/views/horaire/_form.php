<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Horaire $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="horaire-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-8">

            <?= $form->field($model, 'heure_arrivee')->textInput(['type' => 'Time', ['format' => 'HH:mm'], 'required' => true])
            ->label('<spanp class="text-dark">Heure-arrivée</span><span class="text-danger">**</span>') ?>

            <?= $form->field($model, 'heure_depart')->textInput(['type' => 'Time', 'required' => true])
            ->label('<spanp class="text-dark">Heure-départ</span><span class="text-danger">**</span>') ?>
        </div>
        <div class="col-lg-4">

        </div>
    </div>

    

    <!-- <?= $form->field($model, 'key_horaire')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
    <div class="add-task-row mb-2">
                    
                    <div class="form-group">
                        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
                        <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                    </div>
                </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
