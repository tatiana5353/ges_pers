<?php

namespace backend\controllers;

use backend\models\Horaire;
use backend\models\Presence;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use DateTime;
use DateTimeZone;
use yii\filters\VerbFilter;
use yii\helpers\FormatConverter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /* 'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ], */
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'main_login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            /* $droit_presence = Utils::have_access('presence');
            $horaire = Horaire::find()
                ->where(['statut' => 1])
                ->one();

            $model2 = new Presence();
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->created_by = Yii::$app->user->identity->id;
            $model2->key_presence = Yii::$app->security->generateRandomString(32);
            $model2->heure_arrivee = date('Y-m-d H:i:s');
            $harrive = $model2->heure_arrivee;
            $formattedDateTime = new DateTime(Yii::$app->formatter->asDatetime($harrive, "php:H:i:s"));
            $formattedDateTime->setTimezone(new DateTimeZone(Yii::$app->timeZone));
            //$formattedDateTime = Yii::$app->formatter->asDatetime($harrive,"php:H:i:s");
            $model2->idhoraire = $horaire->id;
            $hnor_arrivee = new DateTime($horaire->heure_arrivee);
            $hnor_arrivee->setTimezone(new DateTimeZone(Yii::$app->timeZone));
            if ($formattedDateTime <= $hnor_arrivee) {
                //print('azesdxxx');die;
                $model2->statut = 1; // Présent et à l'heure
            } else {
                $model2->statut = 2; // En retard
                $diff = $formattedDateTime->diff($hnor_arrivee);
                if ($droit_presence !== 1) {
                    Yii::$app->getSession()->setFlash('error', 'Vous êtes en retard de : ' . $diff->format('%H:%I:%S'));
                }
            }

            $model2->save(); */
            /* if ($model2->save()) {
                $hnor_arrivee = $horaire->heure_arrivee;
               if ($formattedDateTime > $hnor_arrivee) {
                Yii::$app->getSession()->setFlash('error', 'Vous etes en retard de :');
               }
            } */

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        $droit_presence = Utils::have_access('presence');
        /* if ($droit_presence !== 1) {
            $presence = Presence::find()
            ->where(['created_by' => Yii::$app->user->identity->id])
            ->andWhere(['OR', ['statut' => 1], ['statut' => 2]])
            ->one();
        $presence->updated_at = date('Y-m-d H:i:s');
        $presence->updated_by = Yii::$app->user->identity->id;
        $presence->heure_depart = date('Y-m-d H:i:s');
        $presence->statut = 3;
        $presence->save();
        } */
        
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
