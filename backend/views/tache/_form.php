<?php

use backend\models\TypeTache;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */
/* @var $form yii\widgets\ActiveForm */

/* $typetache = TypeTache::find()
    ->where(['statut' => 1])
    ->all(); */
?>

<div class="tache-form">

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

                            </div>
                            <div class="col-lg-6">

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

</div>