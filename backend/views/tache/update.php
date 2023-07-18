<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */

$this->title = 'Update Tache: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Taches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tache-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
