<?php

use backend\controllers\Utils;
use backend\models\Affectation;
use backend\models\Suivie;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tache */

$this->title = $model->designation;
$this->params['breadcrumbs'][] = ['label' => 'Taches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
echo $this->render('_modal_valider');
echo $this->render('_modal_refus');

//\yii\web\YiiAsset::register($this);
//vue de l'administrateur
?>
<?= Alert::widget() ?>


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
            <h3 class="panel-title" style="color: #ffffff;"> Détail sur la tache : <h7><?= Html::encode($this->title) ?></h7>
            </h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="row mt">
                    <div class="col-md-12">
                        <section class="task-panel tasks-widget">

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

                                            'label' => 'Responsable',
                                            'value' =>

                                            function ($data) {
                                                $affectation = Affectation::find()
                                                    ->where(['id' => $data->idaffectation])
                                                    ->one();
                                                if ($affectation != null) {
                                                    return $affectation->iduser0->nom . ' ' . $affectation->iduser0->prenoms ?? '';
                                                }/* else {
                                                return $data->iduser0->nom . ' ' . $affectation->iduser0->prenoms ?? '';

                                            } */
                                            }

                                        ],

                                        [
                                            'label' => 'Type de tache',
                                            'value' => function ($data) {
                                                return $data->idtypetache0->libelle;
                                            }
                                        ],
                                        'designation',
                                        // 'description:ntext',
                                        [
                                            'label' => 'Description de la tache ',
                                            'value' => function ($data) {
                                                $suivie = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->orderBy(['created_at' => SORT_DESC])
                                                    ->one();

                                                return $suivie->commentaire_assigant ?? '';
                                            }
                                        ],
                                        [
                                            'label' => 'Description de la realisation',
                                            'value' => function ($data) {
                                                $suivie = Suivie::find()
                                                    ->where(['idtache' => $data->id])
                                                    ->orderBy(['created_at' => SORT_DESC])
                                                    ->one();

                                                return $suivie->commentaire_effectuant ?? '';
                                            }
                                        ],

                                    ],
                                ])
                                ?>

                                <div class="add-task-row">

                                    <?php
                                    $suivie = Suivie::find()
                                        ->where([
                                            'idtache' => $model->id,

                                        ])->orderBy(['created_at' => SORT_DESC])->one();
                                    /*  ->andwhere(['not in', 'statut', 2]) */

                                    /* $droit_traitement = Utils::have_access('traiterdemande');
                                    $statut = $model->statut; */
                                    if ($suivie->statut == 0) {

                                    ?>
                                        <?php

                                        echo '<button type="button" onclick="valider_tache(\'' . $model->key_tache . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="icon fa fa-thumbs-up"></i> Validé</button>';

                                        ?>
                                        <?php

                                        echo '<button type="button" onclick="refus_tache(\'' . $model->id . '\')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#refusModal"><i class="fa fa-thumbs-down"></i> Refuser</button>';

                                        ?>


                                        <!--                             <?= Html::a('Refuser', ['refus', 'key_tache' => $model->key_tache], ['class' => 'btn btn-danger m-b-10 m-l-5']) ?>
 --> <?php    } ?>

                                    <?php   ?>
                                </div>
                            </div>
                    </div>
                </div>
                </section>
            </div>
            <!-- /col-md-12-->
        </div>
    </div>
</div>
<script>
    function valider_tache(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de validation';
        document.getElementById('modalContent').innerHTML =
            'Vous êtes sur le point de valider cette tache. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function valider_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>valider_tache";
        let key_element = document.getElementById('keyElement').value;
        if (key_element != '') {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    key_element: key_element
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        }
    }

    function refus_tache(id_tache) {
        document.getElementById('refusTitle').innerHTML = 'Confirmation de Rejet';

        document.getElementById('keyRefus').value = id_tache;
    }

    function refuser_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>refus_tache";
        let key_element = document.getElementById('keyRefus').value;
        let commentaire = document.getElementById('refusCommentaire').value;
        let datedebut = document.getElementById('suivieDebut').value;
        let dateprob = document.getElementById('suivieProb').value;
        //alert(key_element+'g'+dateprob+'r'+commentaire);
        if (key_element != '') {

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    key_element: key_element,
                    commentaire: commentaire,
                    datedebut: datedebut,
                    dateprob: dateprob
                },
                success: function(result) {
                    document.location.reload();
                }
            });
            // alert(key_element+'g'+datedebut+'r'+commentaire+dateprob);
        }
    }
</script>