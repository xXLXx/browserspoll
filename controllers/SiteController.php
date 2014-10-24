<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\VoteForm;
use app\models\Browser;
use app\models\Poll;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $browserDataProvider = new \yii\data\ActiveDataProvider([
            'query'         => Browser::find()->with('votes'),
            'pagination'    => [
                'pageSize'      => 1000,
            ],
        ]);

        $totalVotesCount = Poll::find()->count();

        $votesDataProvider = new \yii\data\ActiveDataProvider([
            'query'         => Poll::find()->orderBy(['browser' => SORT_ASC, 'updated_at' => SORT_ASC]),
            'pagination'    => [
                'pageSize'      => 10,
            ],
        ]);

        return $this->render('index', compact('browserDataProvider', 'totalVotesCount', 'votesDataProvider'));
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionVote()
    {
        $model = new VoteForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            $browsers = Browser::find()->all();

            return $this->render('vote', compact('model', 'browsers'));
        }
    }
}
