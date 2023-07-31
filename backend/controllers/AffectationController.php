<?php

namespace backend\controllers;

use Yii;
use backend\models\Affectation;
use backend\models\Projet;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AffectationController implements the CRUD actions for Affectation model.
 */
class AffectationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Affectation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Affectation::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Affectation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_affectation)
    {
        {
            $droit_projet = Utils::have_access('projet');
            if ($droit_projet == 1) {
    
    
                $user = User::find()
                    ->where([
    
                        'status' => 10
    
                    ])->all();
                $model = Affectation::find()
                    ->where([
                           'key_affectation' => $key_affectation,
                            'statut' => 0
                    ])->one();
                $dataProvider = new ActiveDataProvider([
                    'query' => Tache::find()
                        ->where(['idaffectation' => $model->id])->andWhere(['<>', 'statut', 3]), 'pagination' => ['pageSize' => 5]
                ]);
                return $this->render('view', [
                    'model' => $model,
                    'user' => $user,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
    }

    public function getTacheRel()
    {
        return $this->hasOne(Tache::className(), ['idaffectation' => 'idaffectation']);
    }

    public function actionSave_affectation()
    {

        if (Yii::$app->request->get()) {
            $all_data = Yii::$app->request->get();
            $iduser = urldecode($all_data['iduser']);
            $all_tache_added = urldecode($all_data['all_tache_added']);

            // affectation
            $affectation = new Affectation();
            $affectation->iduser = $iduser;
            $affectation->created_at = date('Y-m-d H:i:s');
            $affectation->created_by = Yii::$app->user->identity->id;
            $affectation->numero = 'NE-' . date('md') . '-' . rand(11, 99);
            $affectation->statut = 0;
            $affectation->key_affectation = Yii::$app->security->generateRandomString(32);

            if ($affectation->save()) {

                $r = str_replace("###", "", $all_tache_added) . '+';
                $e = explode("*+", $r)[0];

                $all_data = explode("*", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);
                    $suivie = new Suivie();
                    $suivie->commentaire_assigant = $final_selected_value[1];
                    $suivie->date_debut = $final_selected_value[2];
                    $suivie->date_prob = $final_selected_value[3];
                    $suivie->created_at = date('Y-m-d H:i:s');
                    $suivie->created_by = Yii::$app->user->identity->id;
                    $suivie->statut = 2;
                    $suivie->key_suivie = Yii::$app->security->generateRandomString(32);
                    $suivie->save();

                    $tache = Tache::findOne($final_selected_value[0]);
                    $tache->key_tache =  Yii::$app->security->generateRandomString(32);
                    $tache->idaffectation = $affectation->id;
                    $tache->statut = 0;  
                    $tache->updated_by = Yii::$app->user->identity->id;
                    $tache->updated_at = date('Y-m-d H:i:s');
                    $tache->idsuivie = $suivie-> id;
                    $tache->save();

                    if ($i == sizeof($all_data) - 1) {
                        Yii::$app->session->setFlash('success', 'Affectation faite enregistrée avec succès');
                        return 'ok';
                    }
                }
            }
        }
    }

    /**
     * Creates a new Affectation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $affectation = new Affectation();
        $tache = new Tache();
        $suivie = new Suivie();

        if ($affectation->load(Yii::$app->request->post()) && $affectation->save()) {
            return $this->redirect(['view', 'id' => $affectation->id]);
        }

        return $this->render('create', [
            'affectation' => $affectation,
            'tache' => $tache,
            'suivie' => $suivie
        ]);
    }
    public function actionTache_affectation()
    {
        $userAffectationId = Affectation::find()
            ->select(['id'])
            ->where(['iduser' => Yii::$app->user->identity->id]);
        /* $selectTache =  Tache::find()
            ->where(['in', 'idaffectation', $userAffectationId]); */

        $dataProvider = new ActiveDataProvider([
            'query' => Tache::find()
                ->where(['in', 'idaffectation', $userAffectationId])
        ]);

        return $this->render('tache_affectation', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Affectation model.
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
     * Deletes an existing Affectation model.
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
     * Finds the Affectation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Affectation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Affectation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
