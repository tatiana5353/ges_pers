<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */

$this->title = 'Create Affectation';
$this->params['breadcrumbs'][] = ['label' => 'Affectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affectation-create">
    <div class="panel panel-default">
       
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= Html::encode($this->title) ?>
                </h3>
                
            </div>
            <div class="panel-body">

            <?= $this->render('_form', [
                'affectation' => $affectation,
                'tache' => $tache
            ]) ?>
        </div>
    </div>

</div>