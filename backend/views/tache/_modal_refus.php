<!-- Modal -->
<div class="modal fade" id="refusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header rounded-top" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <h5 class="modal-title" id="refusTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="refusContent">
        <?php

        use backend\models\Suivie;
        use yii\widgets\ActiveForm;
        $currentDate = date('Y-m-d H:i');
        $suivie = new Suivie();
        $form = ActiveForm::begin(); ?>
        <?= $form->field($suivie, 'commentaire_assigant')->textInput(['maxlength' => true, 'required' => true, 'id' => 'refusCommentaire'])->label('<h5>Motif du rejet<span class="text-danger">**</span></h5>') ?>
        <?= $form->field($suivie, 'date_debut')->textInput(['type' => 'Datetime-local', 'required' => true, 'id' => 'suivieDebut', 'min' => $currentDate])->label('<h5>Date-debut<span class="text-danger">**</span></h5>') ?>

        <?= $form->field($suivie, 'date_prob')->textInput(['type' => 'datetime-local', 'required' => true, 'id' => 'suivieProb', 'min' => $currentDate])->label('<h5>Date-limite<span class="text-danger">**</span></h5>') ?>

        <?php ActiveForm::end(); ?>
      </div>
      <input type="hidden" value="" id="keyRefus"> <!-- hidden -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-info" onclick="refuser_real_enter()">Valider</button>
      </div>
    </div>
  </div>
</div>