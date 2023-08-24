<?php

use backend\models\Suivie;
use backend\models\Tache;
use backend\models\TypeTache;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<!-- Modal -->
<div class="modal fade" id="createTacheaffectation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createTacheTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="createTacheContent">
        <!--  FORM -->
        <div class="col-lg-12">
        <div id="alert_place"></div>
          <div class="">
            <?php 
            $currentDate = date('Y-m-d H:i');
            $tache = new Tache();
            $suivie = new Suivie();
            $form = ActiveForm::begin(); ?>
            <form action="#" class="form-horizontal style-form">



              <div class="form-group">
                <div class="panel panel-default" style="background-color: #7dc3e8; color: #ffffff;">
                  <!-- Contenu de la carte -->
                  <div class="panel-body">
                    <div class="row">

                      <div class="col-lg-6">

                        <?= $form->field($tache, 'designation')->dropDownList(
                          ArrayHelper::map(
                            Tache::find()->where(['statut' => 2])->all(),
                            'id',
                            'designation',
                            function ($data) {
                              return $data->idprojet0->libelle;
                            }
                          ),
                          ['prompt' => 'Choisir une tache', 'id' =>'createtacheDesignation'],
                          ['class' => 'form-control']
                        )->error(false)->label('<h5>Tache:<span class="text-danger">**</span></h5>');
                        ?>

                        <?= $form->field($suivie, 'commentaire_assigant')->textInput(['id' => 'createtacheCommentaire'])->label('<h5>Description<span class="text-danger">**</span></h5>') ?>


                      </div>

                      <div class="col-lg-6">
                        <?= $form->field($suivie, 'date_debut')->textInput(['type' => 'Datetime-local', 'required' => true,'id' => 'createtacheDebut', 'min' => $currentDate])->label('<h5>Date-debut<span class="text-danger">**</span></h5>') ?>

                        <?= $form->field($suivie, 'date_prob')->textInput(['type' => 'datetime-local', 'required' => true,'id' => 'createtacheProb', 'min' => $currentDate])->label('<h5>Date-limite<span class="text-danger">**</span></h5>') ?>

                      </div>
                    </div>

                  </div>
                </div>

               <!--  <?= $form->field($tache, 'idtypetache')->dropDownList(
                  ArrayHelper::map(
                    TypeTache::find()->where(['statut' => 1])->all(),
                    'id',
                    'libelle',
                  ),
                  ['prompt' => 'Choisir un type de tache', 'id' => 'idCreatetypetache'],
                  ['class' => 'col-md-8 col-xs-11']
                )->error(false)->label('<h5>Type de tache<span class="text-danger">**</span></h5>');
                ?> -->
              </div>

              <!-- <div class="form-group">
                <label class="control-label col-md-3">Désignation</label>
                <div class="col-md-8 col-xs-11">
                  <input class="form-control form-control-inline input-medium " size="16" type="text" value="" id="createtacheDesignation">
                  
                </div>
              </div> -->
            </form>
            <?php ActiveForm::end(); ?>
          </div>
          <!-- /form-panel -->
        </div>
        <!-- /col-lg-12 -->
      </div>
      <div class="row mt">

      </div>
      <input type="hidden" value="" id="idAffectation"> <!-- hidden -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-info" onclick="create_tache_enter()">Valider</button>
      </div>
    </div>
  </div>
</div>