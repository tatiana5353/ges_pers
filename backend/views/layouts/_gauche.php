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
            <!-- <li><a href="\gespers\admin\all_horaire">Horaires</a></li> -->
            <li><a href="\gespers\admin\all_typeconge">Type d'absence</a></li>
            <li><a href="\gespers\admin\all_typetache">Type de tâche</a></li>
          </ul>
        </li>

        <li><a class="sidebar-sub-toggle"><i class="fa fa-list fa-4x"></i>Création des tâches<span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>
            <li><a href="\gespers\admin\all_tache">Tâches individuelles</a></li>
            <li><a href="\gespers\admin\all_projet">Projets</a></li>
          </ul>
        </li>
      <?php } ?>
      <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-calendar fa-lg"></i>Affectation des taches <span class="sidebar-collapse-icon ti-angle-down"></span></a>
        <ul>

          <?php
          // $droit = Utils::have_access('side_bar');
          if ($droit == 1) { ?>

            <li><a href="\gespers\admin\all_affectation">Liste des affectations</a></li>
            <li><a href="\gespers\admin\add_affectation">Nouvelle affectation</a></li>

            <li><a href="\gespers\admin\vue_realisation">Suivie des taches</a></li>
          <?php } ?>
          <li><a href="\gespers\admin\tache_affectation">Mes taches</a></li>

        </ul>
      </li>
      <?php
      $droit = Utils::have_access('side_bar');
      if ($droit == 1) { ?>

        <!-- 
        <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-calendar fa-lg"></i>Réalisations<span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>


            <li><a href="\gespers\admin\vue_realisation">Taches réalisées</a></li>
          </ul>
        </li> -->
      <?php } ?>
      <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-suitcase fa-lg"></i>Demande d'absence<span class="sidebar-collapse-icon ti-angle-down"></span></a>
        <ul>
          <li><a href="\gespers\admin\all_demande">Faire une demande</a></li>
        </ul>
      </li>
      </li>
      <?php
      $droit = Utils::have_access('side_bar');
      if ($droit == 1) { ?>

     
        <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="fa fa-calendar fa-lg"></i>Gestion des utilisateurs<span class="sidebar-collapse-icon ti-angle-down"></span></a>
          <ul>


            <li><a href="\gespers\admin\all_user">Listes des utilisateurs</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->