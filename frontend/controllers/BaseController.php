<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class BaseController extends Controller
{
    /**
     * 在程序执行之前，对访问的方法进行权限验证.
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        //如果未登录，则直接返回
        // if(Yii::$app->user->isGuest){
        //     return $this->goHome();
        // }
        //获取路径
        // $path = Yii::$app->request->pathInfo;

        // //忽略列表
        // if (in_array($path, $this->ignoreList)) {
        //     return true;
        // }

        // if (Yii::$app->user->can($path)) {
        //     return true;
        // } else {
        //     throw new ForbiddenHttpException(Yii::t('app', 'message 401'));
        // }
    }
}
