<?php

namespace app\modules\profile\controllers;

use app\models\Page;
use app\models\Seo;
use app\models\Site;
use Yii;

class MenuController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return (Yii::$app->request->isAjax) ? $this->renderPartial('index') : $this->render('index');
    }

    public function actionContent()
    {
        $site = Site::getSite();
        $pages = Page::getPagesBySite($site['id']);
        $pagesArray = [];
        foreach ($pages as $item) {
            $attributes = $item->attributes;
            if ($item->parent_id) {
                $pagesArray[$item->parent_id]['child'][$item->id] = $attributes;
            } else {
                $pagesArray[$item->id] = $attributes;
            }
        }
        $renderParams = [
            'pages' => $pagesArray,
        ];
        return (Yii::$app->request->isAjax) ? $this->renderPartial('content', $renderParams) : $this->render('content', $renderParams);
    }

    public function actionGrid()
    {
        $site = Site::getSite();
        $model = Site::findOne($site['id']);
        $model->scenario = 'grid';

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $path = Yii::getAlias('@frontend/web/assets');
                @unlink($path . "/" . Yii::$app->user->id . "/bootstrap.css");
                exit('success|back-menu');
            }
        }
        $renderParams = [
            'model'          => $model,
            'gridType'       => Site::$gridType,
            'gridProportion' => Site::$gridProportion,
            'gridSize'       => Site::$gridSize,
            'gridFormat'     => Site::$gridFormat,
            'gridPosition'   => Site::$gridPosition,
        ];
        return (Yii::$app->request->isAjax) ? $this->renderAjax('grid', $renderParams) : $this->render('grid', $renderParams);
    }

    public function actionDesign()
    {
        $site = Site::getSite();
        $model = Site::findOne($site['id']);
        $model->scenario = 'design';
        $renderParams = [
            'model'          => $model,
        ];
        Yii::$app->assetManager->bundles = [
            'yii\web\YiiAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\widgets\ActiveFormAsset' => false,
            'yii\validators\ValidationAsset' => false,
        ];
        return (Yii::$app->request->isAjax) ? $this->renderAjax('design', $renderParams) : $this->render('design', $renderParams);
    }

    public function actionSettings()
    {
        $site = Site::getSite();
        $model = Site::findOne($site['id']);
        $model->scenario = 'edit';
        $modelSeo = Seo::getMeta($site['id'], 'Site');
        if ($modelSeo === null) {
            $modelSeo = new Seo();
        }
        if ($model->load(Yii::$app->request->post())) {
            $modelSeo->load(Yii::$app->request->post());
            if ($model->validate() && $modelSeo->validate()) {
                $model->status = 1;
                $model->update(false);
                $modelSeo->setMeta($model->id, 'Site');
                exit('success|back-menu');
            }
        }
        $renderParams = [
            'model'    => $model,
            'modelSeo' => $modelSeo,
        ];
        Yii::$app->assetManager->bundles = [
            'yii\web\YiiAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\widgets\ActiveFormAsset' => false,
            'yii\validators\ValidationAsset' => false,
        ];
        return (Yii::$app->request->isAjax) ? $this->renderAjax('settings', $renderParams) : $this->render('settings', $renderParams);
    }

}
