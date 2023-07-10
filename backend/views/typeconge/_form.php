<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Typeconge $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="typeconge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Libelle<span class="text-danger">**</span></h5>

') ?>

    <!-- <?= $form->field($model, 'key_typeconge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

                <div class="add-task-row mb-2">
                    
                    <div class="form-group">
                        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
                        <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                    </div>
                </div>
    <?php ActiveForm::end(); ?>

</div>
