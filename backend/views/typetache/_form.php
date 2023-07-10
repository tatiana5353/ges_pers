<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Typetache */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="typetache-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Libelle<span class="text-danger">**</span></h5>

') ?>

<div class="add-task-row mb-2">
                
                <div class="form-group">
                    <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
                    <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                </div>
            </div>

<?php ActiveForm::end(); ?>

</div>
