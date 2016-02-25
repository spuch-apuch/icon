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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/icomoon.css',
        'css/site.css',
        'css/profile.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.autosize.min.js',
        'js/jquery.form.min.js',
        'js/custom.js',
        'js/profile.js',
        'js/forms.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //    'yii\bootstrap\BootstrapPluginAsset',
    ];
}
