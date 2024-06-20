<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Suivie */

$this->title = 'Update Suivie: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Suivies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="suivie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
