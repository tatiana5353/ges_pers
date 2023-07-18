<?php

use backend\models\Tache;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="affectation-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($affectation, 'iduser')->dropDownList(
            ArrayHelper::map(
                User::find()->where(['status' => 10])->all(),
                'id',
                'nom',
            ),
            ['prompt' => 'Choisir un employé'],
            ['class' => 'form-control']
        )->error(false)->label('<h5>Employé<span class="text-danger">**</span></h5>');
        ?>
    <div class="row">
        <div class="col-lg-6">

            <?= $form->field($tache, 'designation')->dropDownList(
                ArrayHelper::map(
                    Tache::find()->where(['statut' => 0])->all(),
                    'id',
                    'designation',
                    function ($data) {
                        return $data->idprojet0->libelle;
                    }
                ),
                ['prompt' => 'Choisir une tache'],
                ['class' => 'form-control']
            )->error(false)->label('<h5>Tache:<span class="text-danger">**</span></h5>');
            ?>

            <?= $form->field($tache, 'description')->textInput()->label('<h5>Description<span class="text-danger">**</span></h5>') ?>


            </div>

            <div class="col-lg-6">
                <?= $form->field($tache, 'heure_debut')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Date-debut<span class="text-danger">**</span></h5>') ?>

                <?= $form->field($tache, 'heure_fin')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Date-limite<span class="text-danger">**</span></h5>') ?>

            </div>
            </div>
            <table class="table" id="tab_temp_preview">
                <thead>
                    <tr>
                        <th scope="col">Tache</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date-debut</th>
                        <th scope="col">Date-limite</th>
                    </tr>
                </thead>
                <tbody id="rows">

                </tbody>
            </table>

        

    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>