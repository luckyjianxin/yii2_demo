<?php
namespace backend\assets;
use yii\web\AssetBundle;

class SwitcherAsset extends AssetBundle
{
    public $sourcePath = '@backend/static';

    public $js = [
        'plugins/switchery/switchery.min.js',
        // 'js/site.js'
    ];
    public $css = [
        'plugins/switchery/switchery.min.css'
    ];
}