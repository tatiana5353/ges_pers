<?php

use backend\controllers\Utils;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\User;
use frontend\widgets\Alert;
use phpDocumentor\Reflection\Element;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'NOMS DES PERSONNES A QUI LES TACHES SONT ASSIGNEES';
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
            <div class="content-panel">


                <p><?= Html::a('Faire une affectation', ['create'], ['class' => 'btn btn-info']) ?></p>
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
                        'border' => "0",
                        //'class' ="adv-table"
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['width' => '15'],
                            'header' => 'N°'
                        ],


                        [
                            'headerOptions' => ['width' => '30'],
                            'label' => 'Numéro',
                            'value' => 'numero'
                        ],

                      
                        [
                            'label' => 'Employé',
                            'value' => function ($data) {
                                return $data->iduser0->nom.' '.$data->iduser0->prenoms ;
                            }
                        ],

                        [
                            'label' => 'Date de l\'affectation',
                            'value' => function ($data) {
                                return date('d-m-Y H:i', strtotime($data->created_at));
                            }
                        ],
                        [
                            'attribute' => 'statut',
                            'header' => 'Statut',
                            /*  'filter' => ['Y'=>'Active', 'N'=>'Deactive'], */
                            'format' => 'raw',
                            'value' => function ($affectations) {
                                $taches = Tache::find()
                                ->where(['idaffectation' => $affectations->id])
                                ->andwhere(['not in','statut',3])->all();
                            
                              
                                    
                                    $hasRealized = false;
                                    $allValidated = true;
                                    
                                    foreach ($taches as $tache) {
                                        $suivie = Suivie::find()->where(['idtache' => $tache->id])->one();
                                        
                                        if ($suivie) {
                                            if ($suivie->statut == 2) {
                                                $affectationStatus = '<span class="label label-primary">EN ATTENTE</span>';
                                                $allValidated = false;
                                            } elseif ($suivie->statut == 0) {
                                                $hasRealized = true;
                                                $allValidated = false;
                                            } elseif ($suivie->statut == 1) {
                                                $hasRealized = true;
                                            }
                                        }
                                    }
                                    
                                    if ($allValidated) {
                                        $affectationStatus = '<span class="label label-succes">VALIDEE</span>';
                                    } elseif ($hasRealized) {
                                        $affectationStatus = '<span class="label label-info">EN REALISATION</span>';
                                    }
                                    
                                    // Afficher le statut de l'affectation dans la ligne de la liste
                                    return $affectationStatus;
                                
                                
                            
                            }
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'headerOptions' => ['width' => '15'],
                            'buttons' => [
                                'view' => function ($url, $data) {
                                    //$droit = Utils::have_access('traiteraffectation');
                                    /* if (($data->statut == 4)) {
                                        $url = 'view_affectation?key_affectation=' . $data->key_affectation;
                                        return '<button type="button" class="btn btn-xs btn-success"><a title="' . Yii::t('app', 'Détail') . '" class="
                                    " href="#" data-toggle="modal" data-target="#exampleModal2" onclick="affiche_motif(\'' . $data->motif_refus . '\')"> 
                                    <i class=" fa fa-eye" style="color: red;"></i></a> </button>';
                                    } else if (($data->statut == 0)) { */
                                    $url = 'view_affectation?key_affectation=' . $data->key_affectation;
                                    return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                <i class=" fa fa-eye"></i>
                                </a>';
                                    // }
                                    /* } else if ($droit == 1) {
                                        $url = 'view_affectation?key_affectation=' . $data->key_affectation;
                                                return '<a title="' . Yii::t('app', 'Détail') . '" class="btn btn-xs btn-success" href="' . $url . '">
                                <i class=" fa fa-eye"></i>
                                </a>';
                                    } */
                                },
                            ],
                        ],

                    ],

                ]); ?>
            </div>
        </div>
    </div>


</div>