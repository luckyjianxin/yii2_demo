<?php

namespace backend\controllers;

use Yii;
use common\models\Officecontact;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficecontactController implements the CRUD actions for Officecontact model.
 */
class OfficecontactController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Officecontact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Officecontact::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Officecontact model.
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
     * Creates a new Officecontact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Officecontact();
        $branchs = [
            'AKL' => 'Auckland',
            'BNE' => 'Brisbane',
            'MEL' => 'Melbourne',
            'NYC' => 'NewYork',
            'ONT' => 'OnThree',
            'PHE' => 'Phenomena',
            'SYD' => 'Sydney',
            'XTRAO' => 'Xtraordinary'
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'branchs' => $branchs
            ]);
        }
    }

    /**
     * Updates an existing Officecontact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $branchs = [
            'AKL' => 'Auckland',
            'BNE' => 'Brisbane',
            'MEL' => 'Melbourne',
            'NYC' => 'NewYork',
            'ONT' => 'OnThree',
            'PHE' => 'Phenomena',
            'SYD' => 'Sydney',
            'XTRAO' => 'Xtraordinary'
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'branchs' => $branchs
            ]);
        }
    }

    /**
     * Deletes an existing Officecontact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Officecontact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Officecontact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Officecontact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
