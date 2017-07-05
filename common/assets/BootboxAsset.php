<?php
namespace common\assets;

use yii;
use yii\web\AssetBundle;


class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@common/static';
    public $css = [
    ];
    public $js = [
        'bootbox/bootbox.min.js',
        // 'bootbox/main.js',
    ];
    public $depends = [
    	'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public static function overrideSystemConfirm()
    {
        Yii::$app->view->registerJs('
            yii.confirm = function(message, ok, cancel) {
                bootbox.confirm({
				    title: "Confirm Delete?",
				    message: message,
				    buttons: {
				        cancel: {
				            label: "Cancel"
				        },
				        confirm: {
				            label: "Confirm"
				        }
				    },
				    callback: function (result) {
				        if (result) { !ok || ok(); } else { !cancel || cancel(); }
				    }
				});
            }
        ');
    }
}
