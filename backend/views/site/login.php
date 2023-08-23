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

    <div id="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center" style="height: 100vh;">
                    <div class="login-content">
                        <div class="login-form">
                            <?= Alert::widget() ?>
                            <h4 class="text-center">Connexion</h4>
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <?= $form->field($model, 'username')->textInput(['class' => 'form-control amount', 'required' => true])->label('Nom d\'utilisateur') ?>
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control amount', 'required' => true])->label('Mot de passe') ?>
                            <div class="form-group text-center">
                                <?= Html::submitButton('Se connecter', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>

</body>
