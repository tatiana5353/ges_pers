<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;?>
<div class="typeconge-form">

   

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'commentaire_effectuant')->textarea(['rows' => 4,'required' => true, ])->label('<span class="text-dark">Motif</span><span class="text-danger">**</span>')

    ?>

    <div class="add-task-row mb-2">

        <div class="form-group">
            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary m-b-10 m-l-5  ']) ?></button>
            <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>