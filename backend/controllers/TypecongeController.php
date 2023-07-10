<?php

namespace backend\controllers;

use backend\models\Demande;
use Yii;
use backend\models\Typeconge;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypecongeController implements the CRUD actions for Typeconge model.
 */
class TypecongeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                /* 'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ], */]
        );
    }

    /**
     * Lists all Typeconge models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Typeconge::find()->where(['not in', 'statut', 3]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Displays a single Typeconge model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_typeconge)
    {
        $droit = Utils::have_access('conge');
        if ($droit == 1) {
            return $this->render('view', [
                'model' => $this->findModel($key_typeconge),
            ]);
        } else {
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Creates a new Typeconge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {

        $droit_typeconge = Utils::have_access('conge');
        if ($droit_typeconge == 1) {

            $model = new TypeConge();
            if (Yii::$app->request->post()) {

                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->statut = 1;
                    $model->key_typeconge = Yii::$app->security->generateRandomString(32);
                    $model->libelle = trim($model->libelle);
                    $libelle = $model->libelle;
                    $libelleFind = TypeConge::find()
                        ->where([
                            'libelle' => $libelle,
                            'statut' => 1
                        ])->one();
                    if ($libelleFind == null) {
                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_typeconge');
                        } else {

                            $model->loadDefaultValues();
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement veuillez remplir tous les champ obligatoires');
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Type congé déjà existant !');
                        $model->loadDefaultValues();
                    }
                } else {
                    Yii::$app->getSession()->setFlash('info', 'vous n\'avez rien renseigné !');
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
     * Updates an existing Typeconge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($key_typeconge)
    {
        $droit_typeconge = Utils::have_access('conge');
        if ($droit_typeconge == 1) {
            $model2 = new TypeConge();
            $model2->load($this->request->post());
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->statut = 1;
            $model2->key_typeconge = Yii::$app->security->generateRandomString(32);
            $model2->libelle = trim($model2->libelle);
            $model = $this->findModel($key_typeconge);
            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                $id = $model->id;
                $libelle = $model2->libelle;
                $libelleFind = TypeConge::find()
                    ->where(['libelle' => $libelle, 'statut' => 1])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($libelleFind == null) {

                    if ($model2->libelle == trim($model->libelle)) {
                        Yii::$app->getSession()->setFlash('info', 'Vous n\'avez apporter aucune modification !');
                        $model2->loadDefaultValues();
                    } else {
                        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect('all_typeconge');
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'type congé déjà existant !');
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
     * Deletes an existing Typeconge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($key_element)
    {

        $droit_conge = Utils::have_access('conge');
        if ($droit_conge == 1) {
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

    public function actionDeletes($key_typeconge)
    {
        //print('fdhj');die;
        $droit_typeconge = Utils::have_access('conge');
        if ($droit_typeconge == 1) {
            $model = $this->findModel($key_typeconge);
            if ($model != null) {
                $model->statut = 3;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Suppression réussie !');
                    return $this->redirect(['typeconge/index']);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                    return $this->redirect(['typeconge/index']);
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'type congé introuvable !');
                return $this->redirect(['typeconge/index']);
            }
        }
    }



    /**
     * Finds the Typeconge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Typeconge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_typeconge)
    {
        if (($model = Typeconge::find()->where(['key_typeconge' => $key_typeconge])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
