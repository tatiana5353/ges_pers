<?php

namespace backend\controllers;

use backend\models\Horaire;
use Yii;
use backend\models\Presence;
use backend\models\Profil;
use backend\models\User;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;
use yii\db\Expression as DbExpression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresenceController implements the CRUD actions for Presence model.
 */
class PresenceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /*  'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ], */];
    }

    /**
     * Lists all Presence models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit_presence = Utils::have_access('vue_presence');
        if ($droit_presence == 1) {
            $id_profil_employe = User::find()->where(['idprofil' => 2])->all();
            $user = User::findOne(Yii::$app->user->id);
            
                $dataProvider = new ActiveDataProvider([
                    'query' => Presence::find()
                        ->where(['DATE(created_at)' => new DbExpression('CURDATE()')])
                        ->orwhere(['<', 'created_at', date('Y-m-d 00:00:00')]),
                        //->andWhere(['created_by' => Yii::$app->user->id]),
                ]);

                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                ]);
          
        } else {
            $this->redirect('accueil');
        }
    }

    /**
     * Displays a single Presence model.
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
     * Creates a new Presence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $droit_presence = Utils::have_access('presence');
        $horaire = Horaire::find()
            ->where(['statut' => 1])
            ->one();
        if ($droit_presence == 1) {
            $model = new presence();
            $model2 = new LoginForm();
            if ($model2->load(Yii::$app->request->post()) && $model2->login()) {
                $model->created_at = date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->id;
                $model->statut = 1;
                $model->key_presence = Yii::$app->security->generateRandomString(32);
                $model->heure_arrivee = date('H:I:S');
                $model->idhoraire = $horaire->id;
                $model->save();
            }
        }/* else {
            $this->redirect('accueil');
        } */
        /* $model = new Presence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]); */
    }

    /**
     * Updates an existing Presence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Presence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key_presence)
    {
        $model = Horaire::find()
            ->where([
                'key_horaire' => $key_presence,
                'statut' => 1
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
