<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 关于我们相关页面 前端资源
 */
class HomeAsset extends AssetBundle
{
    public $sourcePath = '@frontend/static';
    /* 全局CSS文件 */
    public $css = [
        'css/home.css',
    ];
    /* 全局JS文件 */
    public $js = [
    ];
    /* 依赖关系 */
    public $depends = [
        'frontend\assets\CoreAsset',
    ];
}
