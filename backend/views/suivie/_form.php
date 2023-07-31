<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suivie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suivie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_debut')->textInput() ?>

    <?= $form->field($model, 'date_fin')->textInput() ?>

    <?= $form->field($model, 'date_prob')->textInput() ?>

    <?= $form->field($model, 'commentaire_assigant')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'commentaire_effectuant')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
