<?php
namespace common\assets;

use yii\web\AssetBundle;


class JqueryuiAsset extends AssetBundle
{
    public $sourcePath = '@common/static';
    public $css = [
        'jquery-ui/css/jquery-ui-1.8.20.custom.css'
    ];
    public $js = [
        'jquery-ui/jquery-ui-1.10.2.custom.min.js',
        'jquery-ui/jquery.ui.touch-punch.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
