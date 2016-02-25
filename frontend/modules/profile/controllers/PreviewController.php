<?php

namespace app\modules\profile\controllers;

use Yii;
use app\models\Site;

class PreviewController extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/site';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        $site = Site::getSite(true);
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'caption'     => 'Заголовок блока',
                'description' => 'Описание блока',
            ];
        }
        $renderParams = [
            'site' => $site,
            'data' => $data,
        ];
        return $this->render('view', $renderParams);
    }

}
