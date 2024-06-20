<?php

namespace backend\controllers;

use backend\models\Affectation;
use backend\models\Profil;
use backend\models\Suivie;
use backend\models\Tache;
use Yii;
use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    /* public function actionGet_user_infos()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        $idUser = Yii::$app->request->get('idUser');
        $status = '001';

        $user = user::find()->where(['status' => 10, 'id' => $idUser])->one();

        if ($user != null) {
            $status = '000';
        }

        $responseData = [
            'idUser' => $user->id,
            'user' => $user,
        ];
        return $responseData;
    } */

    

    public function actionIndex()
    {


        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => User::find()->where(['not in', 'status', 30]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreates()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {
            $profil = Profil::find()
                ->where(['statut' => 1])
                ->all();
            $model = new User();
            if (Yii::$app->request->post()) {
                if ($model->load($this->request->post())) {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->status = 10;
                    $model->auth_key = Yii::$app->security->generateRandomString(32);
                    $model->password_hash = Yii::$app->security->generatePasswordHash(32);
                    $model->role = 10;
                    $model->nom = trim($model->nom);
                    $model->prenoms = trim($model->prenoms);
                    $model->email = trim($model->email);
                    $date_naiss = $model->date_naiss;
                    $date_create = $model->created_at;
                    $prenoms = $model->prenoms;
                    $nom = $model->nom;
                    $numeroFind = User::find()
                        ->where([
                            'nom' => $nom,
                            'date_naiss' => $date_naiss,
                            'prenoms' => $prenoms,
                            'status' => 10
                        ])->one();
                    $username = $model->username;
                    $findusername = User::find()
                        ->where([
                            'username' => $username,
                            'status' => 10
                        ])->one();
                    $email = $model->email;
                    $emailfnd = User::find()
                        ->where([
                            'email' => $email,
                            'status' => 10
                        ])->one();

                    if (strtotime($date_naiss) >= strtotime($date_create)) {
                        Yii::$app->getSession()->setFlash('error', 'Date de naissance non valide !');
                        $model->loadDefaultValues();
                    }

                    if ($findusername != null) {
                        Yii::$app->getSession()->setFlash('error', 'Nom utilisateur invalide!');
                        $model->loadDefaultValues();
                    }

                    if ($emailfnd != null) {
                        Yii::$app->getSession()->setFlash('error', 'adresse email invalide!');
                        $model->loadDefaultValues();
                    }

                    if ($numeroFind == null) {

                        if ($model->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                            return $this->redirect(['/all_user']);
                        } else {
                            Yii::$app->getSession()->setFlash('error', 'Echec d\'enregistrement, veuillez remplir tous les champs obligatoires !');
                            $model->loadDefaultValues();
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'utilisateur déjà existant !');
                    $model->loadDefaultValues();
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'profil' => $profil,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdates($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($auth_key)
    {
        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {

            $profil = Profil::find()
                ->where(['statut' => 1])
                ->all();
            $model2 = new User();
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->status = 10;
            $model2->auth_key = Yii::$app->security->generateRandomString(32);
            $model2->password_hash = Yii::$app->security->generatePasswordHash(32);
            $model2->role = 10;
            $model2->nom = trim($model2->nom);
            $model2->prenoms = trim($model2->prenoms);
            $model = $this->findModel($auth_key);
            if ($model != null) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');
                $model->date_naiss = date('Y-m-d', strtotime($model->date_naiss));
                $id = $model->id;
                $nom = $model2->nom;
                $prenoms = $model2->prenoms;
                $utilisateurFind = user::find()
                    ->where(['prenoms' => $prenoms, 'nom' => $nom, 'status' => 10])
                    ->andWhere(['<>', 'id', $id])->all();

                if ($utilisateurFind == null) {
                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Modification réussie !');
                        return $this->redirect('all_user');
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Utilisateur déjà existant !');
                }
            } else {
                return $this->redirect(['/all_user']);
            }

            return $this->render('update', [
                'model' => $model,
                'profil' => $profil,

            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletes($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDelete($key_element)
    {
        $droit_user = Utils::have_access('user');
        if ($droit_user == 1) {
            $model = $this->findModel($key_element);
            if ($model != null) {
                $model->status = 30;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Suppression réussie !');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Erreur lors de la suppression !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Utilisateur introuvable !');
            }
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($auth_key)
    {
        $model = User::find()
            ->where([
                'auth_key' => $auth_key,
                'status' => 10
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
