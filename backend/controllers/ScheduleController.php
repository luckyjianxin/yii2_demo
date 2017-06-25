<?php

namespace backend\controllers;

use Yii;
use common\models\Schedule;
use common\models\ScheduleScene;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;

use kartik\grid\EditableColumnAction;

/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
                    'delete' => ['POST']
                ],
            ],
        ];
    }

    public function actions() {
         return ArrayHelper::merge(parent::actions(), [
           'editschedule' => [                                       // identifier for your editable column action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => Schedule::className(),                // the model for the record being edited
               'outputValue' => function ($model, $attribute, $key, $index) {
                     return $model->$attribute;      // return any custom output value if desired
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error to return after model save
               },
               'showModelErrors' => true,                        // show model validation errors after save
               'errorOptions' => ['header' => '']                // error summary HTML options
               // 'postOnly' => true,
               // 'ajaxOnly' => true,
               // 'findModel' => function($id, $action) {},
               // 'checkAccess' => function($action, $model) {}
           ]
       ]);
    }

    /**
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Schedule::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schedule();

        // $model->is_default = 0;

        if ($model->load(Yii::$app->request->post()) ) {

            if ($model->is_default == 1) {
                $model->updateAll(array('is_default'=>0),'is_default=:default',array(':default'=>1));
                // Schedule::updateAllDefault();
            }

            $result = $model->save();
            if ($result) {
                Yii::$app->session->setFlash('success', '创建成功');
            }
            return $this->redirect(['index']); 
            //return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Schedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', '删除成功');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDefault()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');   
        $model = $this->findModel($id);

        if ($model->is_default == 0) {
            $model->updateAll(array('is_default'=>0),'is_default=:default',array(':default'=>1));
            $model->is_default = 1;
            $model->save();

            return ['msg' => '设置成功'
                    ];            
            //Yii::$app->session->setFlash('success', '设置成功');
        } else {
            return ['status'=>false,
                    'msg' => '该项已经设置默认'
                    ];            
            //Yii::$app->session->setFlash('error', '该项已经设置默认');

        }            

        //return $this->redirect(['index']);
    }

    public function actionAddscene($id)
    {
        $model = $this->findModel($id);

        // $response=Yii::$app->response;  
        // $response->format=Response::FORMAT_JSON;  

        $scenes = ScheduleScene::find()->where(['schedule_id' => $id])
                                       ->orderby('order', 'asc')
                                       ->asArray()->all();

        // $model->is_default = 0;

        if ($model->load(Yii::$app->request->post()) ) {

            if ($model->is_default == 1) {
                $model->updateAll(array('is_default'=>0),'is_default=:default',array(':default'=>1));
                // Schedule::updateAllDefault();
            }

            $result = $model->save();
            if ($result) {
                Yii::$app->session->setFlash('success', '创建成功');
            }
            return $this->redirect(['index']); 
            //return $this->redirect(['index']);
        } else {
            return $this->render('addscene', [
                'model' => $model,
                'scenes' => $scenes
            ]);
        }
    }

    public function actionUpdatetravel()
    {
        if (Yii::$app->request->isAjax) {
          $data = Yii::$app->request->post();
          $model = ScheduleScene::findOne($data['id']);
          $attribute = $data['attribute'];
          $value = $data['value'];
          $model->$attribute = $value;
          $model->save();

          \Yii::$app->response->format = Response::FORMAT_JSON;
          return ['msg'=> '设置成功']; 
        }  else {

        }

    }

    public function actionChangesort()
    {
        if (Yii::$app->request->isAjax) {
          $ids = Yii::$app->request->post('ids');
          $id_array = explode(',', $ids);
          $table = ScheduleScene::tableName();

          $sql = "UPDATE `$table` SET `order` = CASE `id` ";
            foreach ($id_array as $key => $value) {
                $sql .= sprintf("WHEN %d THEN %d ", $value, $key);
            }
            $sql .= "END WHERE `id` IN ($ids)";

          Yii::$app->db->createCommand($sql)->execute();

          // $model = ScheduleScene::findOne($data['id']);
          // $attribute = $data['attribute'];
          // $value = $data['value'];
          // $model->$attribute = $value;
          // $model->save();

          Yii::$app->response->format = Response::FORMAT_JSON;
          return (['msg' => '排序成功']);  
        }  else {

        }

    }
    public function actionScenedelete()
    {
        if (Yii::$app->request->isAjax) {
          $id = Yii::$app->request->post('id');
          $show_travel = Yii::$app->request->post('show_traveltime');
          Yii::$app->response->format = Response::FORMAT_JSON;
          $model = ScheduleScene::findOne($id);
          if ($show_travel == 0) {
            $model->show_traveltime = 0;
            $model->save();
          } else {
            $model->delete();
          }

          return (['msg' => '删除成功']);  
        }  else {

        }

    }

    public function actionSceneadd()
    {
        if (Yii::$app->request->isAjax) {
           
          $data = Yii::$app->request->post();
          Yii::$app->response->format = Response::FORMAT_JSON;
          $model = new ScheduleScene();


          $last = $model->find()
                              ->select(['order'])
                              ->where(['schedule_id' => $data['schedule_id']])
                              ->orderBy('order DESC')
                              ->limit(1)
                              ->one();
          $data['order'] = (empty($last)) ? 0 : $last['order'] +１;


          foreach ($data as $key => $value) {
              $model->$key = $value;
          }

           
            if ($model->save()) {
               return (['msg' => (($data['type'] == 0) ? 'Scene' : 'Travel time') .  ' 添加成功']); 

            } else {
                return (['status' => 'false', 'msg' => (($data['type'] == 0) ? 'Scene' : 'Travel time') .  ' 添加失败']); 
            }
           
           
        }  else {

        }

    }
}
