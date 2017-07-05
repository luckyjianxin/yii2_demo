<?php
namespace frontend\models;


use common\models\User;
use Yii;
use yii\base\Model;


/**
 * Login form
 */
class Scene extends Model
{
    public $eid;
    public $cid;
    public $oid;
    public $from;


    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public static function getOrderById($cid)
    {
        $sql = "select t.e_oid as id, t.customerId, t.date, t.assistant_name, t.assistant_phone from ns_v1myorder as t where t.customerId={$cid}";
        $orders = Yii::$app->db1->createCommand($sql)->queryAll();
        return !empty($orders) ? $orders[0]['id'] : 0;
    }

}
