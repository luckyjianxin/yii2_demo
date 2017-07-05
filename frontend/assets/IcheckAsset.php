<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 关于我们相关页面 前端资源
 */
class IcheckAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /* 全局CSS文件 */
    public $css = [
        'statics/icheck/skins/minimal/_all.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'statics/icheck/icheck.min.js'
    ];
    /* 依赖关系 */
    public $depends = [
        'frontend\assets\CoreAsset',
    ];
}
