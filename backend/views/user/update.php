<?php

use frontend\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="user-update">

    <div class="user-create">


        <div class="row">
            <div class="col-lg-7 p-r-1 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <div class="btn-lg btn-info waves-light " data-class="bg-info">
                            <marquee behavior="alternate" direction="">
                                <?= Html::encode($this->title) ?>
                            </marquee>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 p-l-1 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/gespers/admin/accueil">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active"> <a href="/gespers/admin/all_tache">Listes des taches</a></li>
                            <li class="breadcrumb-item active">Créer une tache
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-panel">


            <div class="row mb-2">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">

                    <div class="task-content">
                        <div class="typeconge-create">
                            <?= $this->render('_form', [
                                'model' => $model,
                                'profil' => $profil,
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-1">
        </div>

    </div>

</div>