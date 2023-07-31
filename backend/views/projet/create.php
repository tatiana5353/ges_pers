<?php

use backend\models\Tache;
use backend\models\TypeTache;
use frontend\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projet */

$this->title = 'Create Projet';
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$tache = new Tache();
?>
<?= Alert::widget() ?>
<div class="projet-create">
    <div id="alert_place_g"></div>
    <div class="row">
        <div class="col-lg-8 p-r-1 title-margin-right">
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

        <div class="col-lg-4 p-l-1 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/gespers/admin/accueil">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active"> <a href="/gespers/admin/all_projet">Liste</a></li>
                        <li class="breadcrumb-item active">Création
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--  DATE PICKERS -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Titre de la carte</h3>
        </div>
        <div class="panel-body">
            Contenu de la carte

            <div class="col-lg-12">

                <!-- <div class=""> -->
                <form action="#" class="style-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="projet-form">

                        <div class="">

                            <div class="">
                                <?= $form->field($projet, 'libelle')->textInput(['maxlength' => true, 'required' => true])->label('<h5>Nom du projet<span class="text-danger">**</span></h5>') ?>
                            </div>
                        </div>
                        <div class="panel panel-default" style="background-color: #7dc3e8; color: #ffffff;">
                            <!-- Contenu de la carte -->
                            <div class="panel-body">

                                <div class="row clearfix">
                                    <div id="alert_place"></div>
                                    <div class="col-xs-3">
                                        <?= $form->field($tache, 'idtypetache')->dropDownList(
                                            ArrayHelper::map(
                                                TypeTache::find()->where(['statut' => 1])->all(),
                                                'id',
                                                'libelle',
                                            ),
                                            ['prompt' => 'Choisir un type de tache'],
                                            ['class' => 'form-control']
                                        )->error(false)->label('<h5>Type de tache:<span class="text-danger">**</span></h5>');
                                        ?>
                                    </div>
                                    <div class="col-xs-3 ">
                                        <?= $form->field($tache, 'designation')->textInput(['maxlength' => true, 'required' => true,])->label('<h5>Tache :<span class="text-danger">**</span></h5>'); ?>
                                    </div>

                                    <textarea name="all_tache_added" id="all_tache_added" cols="30" rows="10" style="display: none;"></textarea>

                                    <div class="col-xs-4">
                                        <button type="button" class="btn" style="background-color: #4DB6AC; color: #FFFFFF;" onclick="add_tache()"><i class="fa fa-plus"></i> Ajouter</button>
                                        <?= Html::resetButton('<i class="fa fa fa-undo fx-8"></i>  Annuler', ['class' => 'btn btn-default']) ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <table class="table" id="tab_temp_preview">
                            <thead>
                                <tr>
                                    <th scope="col">Type de tache</th>
                                    <th scope="col">Tache</th>
                                    <!-- <th scope="col">Motif</th>
                                <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody id="rows">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="save_projet()">Valider</button>
                        <!-- ?= Html::a(' Quitter', ['/all_demande'], ['class' => 'btn badge-danger']) ?> -->
                    </div>
                    <?php ActiveForm::end(); ?>
                </form>
                <!-- </div> -->

                <!-- /form-panel -->
            </div>
        </div>
    </div>
    <!-- /col-lg-12 -->
</div>

<script>
    function add_tache() {
        var typetache = $('#tache-idtypetache').val();
        var typetache_text = $("#tache-idtypetache option:selected").text();
        var designation = $('#tache-designation').val();

        if (typetache != '' && designation != '') {

            var old_tache_added = $("#all_tache_added").val();
            var search_position = old_tache_added.search('###' + typetache + ';;;' + designation);

            if (search_position >= 0) {
                msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    ' Cette tache est déjà ajoutée à la liste </div> </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);
            } else {

                var new_data = typetache + ';;;' + designation;

                $("#all_tache_added").val(old_tache_added + '###' + new_data + '*');


                var newCell = document.createElement("td");
                var newCell1 = document.createElement("td");
                var newCell2 = document.createElement("td");

                newCell.innerHTML = typetache_text;
                newCell1.innerHTML = designation;
                newCell2.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_tache(\'' + new_data + '\', this)"></i>';

                var newRow = document.createElement("tr");

                newRow.append(newCell);
                newRow.append(newCell1);
                newRow.append(newCell2);

                document.getElementById("rows").appendChild(newRow);

                document.getElementById('tache-idtypetache').value = '';
                document.getElementById('tache-designation').value = '';


                msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' +
                    '<div class="alert-body">' +
                    'Tache ajoutée avec succès' +
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

    function save_projet() {
        let url = "<?= Yii::$app->homeUrl ?>save_projet";
        let libelle = $('#projet-libelle').val();
        let all_tache_added = $('#all_tache_added').val();
        if (libelle != "", all_tache_added != "") {
            $.ajax({
                url: url,
                method: "get",
                data: {
                    libelle: encodeURIComponent(libelle),
                    all_tache_added: encodeURIComponent(all_tache_added),
                },
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else {
                        if (result == "ok") {
                            document.location.href = "<?php Yii::$app->homeUrl ?>all_projet";
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