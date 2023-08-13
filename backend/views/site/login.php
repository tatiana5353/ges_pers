<?php

use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<body class="bg-">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6" style=" justify-content: center; align-items: center; height: 100vh;">
                    
                <div class="login-content">
                        <div class="login-form">
                            <?= Alert::widget() ?>
                            <h4>Connexion</h4>
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <?= $form->field($model, 'username')->textInput(['class' => 'form-control  amount', 'required' => true,])->label('Nom d\'utilisateur') ?>


                            <!--  <= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nom d\'utilisateur') ?> ?> -->
                            <!--   <= $form->field($model, 'password')->passwordInput()->label('Mot de passe') ?> -->
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control  amount', 'required' => true,])->label('Mot de passe') ?>
                            <div class="form-group">
                                <?= Html::submitButton('se connecter', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>