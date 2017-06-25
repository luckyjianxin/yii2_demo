<?php
namespace backend\assets;
use yii\web\AssetBundle;

class GoogleMapAsset extends AssetBundle
{
    public $sourcePath = '@backend/static';

    public $js = [
        'gomap/jquery.gomap-1.3.3.js',
        'gomap/jquery.dump.js',
        'gomap/jquery.chili-2.2.js'
        // 'js/site.js'
    ];
    public $css = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];


    //  public static function addPageScript($view, $jsfile) {  
    //     $view->registerJsFile($jsfile);  
    // } 

}