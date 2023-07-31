<?php

use backend\controllers\Utils;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */

$this->title = $model->designation;
$this->params['breadcrumbs'][] = ['label' => 'Taches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="tache-view">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-right" style="float: right;">
                    <li class="breadcrumb-item"><a href="accueil">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/gespers/admin/all_tache"> Liste des taches</a></li>
                    <li class="breadcrumb-item active">Détail</li>
                </ol>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Inclure la bibliothèque jQuery si ce n'est pas déjà fait -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<button id="btnQuitter">Quitter</button>

<!-- Le script JavaScript pour gérer le clic sur le bouton "Quitter" -->
<script>
    $(document).ready(function() {
        // Ajouter un gestionnaire d'événement au clic sur le bouton
        $("#btnQuitter").on("click", function() {
            // Utiliser la fonction history.back() pour revenir à la page précédente
            history.back();
        });
    });
</script>

    <div class="panel panel-default">
        <div class="row mt">
            <div class="col-md-12">
                <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                        <div class=" btn-lg waves-effect waves-light bg-info" data-class="bg-primary">
                            <marquee behavior="alternate" direction="">
                                Détail sur la tache :<h7><?= Html::encode($this->title) ?></h7>
                            </marquee>
                        </div>
                    </div>

                    </p>
                    <div class="panel-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'label' => 'Type de tache',
                                    'value' => function ($data) {
                                        return $data->idtypetache0->libelle;
                                    }
                                ],
                                'designation',
                                'description:ntext',
                                [
                                    'label' => 'Projet',
                                    'value' => function ($data) {
                                        return $data->idprojet0->libelle ?? '';
                                    }
                                ],

                            ],
                        ])
                        ?>

                        <div class="add-task-row">
                        </div>
                    </div>
                </section>
            </div>
            <!-- /col-md-12-->
        </div>
    </div>
</div>