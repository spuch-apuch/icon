<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Files;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
        $result = ['status' => 'fail', 'error' => ''];
        $uploadType = strtolower(Yii::$app->request->post('uploadType'));
        $inputName = Yii::$app->request->post('inputName');
        $path = Yii::$app->params['pathTempUpload'] . md5(Yii::$app->session->getId()) . "/";

        $model = new Files();
        $model->file = UploadedFile::getInstanceByName($inputName);
        $model->uploadType = $uploadType;
        if ($model->file && $model->validate()) {
            if ($saveFile = Files::uploadFileToPath($model->file, $path, true)) {
                $result = [
                    'status'   => 'success',
                    'url'      => Files::previewImage([
                        'src'     => $saveFile['img'],
                        'width'   => ($uploadType == 'favicon') ? 16 : 230,
                        'height'  => ($uploadType == 'favicon') ? 16 : 122,
                        'crop'    => true,
                        'feet'    => false,
                        'rewrite' => ($uploadType == 'favicon') ? true : false,
                    ]),
                    'filename' => $saveFile['filename'],
                ];
            }
        } else {
            foreach ($model->errors as $item) {
                $result['error'] .= implode('<br/>', $item) . '<br/>';
            }
        }
        echo Json::encode($result);
    }

    public function actionDeleteTemp()
    {
        $filename = Yii::$app->request->get('file');
        $path = Yii::$app->params['pathTempUpload'] . md5(Yii::$app->session->getId()) . "/";
        if (file_exists(Yii::getAlias("@webroot" . $path . $filename))) {
            Files::deleteFile($path . $filename);
            exit('success');
        }
    }
}
