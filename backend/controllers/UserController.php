<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use backend\models\UserUpdateForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'reload' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // print_r($dataProvider);
        // print_r($searchModel);
        // return false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
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
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', '用户创建成功');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', '用户创建失败');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // public function actionSignup()
    // {
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post())) {
    //         if ($user = $model->signup()) {
    //             if (Yii::$app->getUser()->login($user)) {
    //                 return $this->goHome();
    //             }
    //         }
    //     }

    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $uform = new UserUpdateForm($id);

        // return;

        if ($uform->load(Yii::$app->request->post())) {

            if ($user = $uform->updateUser($id)) {
               Yii::$app->session->setFlash('success', '用户更新成功');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', '用户更新失败');
                return $this->render('update', [
                    'model' => $model,
                    'uform' => $uform
                ]);
            }
            
        } else {
            $uform->status = $model->status;
            $uform->type = $model->type;

            return $this->render('update', [
                'model' => $model,
                'uform' => $uform
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // print_r($dataProvider);
        // print_r($searchModel);
        // return false;

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidateForm ($id = null) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UserUpdateForm($id);
        $model->load(Yii::$app->request->post());  

        return \yii\widgets\ActiveForm::validate($model);  
    }


    public function actionReload()
    {
        //$this->findModel($id)->delete();

        $sql = "select account, password, email, type from ns_v1user where ((type='freelance' and (pEnabled = 1 or vEnabled = 1)) or (type = 'Admin' or type = 'Manager' or type = 'Manager Assistant')) order by account asc";
        $users = Yii::$app->db1->createCommand($sql)->queryAll();

        foreach ($users as $key => $value) {
            $model = new User(); 
            $user = $model->findByUsername($value['account']);
            if (!$user) {
                $model->username = $value['account'];
                $model->email = $value['email'];
                $model->type = $value['type'];
                $model->setPassword($value['password']);
                $model->generateAuthKey();
                $model->save();
            } else {
               $user->email = $value['email'];
                $user->type = $value['type'];
                $user->setPassword($value['password']);
                $user->generateAuthKey();
                $user->save(); 
            }

            
        }

         Yii::$app->session->setFlash('success', 'DMS用户更新成功');
         return $this->redirect(['index']);

    }

}
