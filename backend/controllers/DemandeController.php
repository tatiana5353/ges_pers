<?php

namespace backend\controllers;

use Yii;
use backend\models\Demande;
use backend\models\TypeConge;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DemandeController implements the CRUD actions for Demande model.
 */
class DemandeController extends Controller
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
     * Lists all Demande models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit_traitement = Utils::have_access('traiterdemande');
        $droit = Utils::have_access('demande_perso');
        if ($droit_traitement == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Demande::find()->where(['not in', 'statut', 3]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } elseif ($droit == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Demande::find()->where(['not in', 'statut', 3])
                    ->andWhere(['created_by' => Yii::$app->user->identity->id])
            ]);

            return $this->render('indexe', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }


    /**
     * Displays a single Demande model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_demande)
    {
        $droit_demande = Utils::have_access('demande');
        if ($droit_demande == 1) {
            $model = Demande::find()
                ->where([
                    'key_demande' => $key_demande,
                    'statut' => 0
                ])->one();
            $model2 = Demande::find()
                ->where([
                    'key_demande' => $key_demande,
                    'statut' => 1
                ])->one();

            if ($model != null) {
                $model->debutconge = date('d-m-Y H:i', strtotime($model->debutconge));
                $model->finconge = date('d-m-Y H:i', strtotime($model->finconge));
                return $this->render('view', [
                    'model' => $model
                ]);
            } elseif ($model2 != null) {
                $model2->debutconge = date('d-m-y H:i', strtotime($model2->debutconge));
                $model2->finconge = date('d-m-y H:i', strtotime($model2->finconge));
                return $this->render('view', [
                    'model' => $model2
                ]);
            }
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Creates a new Demande model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $droitdemande = Utils::have_access('demande');
        if ($droitdemande == 1) {
            $model = new Demande();
            $typeconge = TypeConge::find()
                ->where(['statut' => 1])
                ->all();
            $nbrdemande = Demande::find()->where([
                'statut' => 2,
                'created_by' => Yii::$app->user->identity->id
            ])->count();
            if ($nbrdemande > 2) {
                Yii::$app->getSession()->setFlash('error', 'vous avez atteint le nombre de congés autorisés !');
            }
            if (Yii::$app->request->post()) {
                if ($model->load(Yii::$app->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 0;
                    $model->key_demande = Yii::$app->security->generateRandomString(32);
                    $model->numero = 'NE-' . date('md') . '-' . rand(11, 99);
                    $debutconge = $model->debutconge;
                    $finconge = $model->finconge;
                    // print(strtotime($model->created_at));die;
                    if ((strtotime($debutconge) < strtotime($finconge))/*  && (strtotime($debutconge) >= strtotime($model->created_at)) */) {
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_demande');
                        } else {
                            $model->loadDefaultValues();
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement veuillez remplir tous les champ obligatoires');
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', '☻ ♥☺♦♣♠○◘•♥☻Vos dates de début de congé et de fin de congé ne peut pas etre inférieur à la date actuelle!');
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'vous n\'avez rien renseigné !');
                }
            } else {
                $model->loadDefaultValues();
            }
            return $this->render('create', [
                'model' => $model,
                'typeconge' => $typeconge,
            ]);
        } else {
            return $this->redirect('accueil');
        }


        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } */
    }

    /**
     * Updates an existing Demande model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key_demande)
    {
        $droit_demande = Utils::have_access('demande');
        if ($droit_demande == 1) {
            $typeconge = TypeConge::find()
                ->where(['statut' => 1])
                ->all();

            $model2 = new Demande;
            $model2->load($this->request->post());
            $model2->key_demande = Yii::$app->security->generateRandomString(32);
            $model = Demande::find()
                ->where([
                    'key_demande' => $key_demande,
                    'statut' => 0
                ])->one();

            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');
                $model->debutconge = date('Y-m-d H:i:s', strtotime($model->debutconge));
                $model->finconge = date('Y-m-d H:i:s', strtotime($model->finconge));
                $id = $model->id;
                /* $demandeFind = Demande::find()
                    ->where(['statut' => 0])
                    ->andWhere(['<>', 'id', $id])->all(); */
                if ($model->load(Yii::$app->request->post())) {

                    if ((strtotime($model2->finconge) >= strtotime($model->updated_at))) {
                        //print("fsqsq");die;
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                            return $this->redirect('all_demande');
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Echec lors de l\'enregistrement !');
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', '☻ ♥☺♦♣♠○◘•♥☻Vos dates de début de congé et de fin de congé ne peut pas etre inférieur à la date actuelle!');
                    }
                } else {

                    $model2->loadDefaultValues();
                }
            }
            return $this->render('update', [
                'model' => $model,
                'typeconge' => $typeconge,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }


    public function actionRefus($key_demande)
    {

        $droit_traiter = Utils::have_access('traiterdemande');
        if ($droit_traiter == 1) {
            $typeconge = TypeConge::find()
                ->where(['statut' => 1])
                ->all();
            $model2 = new Demande();
            $model2->load($this->request->post());
            $model = Demande::find()
                ->where([
                    'key_demande' => $key_demande,
                    'statut' => 0
                ])->one();
            //$iduser = $model->iduser;
            if ($model != null) {

                $model->statut = 4;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $numero = $model2->numero;
                $numeroFind = Demande::find()
                    ->where(['numero' => $numero, 'statut' => 0,])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($numeroFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        // print("gdgcsf");die;
                        Yii::$app->getSession()->setFlash('success', 'Vous venez de refuser la demande !');
                        return $this->redirect('all_demande');
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'erreur lors de l\'enregistrement !');
                        $model2->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', ' !');
                    $model2->loadDefaultValues();
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Demande non existante!');

                return $this->redirect('all_demande');
            }

            return $this->render('refus', [
                'model' => $model,
                'typeconge' => $typeconge,
                //'partenaire' => $partenaires, */
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }


    public function actionValider($key_element)
    {
        $droit_demande = Utils::have_access('demande');
        if ($droit_demande == 1) {
            $model = Demande::find()
                ->where([
                    'key_demande' => $key_element,
                    'statut' => 0
                ])->one();
            /* print($model->id);die; */
            if ($model != null) {
                /* $mt = Typeconge::find()->where([
                    'statut' => 1, 
                    'idtypeconge' => $model->id
                    ])->count();
                if ($mt > 0) {
                    Yii::$app->getSession()->setFlash('error', 'Vous ne pouvez pas supprimer ce type de congé car il est déjà enregistré !');
                }else{ */
                $model->statut = 1;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Demande de congé Valider avec succès !');
                    //return $this->redirect('all_demande');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la validation!');
                }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la validation !');
        }
    }

    /**
     * Deletes an existing Demande model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_element)
    {

        $droit_demande = Utils::have_access('demande');
        if ($droit_demande == 1) {
            $model = Demande::find()
                ->where([
                    'key_demande' => $key_element,
                    'statut' => 0
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
                    Yii::$app->getSession()->setFlash('success', 'Demande de congé supprimer avec succès !');
                    // return $this->redirect('all_typeconge');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        }
    }

    /**
     * Finds the Demande model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Demande the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_demande)
    {
        $model = Demande::find()
            ->where([
                'key_demande' => $key_demande,
                'statut' => 1
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
