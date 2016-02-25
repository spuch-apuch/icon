<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\models\Page;
use app\models\Site;
use yii\web\Controller;
use yii\filters\AccessControl;

class ProfileController extends Controller
{
    public $layout = 'profile';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create-site', 'view-pages'],
                'rules' => [
                    [
                        'actions' => ['index', 'create-site', 'view-pages'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->getSite();
        return $this->render('index');
    }

    public function actionDesign()
    {
        return $this->render('design');
    }

    public function actionCreateSite()
    {
        $model = new Site();
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
                exit('success|' . Url::toRoute('/profile/'));
            }
        }
        $renderParams = [
            'model' => $model,
        ];
        if (Yii::$app->request->isAjax) {
            Yii::$app->assetManager->bundles = [
                'yii\web\YiiAsset' => false,
                'yii\web\JqueryAsset' => false,
                'yii\widgets\ActiveFormAsset' => false,
                'yii\validators\ValidationAsset' => false,
            ];
            $render = $this->renderAjax('createSite', $renderParams);
        } else {
            $render = $this->render('createSite', $renderParams);
        }
        return $render;
    }

    public function actionContent()
    {
        $this->getSite();
        return $this->render('content');
    }

    public function actionViewPages()
    {
        $this->layout = 'site';
        $site = $this->getSite();
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find([
                'site_id' => $site->id,
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $renderParams = [
            'dataProvider' => $dataProvider,
        ];
        return $this->render('viewPages', $renderParams);
    }



}
