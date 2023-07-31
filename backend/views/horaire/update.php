<?php

use frontend\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Horaire */

$this->title = 'Modification de l\'horaire: '.' ' . $model->heure_arrivee . ' ' . $model->heure_depart;
$this->params['breadcrumbs'][] = ['label' => 'Horaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= Alert::widget() ?>

<div class="horaire-update">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item">
                        <a href="/gespers/admin/accueil">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active"> <a href="/gespers/admin/all_horaire">Liste des horaires</a></li>
                    <li class="breadcrumb-item active">Modification d'un horaire
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


                <div class="row mb-2">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                        <div class="task-content">
                            <div class="typeconge-create">
                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-1">
    </div>

</div>