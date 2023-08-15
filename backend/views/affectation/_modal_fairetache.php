<div class="modal fade" id="fairetache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-lg" style="border-radius: 1rem;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fairetacheTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="fairetacheContent">
        <!--  FORM -->
        <div class="col-lg-12">
          <?php

          use backend\models\Suivie;
          use backend\models\Tache;
          use yii\bootstrap\ActiveForm;

          $currentDate = date('Y-m-d H:i');
          $tache = new Tache();
          $suivie = new Suivie();
          $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal style-form']
          ]);
          ?>
          <div class="form-group">
            <!-- Contenu de la carte -->
            <div class="panel-body">
              <?= $form->field($suivie, 'commentaire_effectuant')->textarea(['rows' => 4,'id' => 'fairetacheCommentaire'])->label('<span class="text-dark">Description sur la tache</span><span class="text-danger">**</span>') ?>
            </div>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
        <!-- /form-panel -->
      </div>
      <!-- /col-lg-12 -->

      <div class="row mt"></div>
      <input type="hidden" value="" id="keytache"> <!-- hidden -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-info" onclick="fairetache_enter()">Valider</button>
      </div>
    </div>
  </div>
</div>