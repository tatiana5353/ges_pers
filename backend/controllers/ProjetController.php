<?php

namespace backend\controllers;

use Yii;
use backend\models\Projet;
use backend\models\Tache;
use backend\models\TypeConge;
use backend\models\TypeTache;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ProjetController implements the CRUD actions for Projet model.
 */
class ProjetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /* 'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ], */];
    }

    /**
     * Add Projet & Taches.
     * @return mixed
     */
    public function actionSave_projet()
    {
        //print_r('toto');die;
        if (Yii::$app->request->get()) {
            $all_data = Yii::$app->request->get();
            $libelle = urldecode($all_data['libelle']);
            $all_tache_added = urldecode($all_data['all_tache_added']);

            // Projet
            $projet = new Projet();
            $projet->libelle = $libelle;
            $projet->created_at = date('Y-m-d H:i:s');
            $projet->created_by = Yii::$app->user->identity->id;
            $projet->statut = 2;
            $projet->key_projet = Yii::$app->security->generateRandomString(32);

            if ($projet->save()) {

                $r = str_replace("###", "", $all_tache_added) . '+';
                $e = explode("*+", $r)[0];

                $all_data = explode("*", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);

                    $typetache = TypeTache::findOne($final_selected_value[0]);
                    $tache = new Tache();
                    $tache->key_tache =  Yii::$app->security->generateRandomString(32);
                    $tache->designation = $final_selected_value[1];
                    $tache->idtypetache = $typetache->id;
                    $tache->idprojet = $projet->id;
                    $tache->statut = 2;
                    $tache->created_by = Yii::$app->user->identity->id;
                    $tache->created_at = date('Y-m-d H:i:s');
                    $tache->save();

                    if ($i == sizeof($all_data) - 1) {
                        Yii::$app->session->setFlash('success', 'Projet enregistrée avec succès');
                        return 'ok';
                    }
                }
            }
        }
    }

    /**
     * Lists all Projet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit = Utils::have_access('projet');
        if ($droit == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Projet::find()->where(['and', ['not in', 'statut', 3]]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Displays a single Projet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_projet)
    {
        $droit_projet = Utils::have_access('projet');
        if ($droit_projet == 1) {


            $typetache = TypeTache::find()
                ->where([

                    'statut' => 1

                ])->all();
            $model = Projet::find()
                ->where([
                    'or',
                    [
                        'key_projet' => $key_projet,
                        'statut' => 0
                    ],
                    [
                        'key_projet' => $key_projet,
                        'statut' => 2
                    ]

                ])->one();
            $dataProvider = new ActiveDataProvider([
                'query' => Tache::find()
                    ->where(['idprojet' => $model->id])->andWhere(['<>', 'statut', 3]), 'pagination' => ['pageSize' => 5]
            ]);
            return $this->render('view', [
                'model' => $model,
                'typetache' => $typetache,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Projet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $droit_projet = Utils::have_access('projet');
        if ($droit_projet == 1) {

            $projet = new Projet();
            /* if (Yii::$app->request->post()) {

                if ($projet->load($this->request->post())) {
                    $projet->created_at = date('Y-m-d H:i:s');
                    $projet->created_by = Yii::$app->user->identity->id;
                    $projet->statut = 1;
                    $projet->key_projet = Yii::$app->security->generateRandomString(32);
                    $projet->libelle = trim($projet->libelle);
                    $libelle = $projet->libelle;
                    $libelleFind = Projet::find()
                        ->where([
                            'libelle' => $libelle,
                            'statut' => 1
                        ])->one();
                    if ($libelleFind == null) {
                        if ($projet->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_projet');
                        } else {

                            $projet->loadDefaultValues();
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement veuillez remplir tous les champ obligatoires');
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Projet déjà existant !');
                        $projet->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'vous n\'avez rien renseigné !');
                }
            } else {
                //Yii::$app->getSession()->setFlash('info', 'veullez renseigner le formulaire');
                $projet->loadDefaultValues();
            } */

            return $this->render('create', [
                'projet' => $projet,

            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    public function actionCreates($key_projet)
    {
        $model = new Tache();
        $droit_tache = utils::have_access('tache');
        if ($droit_tache == 1) {
            $typetache = Typetache::find()
                ->where(['statut' => 1])
                ->all();
            /*  $projet = Projet::find()
                ->where(['statut' => 1])
                ->all();
            $affectation = Affectation::find()
                ->where(['statut' => 1])
                ->all(); */
            if (Yii::$app->request->post()) {
                if ($model->load(Yii::$app->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 2;
                    $model->key_tache = Yii::$app->security->generateRandomString(32);
                    $findprojet = Projet::find()
                        ->where(['key_projet' => $key_projet])
                        ->one();
                    if ($findprojet != null) {
                        $model->idprojet = $findprojet->id;
                        /*  if ($newprojet->save()) {
                            $id = $newprojet->id;
                            $model->idprojet = $id;
                        } */
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Cette tache n\'est pas rattachée à un probleme');
                        $model->loadDefaultValues();
                    }
                    $model->designation = trim($model->designation);
                    $designation = $model->designation;
                    $id = $model->idtypetache;
                    $finddesignation = Tache::find()
                        ->where([
                            'designation' => $designation,
                            'idtypetache' => $id,
                            'statut' => 2
                        ])
                        ->one();
                    if ($finddesignation == null) {
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('succes', 'Enregistrement réussie');
                            return $this->redirect('all_tache');
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Erreur lors de l\'enregistrement!');
                            $model->loadDefaultValues();
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Tache avec meme désignation et type tache deja existant!');
                        $model->loadDefaultValues();
                    }
                } else {
                    $model->loadDefaultValues();
                    Yii::$app->getSession()->setFlash('error', 'Veuillez remplir tous les champs');
                }
            }
            return $this->render('createtache', [
                'model' => $model,
                'typetache' => $typetache,
            ]);
        } else {
            $this->redirect('accueil');
        }
    }

    /**
     * Updates an existing Projet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdatetache($key_tache, $idtype_tache, $designation)
    {
        //Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
        //print('rrr');
        $droit = utils::have_access('tache');
        if ($droit == 1) {
            
            $tache = Tache::find()
                ->where(['key_tache' => $key_tache])
                ->andWhere(['not in', 'statut', [3, 1]])
                ->one();
            $searchTache = Tache::find()
                ->where(['designation' => trim($designation), 'idtypetache' => $idtype_tache, 'idprojet' => $tache->idprojet])
                ->andWhere(['not in', 'statut', 3])
                ->one();
            if ($searchTache == null) {
                $tache->designation = $designation;
                $tache->idtypetache = $idtype_tache;
                $tache->updated_by = Yii::$app->user->identity->id;
                $tache->updated_at = date('Y-m-d H:i:s');
                if ($tache->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de l\'enregistrement!');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Cette tache existe déjà dans ce projet!');
            }
        } else {
            $this->redirect('accueil');
        }
    }

    public function actionCreatetache($idprojet, $idtype_tache, $designation)
    {
        //Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
       // print('rrr');die;
        $droit = utils::have_access('tache');
        if ($droit == 1) {
            $searchTache = Tache::find()
                ->where(['designation' => trim($designation), 'idtypetache' => $idtype_tache, 'idprojet' => $idprojet])
                ->andWhere(['not in', 'statut', 3])
                ->one();
            if ($searchTache == null) {
                $tache = new Tache();
                $tache->designation = $designation;
                $tache->idtypetache = $idtype_tache;
                $tache->idprojet = $idprojet;
                $tache->created_by = Yii::$app->user->identity->id;
                $tache->statut = 2;
                $tache->created_at = date('Y-m-d H:i:s');
                $tache->key_tache = Yii::$app->security->generateRandomString(32);
                if ($tache->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de l\'enregistrement!');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Cette tache existe déjà dans ce projet!');
            }
        } else {
            $this->redirect('accueil');
        }
    }

    
    public function actionUpdate($key_projet)
    {
        $droit_projet = Utils::have_access('projet');
        if ($droit_projet == 1) {
            $model2 = new Projet();
            $model2->load($this->request->post());
            $model2->libelle = trim(preg_replace('/\s+/', ' ', $model2->libelle));
            $model = Projet::find()
                ->where([
                    'or',
                    [
                        'key_projet' => $key_projet,
                        'statut' => 2
                    ],
                    [
                        'key_projet' => $key_projet,
                        'statut' => 0
                    ]
                ])->one();
            $currentPageUrl = Yii::$app->request->absoluteUrl;
            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = Projet::find()
                    ->where(['or', ['libelle' => $libelle, 'statut' => 2], ['libelle' => $libelle, 'statut' => 0]])
                    ->andWhere(['<>', 'id', $id])->all();
                if ($libelleFind == null) {
                    if ($model2->libelle == trim(preg_replace('/\s+/', ' ', $model->libelle))) {
                        Yii::$app->getSession()->setFlash('info', 'Vous n\'avez apporter aucune modification !');
                        $model2->loadDefaultValues();
                    } else {
                        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                            //Yii::$app->session->set('previousPage', Yii::$app->request->referrer);

                            // Rediriger vers la page précédente après la sauvegarde réussie du modèle
                            return $this->redirect('all_projet');
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Projet déjà existant !');
                    $model2->loadDefaultValues();
                }
            } else {
            }

            return $this->render('update', [
                'model' => $model,
                /* 'model' => $model2, */
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Deletes an existing Projet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * 
     */
    public function actionDeletetache($key_element)
    {

        $droit_tache = Utils::have_access('tache');
        if ($droit_tache == 1) {

            $model = Tache::find()
                ->where(['key_tache' => $key_element])
                ->andWhere(['not in', 'statut', 3])->one();
            if ($model != null) {

                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Tache supprimée avec succès !');
                    //return $this->redirect('all_tache');
                } else {
                    //print('rrtttt');die;
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        }
    }

    public function actionDelete($key_element)
    {

        $droit_projet = Utils::have_access('projet');
        if ($droit_projet == 1) {
            $model = Projet::find()
                ->where([
                    'key_projet' => $key_element,
                    'statut' => 2
                ])->one();
            if ($model != null) {
                /* $mt = Typeconge::find()->where([
                    'statut' => 1, 
                    'idtypeconge' => $model->id
                    ])->count();
                if ($mt > 0) {
                    Yii::$app->getSession()->setFlash('error', 'Vous ne pouvez pas supprimer ce type de congé car il est déjà enregistré !');
                }else{ */
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Projet supprimer avec succès !');
                    // return $this->redirect('all_typeconge');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        }
    }

    /**
     * Finds the Projet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_projet)
    {
        $model = Projet::find()
            ->where([
                'key_projet' => $key_projet,
                'statut' => 1
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
