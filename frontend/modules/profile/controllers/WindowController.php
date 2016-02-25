<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Site;
use app\models\Page;

class WindowController extends \yii\web\Controller
{
    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\HttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionCreateSite()
    {
        $model = new Site();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->status = 0;
            if ($model->insert()) {
                Yii::$app->session->set('thisSite', $model->attributes);
                $page = new Page();
                $page->name = $model->pageName;
                $page->main = 1;
                $page->site_id = $model->id;
                $page->insert(false);
                exit('success|' . Url::toRoute('/profile/menu/index'));
            }
        }
        $renderParams = [
            'model' => $model,
        ];
        Yii::$app->assetManager->bundles = [
            'yii\web\YiiAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\widgets\ActiveFormAsset' => false,
            'yii\validators\ValidationAsset' => false,
        ];
        return $this->renderAjax('create-site', $renderParams);
    }

    public function actionHelp()
    {
        return $this->renderPartial('help');
    }
}
