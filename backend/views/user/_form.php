<?php

use backend\controllers\Utils;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
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

                                <?= $form->field($model, 'nom')->textInput([
                                    'maxlength' => true, 'required' => true, 'style' => 'text-transform:uppercase'

                                ])->label('Nom<span class="text-danger">**</span>') ?>
                                <?= $form->field($model, 'prenoms')->textInput(['maxlength' => true, 'required' => true])->label('Prenoms<span class="text-danger">**</span>') ?>

                                <?= $form->field($model, 'date_naiss')->textInput(['required' => true, 'type' => 'date'])->label('Date de naissance<span class="text-danger">**</span>') ?>

                                <?= $form->field($model, 'sexe')->dropdownList(
                                    Utils::sexe(),
                                    ['prompt' =>  'Sexe', 'onchange' => '', 'required' => true],
                                    ['class' => 'form-control']
                                )->error(false)->label('<span class="text-dark">Sexe</span><span class="text-danger">**</span>') ?>

                                <?= $form->field($model, 'idprofil')->dropdownlist(
                                    ArrayHelper::map($profil, 'id', 'libelle'),
                                    ['prompt' => 'choisir un profil', 'required' => true,]
                                )->error(false)->label('profil<span class="text-danger">**</span>') ?>


                            </div>
                            <div class="col-lg-6">

                                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email'])->label('Email<span class="text-danger">**</span>') ?>


                                <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Username<span class="text-danger">**</span>') ?>




                                <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'required' => true, 'type' => 'password'])->label('Mot de passe:<span class="text-danger">**</span></h5>') ?>
                                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label('Telephone<span class="text-danger">**</span>') ?>



                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>


                    </div>
                    <div class="add-task-row">
                        <div class="form-group text-center">
                            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-info m-b-10 m-l-5  ']) ?></button>
                            <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>
        </div>
    </div>





    <!--     <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
 -->
    <!--  <?= $form->field($model, 'role')->textInput() ?> -->

    <!--     <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
 -->
    <!--     <?= $form->field($model, 'status')->textInput() ?>
 -->
    <!--     <?= $form->field($model, 'created_by')->textInput() ?>
 -->
    <!--     <?= $form->field($model, 'updated_by')->textInput() ?>
 -->
    <!--     <?= $form->field($model, 'created_at')->textInput() ?>
 -->
    <!--     <?= $form->field($model, 'updated_at')->textInput() ?>
 -->