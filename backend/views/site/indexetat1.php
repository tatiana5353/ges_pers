<?php

use yii\bootstrap\Html;
?>
<link href="template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="template/css/style.css" rel="stylesheet">
<link href="template/css/style-responsive.css" rel="stylesheet">

<div class="row">
    <div class="col-lg-8 p-r-0 title-margin-right">
        <div class="page-header">
            <div class="page-title">
                <marquee behavior="alternate" direction="">
                    <h1><?= Html::encode($this->title) ?></h1>
                </marquee>
            </div>
        </div>
    </div>

    <div class="col-lg-4 p-l-1 title-margin-left">
        <div class="page-header">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/gescaisse/admin/accueil">Accueil</a>
                    </li>

                    <li class="breadcrumb-item active">Etats des entrées</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section>
    <div class="card">
        <div class="row">
            <?= Html::a('<i class=" fa fa-print"></i> Imprimer', ['/indexetat1'], ['class' => 'btn btn-danger text-white', 'onclick' => 'printData()']) ?>
            <?= Html::a('<i class=" fa fa-print"></i> Imprimer', ['/indexetat1'], ['class' => 'btn btn-danger text-white', 'onclick' => 'telechargerSectionEnPDF()']) ?>

            <div class="col-lg-12">
                <div class="card">

                    <div class="table table-hover" id="table_div1"></div>

                </div>

            </div>
        </div>
    </div>
</section>




<script>
    function printData() {
        var divToPrint = document.getElementById('table_div1');
        var htmlToPrint = 'nnnnnnnn' +
            '<style type="text/css">' +
            'table, table, td, th{' +
            'border:1px solid #000;' +
            'border-collapse: collapse;' +
            'padding;0.5em;' +
            '}' +
            '</style>';
        /* '<style type="text/css">' +
        ' th {' +
        ' font - family: monospace;' +
        ' border: thin solid #6495ed;' +
        'width: 50%;' +
        'padding: 5px;' +
        'background-color: # D0E3FA;' +
        'background - image: url(template/images/eagri2.jpeg);' +
        '}' +
        '</style>'; */


        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }

    function telechargerSectionEnPDF() {
        var fileName = 'Liste_des_demandes_validees';

        var divToPrint = document.getElementById('table_div1');
        var htmlToPrint = '' +
            '<!DOCTYPE html>' +
            '<html>' +
            '<head>' +
            '<style type="text/css">' +
            'table, td, th {' +
            '    border: 1px solid #000;' +
            '    border-collapse: collapse;' +
            '    padding: 0.5em;' +
            '}' +
            '@media print {' +
            '    body {' +
            '        margin: 1em; /* Add some margin to the body for spacing */' +
            '    }' +
            '    table {' +
            '        width: 80%; /* Reduce the width of the table */' +
            '        margin: 0 auto; /* Center the table horizontally */' +
            '        margin-bottom: 1em; /* Add some margin between tables */' +
            '    }' +
            '    /* Hide headers and footers */' +
            '    @page {' +
            '        size: auto; /* Use the auto size of the content */' +
            '        margin: 0mm; /* Set the margin to 0 */' +
            '    }' +
            '    body::before {' +
            '        content: "";' +
            '        display: block;' +
            '        height: 20mm; /* Set the height of the header to 0 */' +
            '    }' +
            '    body::after {' +
            '        content: "";' +
            '        display: block;' +
            '        height: 20mm; /* Set the height of the footer to 0 */' +
            '        page-break-after: always; /* Force a page break after content */' +
            '    }' +
            '}' +
            '</style>' +
            '</head>' +
            '<body>' +
            '<div class="container">' + // Utilisez un container Bootstrap pour envelopper le contenu
            ' <div class="row">' +
            '  <div class="col-lg-4">EXCELL MEDIA</div>' +

            '  <div class="col-lg-4">Création graphique</div>' +
            '  <div class="col-lg-4">Production audio-visuelle</div>' +
            '            <div class="col-lg-4" style="text-align: center; border-bottom: 1px solid; padding-bottom: 2px;">LISTE DES DEMANDES D\'ABSENCES</div>' +
            ' </div>' +
            '</div>' +

            divToPrint.innerHTML + // Utilisez innerHTML au lieu de outerHTML
            '</body>' +
            '</html>';

        // Si le nom de fichier n'est pas fourni, utilisez une valeur par défaut
        fileName = fileName || 'generated_pdf';

        var newWin = window.open('', '', 'width=800,height=600');
        newWin.document.write(htmlToPrint);
        newWin.document.close();
        // Attendez le chargement des styles et des images avant d'appeler newWin.print()
        newWin.onload = function() {
            newWin.document.title = fileName; // Définir le titre du document comme le nom de fichier souhaité
            newWin.print();
            newWin.close();
        };
    }
</script>