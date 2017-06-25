<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class IndexController extends Controller
{


	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * @var string
     */
    public $layout = 'main1';

    public function actionIndex()
    {
        // phpinfo();
        return $this->render('index');
    }
    
}
