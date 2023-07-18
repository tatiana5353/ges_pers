<?php

namespace backend\controllers;

use backend\models\Affectation;
use backend\models\Projet;
use Yii;
use backend\models\Tache;
use backend\models\TypeTache;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TacheController implements the CRUD actions for Tache model.
 */
class TacheController extends Controller
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
     * Lists all Tache models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit = Utils::have_access('tache');
        if ($droit == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Tache::find()->where(['not in', 'statut', 3]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else {
        }
        return $this->redirect('accueil');
    }

    /**
     * Displays a single Tache model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_tache)
    {
        return $this->render('view', [
            'model' => $this->findModel($key_tache),
        ]);
    }

    /**
     * Creates a new Tache model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tache();
        $droit_tache = utils::have_access('tache');
        if ($droit_tache == 1) {
            $typetache = Typetache::find()
                ->where(['statut' => 1])
                ->all();
            $projet = Projet::find()
                ->where(['statut' => 1])
                ->all();
            $affectation = Affectation::find()
                ->where(['statut' => 1])
                ->all();
            if (Yii::$app->request->post()) {
                if ($model->load(Yii::$app->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 0;
                    $model->key_tache = Yii::$app->security->generateRandomString(32);
                    $findprojet = Projet::find()
                        ->where(['statut' => 2])
                        ->one();
                    if ($findprojet == null) {
                        $newprojet = new Projet();
                        $newprojet->created_at = date('Y-m-d H:i:s');
                        $newprojet->created_by = Yii::$app->user->identity->id;
                        $newprojet->statut = 2;
                        $newprojet->key_projet = Yii::$app->security->generateRandomString(32);
                        $newprojet->libelle = "tache individuelle";
                        if ($newprojet->save()) {
                            $id = $newprojet->id;
                            $model->idprojet = $id;
                        }
                    } else {
                        $id = $findprojet->id;
                        $model->idprojet = $id;
                    }
                    $model->designation = trim($model->designation);
                    $designation = $model->designation;
                    $id = $model->idtypetache;
                    $finddesignation = Tache::find()
                        ->where([
                            'designation' => $designation,
                            'idtypetache' => $id,
                            'statut' => 0
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
            return $this->render('create', [
                'model' => $model,
                'typetache' => $typetache,
                'projet' => $projet,
                'affectation' => $affectation
            ]);
        } else {
            $this->redirect('accueil');
        }
    }

    /**
     * Updates an existing Tache model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key_tache)
    {
        $droit = utils::have_access('tache');
        if ($droit == 1) {
            # code...
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tache model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_element)
    {
        $droit_tache = Utils::have_access('tache');
        if ($droit_tache == 1) {
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
                    Yii::$app->getSession()->setFlash('success', 'Tache supprimée avec succès !');
                    return $this->redirect('all_tache');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        }
    }

    /**
     * Finds the Tache model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tache the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_tache)
    {
        $model = Tache::find()
            ->where([
                'key_tache' => $key_tache,
                'statut' => 0
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
