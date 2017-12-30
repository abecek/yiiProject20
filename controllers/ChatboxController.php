<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-12-28
 * Time: 01:54
 */
namespace app\controllers;

use Yii;
use app\components\AccessRule;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ChatboxController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                /*
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('You are not allowed to access this page.');
                },
                */
                //'denyCallback' => null, //Dalej przekieruje na login page
                'only' => ['logout', 'index', 'test'],
                'rules' => [
                    // Access to actions below only for authenticated - @
                    [
                        'actions' => ['test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // Access to actions below for everyone
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ]
                    // Access to rest actions DENIED or maybe not? todo: check latter
                    // LINKS
                    // https://yii2-framework.readthedocs.io/en/stable/guide/security-authorization/
                    // http://www.yiiframework.com/doc-2.0/guide-security-authorization.html#role-based-access-control-rbac
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

    /**
     * Displays chatbox.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('chatbox');
    }

    public function actionTest(){
        return $this->render('testChatbox');
    }
}