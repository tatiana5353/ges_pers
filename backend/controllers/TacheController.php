<?php

namespace backend\controllers;

use backend\models\Affectation;
use backend\models\Projet;
use backend\models\Suivie;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tache models.
     * @return mixed
     */
    public function actionIndex()
    {
        $droit = Utils::have_access('tache');
        if ($droit == 1) {
            $findprojet = Projet::find()->where(['libelle' => 'tache individuelle'])->one();
            $dataProvider = new ActiveDataProvider([
                'query' => Tache::find()->where(['not in', 'statut', 3])
                    ->andWhere(['idprojet' => ($findprojet !== null) ? $findprojet->id : null])
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
        }
        return $this->redirect('accueil');
    }

    public function actionValider($key_element)
    {
        $droit_demande = Utils::have_access('demande');
        if ($droit_demande == 1) {
            $model = Tache::find()
                ->where([
                    'key_tache' => $key_element,
                    'statut' => 0
                ])->one();

            if ($model !== null) {
                $idtache = $model->id;

                $suivie = Suivie::find()
                    ->where(['idtache' => $idtache])
                    ->one();

                if ($suivie !== null) {
                    $model->statut = 1;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->updated_at = date('Y-m-d H:i:s');
                    $suivie->statut = 1;

                    if ($model->save() && $suivie->save()) {
                        Yii::$app->getSession()->setFlash('success', 'Tâche validée avec succès !');
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Erreur lors de la validation !');
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Suivie introuvable pour cette tâche !');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Tâche introuvable ou déjà validée !');
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Vous n\'avez pas le droit de valider la tâche !');
        }
    }


    /**
     * Displays a single Tache model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($key_tache)
    {
        $tache = Tache::find()
            ->where(['key_tache' => $key_tache])
            ->andWhere(['in', 'statut', [0, 2, 1]])
            ->one();
        $tache1 = Tache::find()
            ->where(['key_tache' => $key_tache])
            ->andWhere(['in', 'statut', [1]])
            ->one();

        if ($tache !== null) {
            $idtache = $tache->id;

            $suivie = Suivie::find()
                ->where(['idtache' => $idtache])
                ->one();

            if ($suivie !== null && ($suivie->statut == 0 || $tache->statut == 2)) {
                return $this->render('view_2', [
                    'model' => $tache,
                    'suivie' => $suivie,
                ]);
            } else {
                return $this->render('view', [
                    'model' => $tache,
                ]);
            }
        } else {
            // Gérer le cas où la tâche n'est pas trouvée
            throw new \yii\web\NotFoundHttpException('La tâche demandée n\'existe pas.');
        }
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
                        ->where(['libelle' => "tache individuelle"])
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
            return $this->render('create', [
                'model' => $model,
                'typetache' => $typetache,
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
            $typetache = Typetache::find()
                ->where(['statut' => 1])
                ->all();
            $model = $this->findModel($key_tache);
            //  if (Yii::$app->request->post()){
            $model2 = new Tache();
            if ($model2->load(Yii::$app->request->post())) {
                $model2->designation = trim(preg_replace('/\s+/', ' ', $model2->designation));

                if ($model != null) {
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->updated_at = date('Y-m-d H:i:s');

                    $id = $model->id;
                    $designation = $model2->designation;
                    $libelleFind = Tache::find()
                        ->where(['or', ['designation' => $designation, 'statut' => 0], ['designation' => $designation, 'statut' => 2]])
                        ->andWhere(['<>', 'id', $id])->all();
                    if ($libelleFind == null) {

                        if ($model2->designation == trim(preg_replace('/\s+/', ' ', $model->designation))) {
                            Yii::$app->getSession()->setFlash('info', 'Vous n\'avez apporter aucune modification !');
                            $model2->loadDefaultValues();
                        } else {
                            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                                Yii::$app->getSession()->setFlash('success', 'Enregistrement réussie !');
                                return $this->redirect('all_tache');
                            }
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Tache déjà existante !');
                        $model2->loadDefaultValues();
                    }
                } else {
                }
            }
            /* } */
            return $this->render('update', [
                'model' => $model,
                'typetache' => $typetache
            ]);
        } else {
            $this->redirect('accueil');
        }

        $model = $this->findModel($key_tache);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
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
                    //return $this->redirect('all_tache');
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
                'or',
                [
                    'key_tache' => $key_tache,
                    'statut' => 0
                ],
                [
                    'key_tache' => $key_tache,
                    'statut' => 2
                ],
            ])->one();

        if ($model != null) {
            return $model;
        } else {
            return null;
        }
    }
}
