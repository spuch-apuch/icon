<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;
use app\models\Site;

class SiteAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/less';
    public $configPath = '@frontend/web/userdata';
    public $css = [];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.tinyscrollbar.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function publish($am)
    {
        $cssPath = $am->baseUrl . '/' . Yii::$app->user->id;
        $basePath = $am->basePath . '/' . Yii::$app->user->id;

        $site = Yii::$app->request->get('Site');
        if (is_array($site) && count($site)) {
            $vParams = ['vParams' => $this->getVParams($site)];
            $this->js[] = 'js/less.min.js';
            $this->css[] = '/less/variables.php?' . http_build_query($vParams);
            $this->cssOptions = ['rel' => 'stylesheet/less'];
        } else {
            if (!file_exists("{$basePath}/bootstrap.css")) {
                if (!is_dir($basePath)) {
                    mkdir($basePath);
                }
                //ini_set('xdebug.max_nesting_level', 200);
                $less = new \lessc();
                $less->setFormatter(YII_DEBUG ? "lessjs" : "compressed");

                $site = Site::getSite();
                $configPath = $this->generateConfig($site);
                $less->compileFile($configPath, "{$basePath}/bootstrap.css");
            }
            $this->css[] = "{$cssPath}/bootstrap.css";
        }
        if (in_array($site['grid_proportion'], ['proportion-tile', 'proportion-different'])) {
            $this->js[] = 'js/isotope.pkgd.min.js';
            $this->js[] = 'js/packery-mode.pkgd.min.js';
        }
        $this->js[] = 'js/custom.js';
    }

    protected function generateConfig($site)
    {
        $configDir = Yii::getAlias($this->configPath . "/" .  Yii::$app->user->id);
        $configPath = $configDir . "/variables.less";
        if (!is_dir($configDir)) {
            mkdir($configDir);
        }
        $vParams = $this->getVParams($site);
        ob_start();
        include($this->sourcePath  . "/variables.php");
        $vars = ob_get_clean();
        file_put_contents($configPath, $vars);
        return $configPath;
    }

    protected function getVParams($params)
    {
        return [
            'type'     => $params['grid_type'],
            'size'     => Site::$size2int[$params['grid_type']][$params['grid_size']],
            'sizeType' => $params['grid_size'],
            'position' => $params['grid_position'],
            'distance' => ($params['grid_type'] == 'type-tile') ? intval($params['grid_distance']) : 0,
        ];
    }
}
