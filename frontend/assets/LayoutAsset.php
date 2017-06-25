<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LayoutAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic';
    /* 全局CSS文件 */
    public $css = [
        'global/css/components-md.min.css',
        //'global/css/components-rounded.min.css',
        'global/css/plugins-md.min.css',
        //'global/css/plugins.min.css',
        'layouts/layout3/css/themes/green-haze.css',
        'layouts/layout3/css/layout.css',
        'layouts/layout3/css/custom.css',
    ];
    /* 全局JS文件 */
    public $js = [
        'layouts/layout3/scripts/layout.min.js',
        'layouts/layout3/scripts/demo.min.js',
        'layouts/global/scripts/quick-sidebar.min.js',

        'other/js/common.js'
    ];
    /* 选项 */
    //public $jsOptions = ['condition' => 'lt IE9'];
    /* 依赖关系 */
    public $depends = [
        'frontend\assets\CoreAsset',
    ];
}
