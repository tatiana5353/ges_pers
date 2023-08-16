<?php

use backend\controllers\Utils;
use backend\models\Affectation;
use backend\models\Suivie;
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
                <button id="btnQuitter"><i class=" fa fa-arrow-left"></i></button>

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
        <div class="panel-heading" style="background-color: #17a2b8;">
            <h3 class="panel-title" style="color: #ffffff;">    Détail sur la tache : <h7><?= Html::encode($this->title) ?></h7></h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="row mt">
                    <div class="col-md-12">
                        <section class="task-panel tasks-widget">
                           <!--  <div class="panel-heading">
                                <div class=" btn-lg waves-effect waves-light bg-info" data-class="bg-primary">

                                    Détail sur la tache :<h7><?= Html::encode($this->title) ?></h7>

                                </div>
                            </div> -->

                            </p>
                            <div class="panel-body">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [

                                        [
                                            'label' => 'Projet',
                                            'value' => function ($data) {
                                                return $data->idprojet0->libelle ?? '';
                                            }
                                        ],

                                        [
                                            'attribute' => 'statut',
                                            'header' => 'Statut',
                                            /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                                            'format' => 'raw',
                                            'label' => 'Statut de la tâche',
                                            'value' =>  function ($data) {
                                                $suivie = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->orderBy(['created_at' => SORT_DESC])
                                                    ->one();
                                                    $nbr = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->count();
                                                if ($data->statut !== 2) {
                                                    if (($suivie->statut == 0)) {
                                                        return '<span style="background-color: #808080; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;">REALISER</span>';
                                                    } elseif (($suivie->statut == 1)) {
                                                        return '<span style="background-color: #5cb85c; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> VALIDEE </span>';
                                                    } elseif (($suivie->statut == 2)&& ($nbr == 1)) {
                                                        return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> AFFECTEE </span>';
                                                    } elseif (($suivie->statut == 2) && ($nbr > 1)) {
                                                        return '<span style="background-color: #f0ad4e; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> A REFAIRE </span>';
                                                    }
                                                     else {
                                                        return '';
                                                    }
                                                } else {
                                                    return '<span style="background-color: #D3D3D3; color: #fff; padding: 5px 10px; font-size: 10px; font-weight: bold; border: none; border-radius: 0; display: inline-block; line-height: 1;"> NON AFFECTEE </span>';
                                                }
                                            },
                                        ],
                                        [
                                            'label' => 'Type de tâche',
                                            'value' => function ($data) {
                                                return $data->idtypetache0->libelle;
                                            }
                                        ],
                                        [
                                            'label' => 'designation de la tâche',
                                            'attribute' => 'designation'
                                        ],

                                        // 'description:ntext',
                                        [
                                            'label' => 'Description de la tâche ',
                                            'value' => function ($data) {
                                                $suivie = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->orderBy(['created_at' => SORT_DESC])
                                                    ->one();
                                                
                                                return $suivie->commentaire_assigant ?? 'Non assignée';
                                            }
                                        ],
                                        [

                                            'label' => 'Responsable',
                                            'value' =>
        
                                            function ($data) {
                                                $affectation = Affectation::find()
                                                    ->where(['id' => $data->idaffectation])
                                                    ->one();
                                                    if ($affectation != null) {
                                                        return $affectation->iduser0->nom . ' ' . $affectation->iduser0->prenoms ?? '';
        
                                                    }else {
                                                        return 'Pas défini';
        
                                                    }
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
    </div>
</div>