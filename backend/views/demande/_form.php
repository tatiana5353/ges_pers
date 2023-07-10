<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Demande */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demande-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-8">

            <?= $form->field($model, 'idtypeconge')->dropdownlist(
                ArrayHelper::map($typeconge, 'id', 'libelle'),
                ['prompt' => 'choisir un type de congé', 'required' => true],
                ['class' => 'ui search dropdown']
            )->error(false)->label('<span class="text-dark">Type de congé</span><span class="text-danger">**</span>') ?>

            <?= $form->field($model, 'debutconge')->textInput(['type' => 'datetime-local', 'required' => true]) ?>

            <?= $form->field($model, 'finconge')->textInput(['type' => 'datetime-local', 'required' => true]) ?>

        </div>
        <div class="col-lg-4">
        </div>
    </div>
    
    <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model, 'motif')->textarea(['rows' => 4,'required' => true, ]) ?>
            </div>
        </div>
    </div>



    <!-- <?= $form->field($model, 'motif_refus')->textarea(['rows' => 4]) ?> -->
    <!--  <?= $form->field($model, 'created_by')->textInput() ?> -->



    <div class="form-group">
        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
        <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
    </div>

    <?php ActiveForm::end(); ?>

</div>