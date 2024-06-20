<?php

use backend\models\Tache;
use backend\models\TypeTache;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<!-- Modal -->
<div class="modal fade" id="updateTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateTacheTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="updateTacheContent">
        <!--  FORM -->
        <div class="col-lg-12">
          <div class="">
            <?php $tache = new Tache();
            $form = ActiveForm::begin(); ?>
            <form action="#" class="form-horizontal style-form">
              
              <div class="form-group">
              <?= $form->field($tache, 'idtypetache')->dropDownList(
                  ArrayHelper::map(
                    TypeTache::find()->where(['statut' => 1])->all(),
                    'id',
                    'libelle',
                  ),
                  ['prompt' => 'Choisir un type de tache'],
                  ['class' => 'col-md-8 col-xs-11']
                )->error(false)->label('<h5>Type de tache<span class="text-danger">**</span></h5>');
                ?>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Désignation</label>
                <div class="col-md-8 col-xs-11">
                  <input class="form-control form-control-inline input-medium " size="16" type="text" value="" id="tacheDesignation">
                  <!-- <span class="help-block">Select date</span> -->
                </div>
              </div>
            </form>
            <?php ActiveForm::end(); ?>
          </div>
          <!-- /form-panel -->
        </div>
        <!-- /col-lg-12 -->
      </div>
      <div class="row mt">

      </div>
      <input type="hidden" value="" id="keyTache"> <!-- hidden -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-info" onclick="update_tache_enter()">Valider</button>
      </div>
    </div>
  </div>
</div>