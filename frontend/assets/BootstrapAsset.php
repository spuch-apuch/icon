<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/less';
    public $css = [];

    public function publish($am)
    {
        $cssPath = $am->baseUrl . '/bootstrap';
        $basePath = $am->basePath . '/bootstrap';
        $srcPath = Yii::getAlias($this->sourcePath);

        if (!file_exists("{$basePath}/bootstrap.css")) {
            if (!is_dir($basePath)) {
                mkdir($basePath);
            }
            ini_set('xdebug.max_nesting_level', 200);
            $less = new \lessc();
            $less->setFormatter(YII_DEBUG ? "lessjs" : "compressed");

            $less->compileFile("{$srcPath}/variables.less", "{$basePath}/bootstrap.css");
        }
        $this->css[] = "{$cssPath}/bootstrap.css";
    }
}
