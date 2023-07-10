<?php

public static function have_access($name_function)
    {

        /* $name_function = 'manager_dashboard'; */

        $idUser = Yii::$app->user->identity->id;
        $UserProfil = Yii::$app->user->identity->idProfil;

        $find_profil = Profil::find()
            ->where([
                'id' => $UserProfil,
                'statut' => 1
            ])->one();
        if ($find_profil != null) {
            $idProfil = $find_profil->id;
            $find_fonctionnalite = Fonctionnalite::find()
                ->where([
                    'code' => $name_function,
                    'statut' => 1
                ])->one();
            if ($find_fonctionnalite != null) {
                $idFonctionnalite = $find_fonctionnalite->id;
                if (($idFonctionnalite != null) && ($idProfil != null)) {
                    $find_profilFonction = ProfilFonctionnalite::find()
                        ->where([
                            'idProfil' => $idProfil,
                            'idFonctionnalite' => $idFonctionnalite,
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