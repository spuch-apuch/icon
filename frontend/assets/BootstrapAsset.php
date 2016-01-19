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
        $basePath = $am->basePath . '/' . Yii::$app->user->id;
        $src = Yii::getAlias($this->sourcePath);
        if (!is_dir($basePath)) {
            mkdir($basePath);
        }

        $vars = file_get_contents($this->sourcePath . "/variables.less");
        $css = Yii::$app->cache->get("bootstrap-css-".crc32($vars));
        if (!$css) {

            ini_set('xdebug.max_nesting_level', 200);

            $less = new \lessc();
            $less->setFormatter(YII_DEBUG ? "lessjs" : "compressed");
            @unlink($basePath . "/bootstrap.css");
            $less->compileFile("{$src}/bootstrap.less", "{$basePath}/bootstrap.css");
            Yii::$app->cache->set("bootstrap-css-" . crc32($vars), file_get_contents($basePath . "/bootstrap.css"));
        } else {
            file_put_contents($basePath . "/bootstrap.css", $css);
        }
        $this->css[] = $am->baseUrl . '/' . Yii::$app->user->id . "/bootstrap.css";
    }
}
