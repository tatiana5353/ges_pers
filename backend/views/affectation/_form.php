<?php

use backend\models\Tache;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Affectation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="affectation-form">
    <form action="#">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($affectation, 'iduser')->dropDownList(
            ArrayHelper::map(
                User::find()->where(['status' => 10])->all(),
                'id',
                'nom',
            ),
            ['prompt' => 'Choisir un employé'],
            ['class' => 'form-control']
        )->error(false)->label('<h5>Employé<span class="text-danger">**</span></h5>');
        ?>
        <div id="alert_place"></div>
        <div class="panel panel-default" style="background-color: #7dc3e8; color: #ffffff;">
            <!-- Contenu de la carte -->
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-6">

                        <?= $form->field($tache, 'designation')->dropDownList(
                            ArrayHelper::map(
                                Tache::find()->where(['statut' => 0])->all(),
                                'id',
                                'designation',
                                function ($data) {
                                    return $data->idprojet0->libelle;
                                }
                            ),
                            ['prompt' => 'Choisir une tache'],
                            ['class' => 'form-control']
                        )->error(false)->label('<h5>Tache:<span class="text-danger">**</span></h5>');
                        ?>

                        <?= $form->field($tache, 'description')->textInput()->label('<h5>Description<span class="text-danger">**</span></h5>') ?>


                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($tache, 'heure_debut')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Date-debut<span class="text-danger">**</span></h5>') ?>

                        <?= $form->field($tache, 'heure_fin')->textInput(['type' => 'datetime-local', 'required' => true])->label('<h5>Date-limite<span class="text-danger">**</span></h5>') ?>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <button type="button" class="btn" style="background-color: #4DB6AC; color: #FFFFFF;" onclick="add_tache()"><i class="fa fa-plus"></i> Ajouter</button>
                    <?= Html::resetButton('<i class="fa fa fa-undo fx-8"></i>  Annuler', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
        <textarea name="all_tache_added" id="all_tache_added" cols="30" rows="10" style="display: none;"></textarea>

        <table class="table" id="tab_temp_preview">
            <thead>
                <tr>
                    <th scope="col">Tache</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date-debut</th>
                    <th scope="col">Date-limite</th>
                </tr>
            </thead>
            <tbody id="rows">

            </tbody>
        </table>
        <div class="card-footer">
            <!-- <div class="form-group"> -->

                <button type="button" class="btn btn-primary" onclick="save_affectation()">Valider</button>
                <!-- ?= Html::a(' Quitter', ['/all_demande'], ['class' => 'btn badge-danger']) ?> -->
            <!-- </div> -->
        </div>

        <?php ActiveForm::end(); ?>
    </form>
</div>




<script>
    function add_tache() {
        var tache = $('#tache-designation').val();
        var tache_text = $("#tache-designation option:selected").text();
        var description = $('#tache-description').val();
        var date_debut = $('#tache-heure_debut').val();
        var date_fin = $('#tache-heure_fin').val();

        if (tache != '' && description != '' && date_debut != '' && date_fin != '') {

            var old_tache_added = $("#all_tache_added").val();
            var search_position = old_tache_added.search('###' + tache + ';;;' + description + ';;;' + date_debut + ';;;' + date_fin);

            if (search_position >= 0) {
                msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    ' Cette tache est déjà ajoutée à la liste </div> </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);
            } else {

                var new_data = tache + ';;;' + description + ';;;' + date_debut + ';;;' + date_fin;

                $("#all_tache_added").val(old_tache_added + '###' + new_data + '*');


                var newCell = document.createElement("td");
                var newCell1 = document.createElement("td");
                var newCell2 = document.createElement("td");
                var newCell3 = document.createElement("td");
                var newCell4 = document.createElement("td");

                newCell.innerHTML = tache_text;
                newCell1.innerHTML = description;
                newCell2.innerHTML = date_debut;
                newCell3.innerHTML = date_fin;
                newCell4.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_tache(\'' + new_data + '\', this)"></i>';

                var newRow = document.createElement("tr");

                newRow.append(newCell);
                newRow.append(newCell1);
                newRow.append(newCell2);
                newRow.append(newCell3);
                newRow.append(newCell4);

                document.getElementById("rows").appendChild(newRow);

                document.getElementById('tache-designation').value = '';
                document.getElementById('tache-description').value = '';
                document.getElementById('tache-heure_debut').value = '';
                document.getElementById('tache-heure_fin').value = '';

                msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' +
                    '<div class="alert-body">' +
                    'Tache affectée avec succès' +
                    '</div>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);

            }

        } else {
            msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' +
                '<div class="alert-body">' +
                'Veuillez renseigner les champs' +
                '</div>' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            $('#alert_place').show();
            $('#alert_place').html(msg);
        }
    }

    function delete_tache(data, element) {
        var correct_data = '###' + data + '*';
        var row_index = element.closest('tr').rowIndex;

        var all_tache_added = $("#all_tache_added").val();
        var res = all_tache_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
        $("#all_tache_added").val(res);
        document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
    }

    function save_affectation() {
        let url = "<?= Yii::$app->homeUrl ?>save_affectation";
        let iduser = $('#affectation-iduser').val();
        let all_tache_added = $('#all_tache_added').val();
        if (iduser != "", all_tache_added != "") {
            $.ajax({
                url: url,
                method: "get",
                data: {
                    iduser: encodeURIComponent(iduser),
                    all_tache_added: encodeURIComponent(all_tache_added),
                },
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else {
                        if (result == "ok") {
                            document.location.href = "<?php Yii::$app->homeUrl ?>all_affectation";
                        } else {
                            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                'Erreur lors de l\'enregistrement !' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '</div>';
                            $('#alert_place_g').html(err);
                        }
                    }
                }
            });
        } else {
            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner tous les champs obligatoire' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + '<span aria-hidden="true">&times;</span>' + '</button>' + '</div>';
            $('#alert_place_g').html(err);
        }
    }
</script>