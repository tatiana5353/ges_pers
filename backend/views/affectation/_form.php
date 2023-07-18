<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="affectation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key_affectation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'iduser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
