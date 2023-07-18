<?php

namespace backend\controllers;
use yii\web\Controller;
use app\models\DemandeDepense;
use app\models\Entree;
use backend\models\Profil;
use backend\models\ProfilFonctionnalite;
use backend\models\Fonctionnalite;
use app\models\Sortie;
use backend\models\ProfilFonctionnalite as ModelsProfilFonctionnalite;
use backend\models\User;
use Yii;







class Utils extends Controller
{


    public static function emptyContent() : string{
        return '<div class="alert alert-danger" role="alert">
        Désolé! La liste est vide
      </div>';
    }

    public static function have_access($name_function)
    {

        /* $name_function = 'manager_dashboard'; */

        $idUser = Yii::$app->user->identity->id;
        $UserProfil = Yii::$app->user->identity->idprofil;

        $find_profil = Profil::find()
            ->where([
                'id' => $UserProfil,
                'statut' => 1
            ])->one();
        if ($find_profil != null) {
            $idprofil = $find_profil->id;
            $find_fonctionnalite = Fonctionnalite::find()
                ->where([
                    'code' => $name_function,
                    'statut' => 1
                ])->one();
            if ($find_fonctionnalite != null) {
                $idfonctionnalite = $find_fonctionnalite->id;
                if (($idfonctionnalite != null) && ($idprofil != null)) {
                    $find_profilFonction = ProfilFonctionnalite::find()
                        ->where([
                            'idprofil' => $idprofil,
                            'idfonctionnalite' => $idfonctionnalite,
                            'statut' => 1
                        ])->one();
                    if ($find_profilFonction != null) {
                        return 1;
                    } else {
                        return 0;
                    }
                }else {
                return 0;
            }
            } else {
                return 0;
            }
        } else {
            return 0;
        }


    }

    public static function sexe($default=0)
    {

        $tab_modedon["M"] =  'M';
        $tab_modedon["F"] =  'F';
        
		if(isset($tab_modedon[$default])) return $tab_modedon[$default]; 

        return $tab_modedon;
    }
}