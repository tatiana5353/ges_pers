<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */

$this->title = 'Create Affectation';
$this->params['breadcrumbs'][] = ['label' => 'Affectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affectation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'affectation' => $affectation,
        'user' => $user,
        'tache' => $tache
    ]) ?>

</div>
