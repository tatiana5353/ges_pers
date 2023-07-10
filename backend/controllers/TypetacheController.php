<?php

namespace backend\controllers;

use Yii;
use backend\models\Typetache;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypetacheController implements the CRUD actions for Typetache model.
 */
class TypetacheController extends Controller
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
            ], */
        ];
    }

    /**
     * Lists all Typetache models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit = Utils::have_access('typetache');
        if ($droit == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Typetache::find()->where(['not in', 'statut', 3]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Displays a single Typetache model.
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
     * Creates a new Typetache model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $droit_typetache = Utils::have_access('typetache');
        if ($droit_typetache == 1) {

            $model = new Typetache();
            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_typetache = Yii::$app->security->generateRandomString(32);
                    $model->libelle = trim($model->libelle);
                    $libelle = $model->libelle;
                    $libelleFind = Typetache::find()
                        ->where([
                            'libelle' => $libelle,
                            'statut' => 1
                        ])->one();
                    if ($libelleFind == null) {
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_typetache');
                        } else {

                            $model->loadDefaultValues();
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement veuillez remplir tous les champ obligatoires');
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Type de tache déjà existant !');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'vous n\'avez rien renseigné !');
                }
            } else {
                //Yii::$app->getSession()->setFlash('info', 'veullez renseigner le formulaire');
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,

            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Updates an existing Typetache model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key_typetache)
    {
        $droit_typetache = Utils::have_access('conge');
        if ($droit_typetache == 1) {
            $model2 = new Typetache();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_typetache = Yii::$app->security->generateRandomString(32);
            $model2->libelle = trim($model2->libelle);
            $model = $this->findModel($key_typetache);
            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = Typetache::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {

                    if ($model2->libelle == trim($model->libelle)) {
                        Yii::$app->getSession()->setFlash('info', 'Vous n\'avez apporter aucune modification !');
                        $model2->loadDefaultValues();
                    } else {
                        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_typetache');
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Type de tache déjà existant !');
                    $model2->loadDefaultValues();
                }
            } else {
                return $this->redirect('accueil');
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
     * Deletes an existing Typetache model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_element)
    {

        $droit_typetache = Utils::have_access('typetache');
        if ($droit_typetache == 1) {
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
                        Yii::$app->getSession()->setFlash('success', 'Type de tache supprimer avec succès !');
                       // return $this->redirect('all_typeconge');
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                    }
                //}
            } else Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
        } 
    }

    /**
     * Finds the Typetache model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Typetache the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_typetache)
    {
        {
            $model = Typetache::find()
                ->where([
                    'key_typetache' => $key_typetache,
                    'statut' => 1
                ])->one();
    
            if ($model != null) {
                return $model;
            } else {
                return null;
            }
        }
    }
}
