<?php

use backend\controllers\Utils;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\User;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Affectations';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
<div class="affectation-index">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des affectations</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #17a2b8;">
            <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'showOnEmpty' => false,
                'emptyText' => Utils::emptyContent(),
                'itemView' => function ($model, $item, $key, $widgets) {

            ?>
                <div class="row">
                    <div class="col-lg-0"></div>
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-1">

                                        <!-- <button class="button-style" action="/fairetache">
                                            <input type="checkbox" style="background-color: #fff; color: #000; width: 18px; height: 18px; border: none solid #000; padding: none; border-radius: none; cursor: pointer;" class="checkbox form-control" id="agree" name="agree" checked>
                                            <= Html::button('agree', ['class' => 'checkbox form-control', 'style' => 'width: 16px; height: 16px;',]) ?>
                                           <= Html::a('qfgu', ['fairetache'],['style'=>"background-color: #fff; color: #000; width: 18px; height: 18px; border: none solid #000; padding: none; border-radius: none; cursor: pointer;"]) ?>
 
                                        </button> -->
                                        <?php
                                        $suivie = Suivie::find()
                                            ->where(['idtache' => $model->id])
                                            ->orderBy(['created_at' => SORT_DESC])
                                            ->one();



                                        if ($suivie->statut == 0) {
                                        ?> <?= Html::a('<i class="fa fa-check"></i>', ['fairetache', 'key_tache' => $model->key_tache], ['class' => 'button-style']) ?>

                                        <?php  } elseif ($suivie->statut == 1) {
                                            ;
                                        }else {
                                        ?> <?= Html::a('<i class="fa fa-square-o"></i>', ['fairetache', 'key_tache' => $model->key_tache], ['class' => 'button-style']) ?>

                                        <?php } ?>
                                        <!-- <?= Html::a('<i class="glyphicon glyphicon-square-o"></i>', ['fairetache', 'key_tache' => $model->key_tache], ['class' => 'button-style']) ?>
                                            -->
                                    </div>
                                    <?php
                                    // $date_debut = Html::encode($suivie->date_debut);
                                    $date_prob = $suivie->date_prob;
                                    if ($suivie->statut == 0) { ?>
                                        <div class="col-xs-10">
                                            <del>
                                                <?php echo $model->designation ?>
                                                Debut: <?php echo $date_prob ?>
                                                Fin :<?php echo date('d/m/Y H:i', strtotime($suivie->date_prob)); ?>
                                            </del>
                                        </div>
                                    <?php } elseif ($suivie->statut == 1) {
                                    ?>

                                        <div class="col-xs-9">
                                            <del style="text-decoration-color: green;">
                                                <?php echo $model->designation ?>
                                                Debut: <?php echo $date_prob ?>
                                                Fin :<?php echo date('d/m/Y H:i', strtotime($suivie->date_prob)); ?>
                                            </del>
                                        </div>

                                        <div class="col-xs-1">

                                            <span style="background-color: #008000; color: #fff; padding: 6px 12px; font-size: 12px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">VALIDEE</span>
                                        </div>
                                    <?php  } else {
                                    ?>
                                        <div class="col-xs-10">
                                            <?php echo $model->designation ?>
                                            Debut: <?php echo $date_prob ?>
                                            Fin :<?php echo date('d/m/Y H:i', strtotime($suivie->date_prob)); ?>
                                        </div>
                                    <?php
                                    } ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php   }

            ]);

            ?>






        </div>
    </div>
</div>
<!--    <?php foreach ($dataProvider->getModels() as $tache) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-xs-1">
                                        <?= Html::checkbox('agree', $tache->statut != 2, ['class' => 'checkbox form-control', 'style' => 'width: 16px; height: 16px;',]) ?>
                                        </div>
                                        <div class="col-xs-10">
                                            <php
                                            $designation = Html::encode($tache->designation);
                                            if ($tache->statut == 1) {
                                                $designation = '<del>' . $designation . '</del>';
                                                $description = '<del>' . $description . '</del>';
                                            }
                                            echo $designation;
                                            echo '<br>';

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
 -->