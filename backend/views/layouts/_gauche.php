<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<?php

use backend\controllers\Utils;
use yii\bootstrap\Html; ?>
<aside>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@1.0.0/css/themify-icons.css">
  <div id="sidebar" class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <p class="centered"><a href="profile.html"><img src="template/img/telechargement.jpg" class="img-circle" width="80"></a></p>
      <h5 class="centered">

        <?php
        $nomUtilisateur = Yii::$app->user->identity->nom;
        $prenomUtilisateur = Yii::$app->user->identity->prenoms;
        echo Html::tag('p', $nomUtilisateur . ' ' . $prenomUtilisateur);

        ?>
      </h5>
      <li class="mt">
        <a href="\gespers\admin\accueil">
          <i class="fa fa-dashboard"></i>
          <span>Accueil</span>
        </a>
      </li>
      <?php
      $droit = Utils::have_access('side_bar');
      if ($droit == 1) { ?>
        <li><a class="sidebar-sub-toggle"><i class="fa fa-cogs fa-2x"></i>Parametres systemes <span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>
            <li><a href="\gespers\admin\all_horaire">Horaires</a></li>
            <li><a href="\gespers\admin\all_typeconge">Type d'absence</a></li>
          </ul>
        </li>
      <?php } ?>
      <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-calendar fa-lg"></i>Planification des taches <span class="sidebar-collapse-icon ti-angle-down"></span></a>
        <ul>

          <?php
          $droit = Utils::have_access('side_bar');
          if ($droit == 1) { ?>

            <li><a href="\gespers\admin\all_typetache">Type de taches</a></li>
            <li><a href="\gespers\admin\all_projet">Projets</a></li>
            <li><a href="\gespers\admin\all_tache">taches</a></li>
            <li><a href="\gespers\admin\all_affectation">Affectation</a></li>
          <?php } ?>
          <li><a href="\gespers\admin\tache_affectation">Mes taches</a></li>

        </ul>
      </li>
      <?php
      $droit = Utils::have_access('side_bar');
      if ($droit == 1) { ?>


        <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-calendar fa-lg"></i>Réalisations<span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>


            <li><a href="\gespers\admin\vue_realisation">Taches réalisées</a></li>

          <?php } ?>

          </ul>
        </li>

        <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-plane fa-lg"></i>Demande d'absence<span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>
            <li><a href="\gespers\admin\all_demande">Faire une demande</a></li>
          </ul>
        </li>





        </li>

    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->