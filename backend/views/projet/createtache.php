<?php

use backend\models\Tache;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'AJouter une tache';
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$tache = new Tache();
?>
<?= Alert::widget() ?>
<div class="demande-form">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item">
                        <a href="/gespers/admin/accueil">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active"> <a href="/gespers/admin/all_horaire">Liste des horaires</a></li>
                    <li class="breadcrumb-item active">Création d'un horaire
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
                <div class="task-content">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($model, 'idtypetache')->dropdownlist(
                                        ArrayHelper::map($typetache, 'id', 'libelle'),
                                        ['prompt' => 'choisir un type de tache', 'required' => true],
                                        ['class' => 'ui search dropdown']
                                    )->error(false)->label('<h5>Type de tache<span class="text-danger">**</span></h5>') ?>

                                    <?= $form->field($model, 'designation')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Désignation<span class="text-danger">**</span></h5>') ?>

                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-task-row">
                        <div class="form-group">
                            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-info m-b-10 m-l-5  ']) ?></button>
                            <?= Html::resetButton(' Annuler ', ['class' => 'btn btn-default m-b-10 m-l-7 ']) ?></button>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>