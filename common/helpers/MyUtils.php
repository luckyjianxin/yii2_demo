<?php
/**
 * Created by PhpStorm.
 * Author: ljt
 * DateTime: 2016/10/20 11:49
 * Description:
 */

namespace common\helpers;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class MyUtils 
{
    public static function customerId($id) {
        $id = intval($id);
        if ($id > 10000) {
          $id = $id;
        } else if ($id < 10000 && $id >= 1000) {
          $id = '0' . $id;
        } else if ($id < 1000 && $id >= 100) {
          $id = '00' . $id;
        } if ($id < 100 && $id >= 10) {
          $id = '000' . id;
        } if ($id < 10 && $id > 0) {
          $id = '0000' . $id;
        }
        return $id;
    }
}