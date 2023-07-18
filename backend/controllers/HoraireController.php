<?php

namespace backend\controllers;

use Yii;
use backend\models\Horaire;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HoraireController implements the CRUD actions for Horaire model.
 */
class HoraireController extends Controller
{
    /**
     * {@inheritdoc}s
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
     * Lists all Horaire models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Horaire::find()->where(['not in', 'statut', 3]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Displays a single Horaire model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Horaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionOn($key_horaire)
    {
        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $model =  Horaire::find()
                ->where([
                    'key_horaire' => $key_horaire,
                    'statut' => 2
                ])->one();

            $horaire_on =  Horaire::find()
                ->where([
                    'statut' => 1
                ])->one();

            if ($horaire_on == null) {
                if ($model != null) {
                    $model->statut = 1;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->updated_at = date('Y-m-d H:i:s');
                    if ($model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Activation réussie !');
                        return $this->redirect(['/all_horaire']);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Erreur lors de l\'activation !');
                        return $this->redirect(['/all_horaire']);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Horaire introuvable !');
                    return $this->redirect(['/all_horaire']);
                }
            } else {
                $horaire_on->statut = 2;
                $horaire_on->updated_by = Yii::$app->user->identity->id;
                $horaire_on->updated_at = date('Y-m-d H:i:s');
                $model->statut = 1;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');
                if (($model->save()) && ($horaire_on->save())) {
                    Yii::$app->getSession()->setFlash('success', 'Activation réussie !');
                    return $this->redirect(['/all_horaire']);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de l\'activation !');
                    return $this->redirect(['/all_horaire']);
                }
            }
        } else {
            return $this->redirect('accueil');
        }
    }

    public function actionOff($key_horaire)
    {
        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $model =  Horaire::find()
                ->where([
                    'key_horaire' => $key_horaire,
                    'statut' => 1
                ])->one();
            if ($model != null) {
                //print($model->status);die;
                $model->statut = 2;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Désactivation réussie !');
                    return $this->redirect(['/all_horaire']);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la désactivation !');
                    return $this->redirect(['/all_horaire']);
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Horaire introuvable !');
                return $this->redirect(['/all_horaire']);
            }
        } else {
            return $this->redirect('accueil');
        }
    }

    public function actionCreate()
    {
        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $model = new Horaire();
            if (Yii::$app->request->post()) {
                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_horaire = Yii::$app->security->generateRandomString(32);
                    $heurearrivee = $model->heure_arrivee;
                    $heuredepart = $model->heure_depart;
                    $heureFind = Horaire::find()
                        ->where([
                            'heure_arrivee' => $heurearrivee,
                            'heure_depart' => $heuredepart,
                            'statut' => 1
                        ])->one();
                    if (($heuredepart > $heurearrivee) && ((strtotime($heuredepart) - strtotime($heurearrivee)) >= 8 * 60 * 60)) {
                        if ($heureFind == null) {
                            if ($model->save()) {
                                Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                                return $this->redirect('all_horaire');
                            } else {
                                $model->loadDefaultValues();
                                Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement veuillez remplir tous les champ obligatoires');
                            }
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'La difference entyre l\'heure d\'arrivée et de depart doit etre plus de 8 heures!');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'vous n\'avez rien renseigné !');
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Updates an existing Horaire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdates($key_horaire)
    {
        $model = $this->findModel($key_horaire);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['horaire/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($key_horaire)
    {
        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $model2 = new Horaire();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_horaire = Yii::$app->security->generateRandomString(32);
            $model = $this->findModel($key_horaire);
            if ($model != null) {

                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $h_arrive = $model2->heure_arrivee;
                $h_depart = $model2->heure_depart;
                $heureFind = Horaire::find()
                    ->where(['heure_depart' => $h_depart, 'heure_arrivee' => $h_arrive, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($heureFind == null) {

                    if (($model2->heure_arrivee == $model->heure_arrivee) && ($model2->heure_depart == $model->heure_depart)) {
                        Yii::$app->getSession()->setFlash('info', 'Vous n\'avez apporter aucune modification !');
                        $model2->loadDefaultValues();
                    } else {
                        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect(['horaire/index']);
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'horaire déjà existant avec ces memes heures!');
                    $model2->loadDefaultValues();
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    /* 'model' => $model2, */
                ]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Deletes an existing Horaire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_element)
    {

        $droit_horaire = Utils::have_access('horaire');
        if ($droit_horaire == 1) {
            $model = $this->findModel($key_element);
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
                    Yii::$app->getSession()->setFlash('success', 'Type de congé supprimer avec succès !');
                    // return $this->redirect('all_typeconge');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        }
    }

    /**
     * Finds the Horaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Horaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($key)
    {
        $model = Horaire::find()
            ->where([
                'key_horaire' => $key,
                'statut' => 1
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
