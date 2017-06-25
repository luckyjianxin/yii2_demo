<?php
namespace backend\assets;
use yii\web\AssetBundle;

class UeditorAsset extends AssetBundle
{
    public $sourcePath = '@backend/static';

    public $js = [
        'ueditor/ueditor.config.js',
        'ueditor/ueditor.all.js',
        'ueditor/lang/en/en.js'
    ];
    public $css = [
    ];

    public $depends = [
    ];

}