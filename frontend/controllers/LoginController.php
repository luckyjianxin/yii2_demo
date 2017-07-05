<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use frontend\controllers\BaseController;

/**
 * 后台登录控制器
 * @author longfei <phphome@qq.com>
 */
class LoginController extends BaseController
{

    public $layout = false;

    public $enableCsrfValidation=false;

    public $defaultAction = 'login';

    /**
     * ---------------------------------------
     * 行为控制
     * ---------------------------------------
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'logout'],
                        'allow' => true
                    ]
                ],
            ],
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

    /**
     * ---------------------------------------
     * 登录页
     * ---------------------------------------
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome(); // 默认 index/index
        }

        $model = new LoginForm();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
               $mode = $model->login();
               //echo $mode;
               if ($mode === 1) {
                 Yii::$app->session->setFlash('error', 'Incorrect Customer NO.');
               } else if ($mode === 2) {
                 Yii::$app->session->setFlash('error', 'Incorrect Password.');
               } else if ($mode === 11) {
                 Yii::$app->session->setFlash('error', 'This customer\'s order is not exists.');
               }
               return 1;
            }
        }else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ---------------------------------------
     * 注销页
     * ---------------------------------------
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();


        unset(Yii::$app->session['_customer']);
        $cookie = Yii::$app->request->cookies->get('_customer');
        Yii::$app->response->getCookies()->remove($cookie);

        return $this->redirect(Url::toRoute('/login/login'));
        // return $this->goHome();
    }
}
