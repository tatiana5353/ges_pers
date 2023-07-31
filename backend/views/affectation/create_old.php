<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */

$this->title = 'Create Affectation';
$this->params['breadcrumbs'][] = ['label' => 'Affectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affectation-create">
    <div id="alert_place_g">
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item">
                        <a href="/gespers/admin/accueil">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active"> <a href="/gespers/admin/all_affectation">Liste des affectations</a></li>
                    <li class="breadcrumb-item active">Affectations
                    </li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #17a2b8;">
            <h3 class="panel-title" style="color: #ffffff;"> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <div class="content-panel">
                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-10">
                        <div class="typeconge-create">
                            <!-- <div class="task-content"> -->
                            <?= $this->render('_form', [
                                'affectation' => $affectation,
                                'tache' => $tache
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>