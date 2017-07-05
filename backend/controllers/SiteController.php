<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use common\models\Mailhistory;

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
                        'actions' => ['logout', 'index', 'fetch', 'test', 'addhistory', 'removehistory'],
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

    public function actionFetch()
    {
        if (Yii::$app->request->isAjax) {
            $users = \common\models\User::find()->orderBy('username asc')->all();

            $schedules = \common\models\Schedule::find()->all();

            $templates = \common\models\Mailtemplate::find()->all();

            $sents = \common\models\Mailhistory::find()->all();

            $limitsents = \common\models\Mailhistory::find()->orderBy('create_at desc')->limit(10)->all();
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return array(
                'users' => $users,
                'schedules' => $schedules,
                'templates' => $templates,
                'sents' => $sents,
                'limitsents' => $limitsents,
            );
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {

        if (Yii::$app->request->isAjax) {
            $mailhistories = Mailhistory::find()->orderBy('create_at desc')->all();
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return $mailhistories;
        } else {
            $model = new Mailhistory();
            return $this->render('test', ['model'=>$model]);
        }
        
    }

    public function actionAddhistory()
    {

        if (Yii::$app->request->isPost) {
            $model = new Mailhistory();
            $model->type = 1;
            $model->attachements = '';
            $model->operator = 'itadmin';
            $model->info = 'Success';
            $model->create_at = date('Y-m-d H:i:s'); 
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
            // $model = new Mailhistory();
            // $model->enquiry_id = 0;
            // $model->customer_id = 0;
            // $model->type = 1;
            // $model->mail_from = 'sydney@dreamlife.net.au';
            // $model->mail_to = '1483136259@qq.com';
            // $model->subject = Yii::$app->request->post('subject');
            // $model->content = Yii::$app->request->post('content');
            // $model->attachements = '';
            // $model->operator = 'itadmin';
            // $model->info = 'Success';
            // $model->create_at = date('Y-m-d H:i:s');

                $data = Mailhistory::find()->orderBy('create_at desc')->all();
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return ['success' => '添加成功', 'status' => true, 'data' => $data];
            } else {
                return ['error' => '添加失败'];
            }
            // Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            // return $mailhistories;
        }
        
    }

    public function actionRemovehistory()
    {

        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');

            Mailhistory::findOne($id)->delete();

            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

            $data = Mailhistory::find()->orderBy('create_at desc')->all();

            return ['success' => '删除成功', 'status' => true, 'data' => $data];
            
            // $model = new Mailhistory();
            // $model->enquiry_id = 0;
            // $model->customer_id = 0;
            // $model->type = 1;
            // $model->mail_from = 'sydney@dreamlife.net.au';
            // $model->mail_to = '1483136259@qq.com';
            // $model->subject = Yii::$app->request->post('subject');
            // $model->content = Yii::$app->request->post('content');
            // $model->attachements = '';
            // $model->operator = 'itadmin';
            // $model->info = 'Success';
            // $model->create_at = date('Y-m-d H:i:s');
        }
        
    }


    public function actionLogin()
    {
        $this->layout = 'login.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
}
