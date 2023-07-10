<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">
            <?php  use yii\bootstrap\Html;?> 
            <?=
 $nomUtilisateur = Yii::$app->user->identity->nom;

echo Html::tag('p', 'Utilisateur connecté : ' . $nomUtilisateur);
           
            ?> 
          </h5>
          <li class="mt">
            <a href="\gespers\admin\accueil">
              <i class="fa fa-dashboard"></i>
              <span>Accueil</span>
              </a>
          </li>
          <li><a class="sidebar-sub-toggle"><i class="ti-view-list-alt"></i>Parametres systemes <span class="sidebar-collapse-icon ti-angle-down"></span></a>
            <ul>
              <li><a href="\gespers\admin\all_horaire">Horaires</a></li>
              <li><a href="\gespers\admin\all_typeconge">Type de congés</a></li>
              <li><a href="\gespers\admin\all_sortie">Horaires</a></li>
            </ul>
          </li>
          <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="ti-view-list-alt"></i>Planification des taches <span class="sidebar-collapse-icon ti-angle-down"></span></a>
            <ul class="sub">
              <li><a href="\gespers\admin\all_typetache">Type de taches</a></li>
              <li><a href="\gespers\admin\all_projet">Projets</a></li>
              <li><a href="\gespers\admin\all_sortie">Affectation</a></li>
              <li><a href="\gespers\admin\all_sortie">taches</a></li>
            </ul>
          </li>

          <li><a href="javascript:;" class="sidebar-sub-toggle"><i class="ti-view-list-alt"></i>Demande de conge<span class="sidebar-collapse-icon ti-angle-down"></span></a>
            <ul class="sub">
              <li><a href="\gespers\admin\all_demande">Faire une demande</a></li>
            </ul>
          </li>

          <li class="sidebar-sub-toggle">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Gestion des types congés</span>
              </a>
            <ul class="sub">
              <li class="sub-menu"><a href="all_typeconge">Liste des types de congés</a></li>
              <li><a href="add_typeconge">Ajouter un type de congé</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Gestion des demandes de congés</span>
              </a>
            <ul class="sub">
              <li class="active"><a href="all_demande">Liste des demandes de congés</a></li>
              <li><a href="add_demande">Ajouter une demande de congé</a></li>
            </ul>
          </li>
          
          
          </li>
        
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->