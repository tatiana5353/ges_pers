<?php

namespace backend\controllers;

use Yii;
use backend\models\Affectation;
use backend\models\Projet;
use backend\models\Suivie;
use backend\models\Tache;
use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
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
        $droit = Utils::have_access('consulter_affectation');
        if ($droit == 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => Affectation::find(), 'pagination' => ['pageSize' => 10]
            ]);

            $newdataProvider = new ActiveDataProvider([
                'query' => $dataProvider->query,
                'pagination' => $dataProvider->pagination,
            ]);

            $newdataProvider->query->orderBy([
                new \yii\db\Expression('CASE WHEN statut = 1 THEN 2 WHEN statut = 0 THEN 0 ELSE 1 END'), // Met les modèles avec statut 1 en dernière position
                // Ajoutez d'autres critères de tri si nécessaire, par exemple 'autre_colonne' => SORT_ASC,
            ]);

            return $this->render('index', [
                'dataProvider' => $newdataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
        }
    }

    /**
     * Displays a single Affectation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_affectation)
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




    public function actionFairetache($key_tache)
    {
        $model = new Suivie();
        if (Yii::$app->request->post()) {


            if ($model->load($this->request->post())) {
                $tache = Tache::find()
                    ->where([
                        'key_tache' => $key_tache,
                        'statut' => 0
                    ])->one();
                $id = $tache->id;
                $affectation = Affectation::find()
                    ->where(['id' => $tache->idaffectation])
                    ->one();
                // $idsuivie = $tache->idsuivie;
                $suivie = Suivie::find()
                    ->where([
                        'idtache' => $id,
                        'statut' => 2
                    ])->one();
                if ($suivie != null) {
                    $suivie->updated_at = date('Y-m-d H:i:s');
                    $suivie->updated_by = Yii::$app->user->identity->id;
                    $suivie->statut = 0;
                    $suivie->commentaire_effectuant = $model->commentaire_effectuant;
                    if ($suivie->save()) {
                        $affectation->statut = 0;
                        $affectation->updated_by = Yii::$app->user->identity->id;
                        $affectation->updated_at =  date('Y-m-d H:i:s');
                        $affectation->Save();
                        Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                        return $this->redirect('tache_affectation');
                    } else {
                        Yii::$app->getSession()->setFlash('erreur', 'erreur lors de l\'enregistrement!');
                        $suivie->loadDefaultValues();
                    }
                }
            } else {
                Yii::$app->getSession()->setFlash('info', 'vous n\'avez rien renseigné !');
            }
        } else {
            //Yii::$app->getSession()->setFlash('info', 'veullez renseigner le formulaire');
            $model->loadDefaultValues();
        }

        return $this->render('faire_tache', [
            'model' => $model,

        ]);
    }

    public function actionCochertache($key_tache, $commentaire)
    {
        //die('Atteint ici');
        //Yii::$app->getSession()->setFlash('erreur', 'erreur lors de l\'enregistrement!');die;
        $tache = Tache::find()
            ->where([
                'key_tache' => $key_tache,
            ])->one();
        // $model = new Suivie();
        $id = $tache->id;
        $affectation = Affectation::find()
            ->where(['id' => $tache->idaffectation])
            ->one();
        // $idsuivie = $tache->idsuivie;
        $suivie = Suivie::find()
            ->where([
                'idtache' => $id,
                'statut' => 2
            ])->one();
        if ($suivie != null) {
            $suivie->updated_at = date('Y-m-d H:i:s');
            $suivie->updated_by = Yii::$app->user->identity->id;
            $suivie->statut = 0;
            $suivie->commentaire_effectuant = $commentaire;
            if ($suivie->save()) {
                $affectation->statut = 0;
                $tache->updated_by = Yii::$app->user->identity->id;
                $tache->updated_at =  date('Y-m-d H:i:s');
                $tache->save();
                $affectation->updated_by = Yii::$app->user->identity->id;
                $affectation->updated_at =  date('Y-m-d H:i:s');
                $affectation->save();
                Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
            } else {
                Yii::$app->getSession()->setFlash('erreur', 'erreur lors de l\'enregistrement!');
            }
        } else {
            Yii::$app->getSession()->setFlash('erreur', 'erreur lors de l\'enregistrement!');
        }
    }


    public function actionVue_realisation()
    {
        $droit = Utils::have_access('consulter_affectation');
        if ($droit == 1) {
            $idtache = Suivie::find()
                ->select(['idtache'])
                ->where(['statut' => 0]);

            $dataProvider = new ActiveDataProvider([
                'query' => Tache::find()
                    ->where(['in', 'id', $idtache])
            ]);



            return $this->render('vue_realisation', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect('accueil');
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
            $affectation->statut = 2;
            $affectation->key_affectation = Yii::$app->security->generateRandomString(32);

            if ($affectation->save()) {

                $r = str_replace("###", "", $all_tache_added) . '+';
                $e = explode("*+", $r)[0];

                $all_data = explode("*", $e);
                for ($i = 0; $i < sizeof($all_data); $i++) {
                    $final_selected_value = explode(";;;", $all_data[$i]);

                    $tache = Tache::findOne($final_selected_value[0]);
                    $tache->idaffectation = $affectation->id;
                    $tache->statut = 0;
                    $tache->save();

                    $suivie = new Suivie();
                    $suivie->commentaire_assigant = $final_selected_value[1];
                    $suivie->date_debut = $final_selected_value[2];
                    $suivie->date_prob = $final_selected_value[3];
                    $suivie->created_at = date('Y-m-d H:i:s');
                    $suivie->created_by = Yii::$app->user->identity->id;
                    $suivie->statut = 2;
                    $suivie->idtache = $tache->id;
                    $suivie->key_suivie = Yii::$app->security->generateRandomString(32);
                    $suivie->save();
                   /*  $nbre = Tache::find()
                        ->where([
                            'idprojet' => $tache->idprojet,
                            'statut' => 0
                        ])
                        ->count(); */
                    $projet = Projet::find()
                        ->where([
                            'id' => $tache->idprojet,

                        ])
                        ->one();
                    $projet->statut = 0;
                    $projet->updated_by = Yii::$app->user->identity->id;
                    $projet->updated_at = date('Y-m-d H:i:s');
                    $projet->save();
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
        //Yii::$app->getSession()->setFlash('success', 'Alert marche top top !');
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

    public function actionCreatetache($idaffectation, $designation, $datedebut, $dateprob, $commentaire)
    {
        // Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
        // print('rrr');die;
        $droit = utils::have_access('tache');
        if ($droit == 1) {
            $tache = Tache::find()
                ->where(['id' => $designation, /* 'idaffectation' => $idAffectation */])
                ->andWhere(['not in', 'statut', 3])
                ->one();
            if ($tache != null) {
                // $tache = new Tache();
                //$tache->designation = $designation;
                $tache->idaffectation = $idaffectation;
                //$tache->idprojet = $idprojet;
                $tache->updated_by = Yii::$app->user->identity->id;
                $tache->statut = 0;
                // $tache->created_at = date('Y-m-d H:i:s');
                //$tache->key_tache = Yii::$app->security->generateRandomString(32);
                $tache->save();
                $suivie = new Suivie();
                $suivie->created_by = Yii::$app->user->identity->id;
                $suivie->statut = 2;
                $suivie->created_at = date('Y-m-d H:i:s');
                $suivie->key_suivie = Yii::$app->security->generateRandomString(32);
                $suivie->idtache = $tache->id;
                $suivie->commentaire_assigant = $commentaire;
                $suivie->date_debut = $datedebut;
                $suivie->date_prob = $dateprob;

                if ($suivie->save()) {
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

    public function actionTache_affectation()
    {
        $userAffectationId = Affectation::find()
            ->select(['id'])
            ->where(['iduser' => Yii::$app->user->identity->id]);
        /* $selectTache =  Tache::find()
            ->where(['in', 'idaffectation', $userAffectationId]); */
        /* $idtache = Suivie::find()
            ->select(['idtache']); */


        $dataProvider = new ActiveDataProvider([
            'query' => Tache::find()
                ->where(['in', 'idaffectation', $userAffectationId]), 'pagination' => ['pageSize' => 5]
        ]);

        $newdataProvider = new ActiveDataProvider([
            'query' => $dataProvider->query,
        ]);

        $newdataProvider->query->orderBy([
            new \yii\db\Expression('CASE WHEN statut = 1 THEN 2 WHEN statut = 0 THEN 0 ELSE 1 END'), // Met les modèles avec statut 1 en dernière position
            // Ajoutez d'autres critères de tri si nécessaire, par exemple 'autre_colonne' => SORT_ASC,
        ]);

        return $this->render('tache_affectation', [
            'dataProvider' => $newdataProvider,
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
