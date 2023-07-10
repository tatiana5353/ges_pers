<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Presence */

$this->title = 'Create Presence';
$this->params['breadcrumbs'][] = ['label' => 'Presences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
