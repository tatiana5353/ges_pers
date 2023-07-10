<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Presence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'justification')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'heure_arrivee')->textInput() ?>

    <?= $form->field($model, 'heure_depart')->textInput() ?>

    <?= $form->field($model, 'key_presence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'idhoraire')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
