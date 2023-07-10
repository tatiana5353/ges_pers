<?php

use backend\controllers\Utils;
use frontend\widgets\Alert as WidgetsAlert;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presences';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= WidgetsAlert::widget() ?>
<div class="presence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Presence', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'layout' => '{items}{pager}',
        'showOnEmpty' => false,
        'emptyText' => Utils::emptyContent(),
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-bordered',
            'id' => 'hidden-table-info',
            'cellpadding' => "0",
            'cellspacing' => "0",
            'border' => "0"
        ],
        'columns' => [

            'id',
            'libelle',
            'justification:ntext',
            'heure_arrivee',
            'heure_depart',
            //'key_presence',
            //'statut',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
            //'idhoraire',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>