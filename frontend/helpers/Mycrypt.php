<?php
/**
 * Created by PhpStorm.
 * Author: ljt
 * DateTime: 2016/10/20 11:49
 * Description:
 */

namespace frontend\helpers;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Mycrypt 
{
    public static function _mcrypt_decrypt($str, $privateKey, $iv) {
      $results = array();


      if (isset($str)) {
        $encryptedData = base64_decode($str);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
        $results = explode('-', trim($decrypted));
      }

      return $results;
    }
}