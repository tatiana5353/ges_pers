<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login mt-3" style=" margin-top: 20px;">
    <!--  <h1><?= Html::encode($this->title) ?></h1>
 -->

    <!-- <div class="login-box" style="margin-top: 75px; height: auto; background: #1A2226; text-align: center; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);">
        <h1 class="login-key" style="height: 100px; font-size: 80px; line-height: 100px; background: -webkit-linear-gradient(#27EF9F, #0DB8DE); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Votre Titre</h1> -->

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username')->textInput([
        'style' => 'background-color: #1A2226; border: none; border-bottom: 2px solid #0DB8DE; border-top: 0px; border-radius: 0px; font-weight: bold; outline: 0; margin-bottom: 20px; padding-left: 0px; color: #ECF0F5;  margin-top: 30px;
        text-align: left;margin-bottom: 40px;
        outline: 0px;', 'placeholder' => 'NOM UTILISATEUR'
    ])->label(false)  ?>
    <?= $form->field($model, 'password')->passwordInput([
        'style' => 'background-color: #1A2226; border: none; border-bottom: 2px solid #0DB8DE; border-top: 0px; border-radius: 0px; font-weight: bold; outline: 0; padding-left: 0px; margin-bottom: 20px; color: #ECF0F5;',
        'placeholder' => 'MOT DE PASSE'
    ])->label(false)  ?>
    <!-- <?= $form->field($model, 'rememberMe')->checkbox() ?> -->
    <div class="row">
        <div class="col-lg-9"></div>
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'border-color: #0DB8DE; color: #0DB8DE; border-radius: 0px; font-weight: bold; letter-spacing: 1px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);']) ?>
            

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>