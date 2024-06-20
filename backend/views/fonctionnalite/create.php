<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fonctionnalite */

$this->title = 'Create Fonctionnalite';
$this->params['breadcrumbs'][] = ['label' => 'Fonctionnalites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fonctionnalite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
