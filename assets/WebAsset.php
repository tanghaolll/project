<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WebAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/web/bootstrap.min.css',
        'font-awesome/css/font-awesome.css',
        'css/web/style.css?ver=20170401',
        'js/web/theme/default/laydate.css'
    ];
    public $js = [
    	"plugins/jquery-2.1.1.js",
    	"js/web/bootstrap.min.js",
    	"js/web/common.js",
        "js/web/laydate.js",

    ];
    
    
}
