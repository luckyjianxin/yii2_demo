<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\controllers\BaseController;
use yii\web\Response;

class IndexController extends BaseController
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
        $session = Yii::$app->session;
        $customer = $session->get('_customer');

        $cid = $customer->cid;
        $oid = $customer->oid;
        $sql = "select t.e_oid as id, t.customerId, t.date, t.assistant_name, t.assistant_phone, t1.bridename, t1.brideemail,t1.bridephone,t1.bridemobile,t1.groomname, t1.groomphone,t1.groommobile,t1.groomemail,t1.culture,t1.culture2 from ns_v1myorder as t left join ns_v1customer as t1 on t1.e_oid = t.customerId where t.e_oid = {$oid} and t.customerId={$cid}";
        $orders = Yii::$app->db1->createCommand($sql)->queryAll();


        $sql1 = "select * from customer_emergency_contact where customer_id = {$cid} and order_id = {$oid}";
        $contacts = Yii::$app->db->createCommand($sql1)->queryAll();

        $culturals = Yii::$app->db1->createCommand('select * from ns_iculture order by name asc ')->queryAll();

        return $this->render('index', 
            [
            'order' => json_decode(json_encode($orders[0])),
            'contact' => json_decode(json_encode($contacts[0])),
            'culturals' => $culturals,
            ]);
    }
    
}
