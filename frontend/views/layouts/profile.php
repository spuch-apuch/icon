<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\BootstrapAsset;
use common\widgets\Alert;
use app\modules\components\MenuWidget;
use yii\helpers\Url;
use app\models\Site;

BootstrapAsset::register($this);
AppAsset::register($this);
\frontend\assets\ProfileAsset::register($this);

$site = Site::getSite();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://use.typekit.net/bqv4ngi.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="panelbar bg0 pull-left scroll-block" id="panel"><?=$content?></div>
<div class="ml280 h100pc text-center relative">
    <?if ($site === false):?>
        <div class="table w100pc h100pc">
            <div class="table-cell middle">
                <p class="fs18 mb5"><a href="<?=Url::toRoute('/profile/window/create-site')?>" class="link-add window-link" data-toggle="modal" data-target="#create-site-modal"><span></span><br/>Создать новый сайт</a></p>
                <p class="c8">Основной этап займет не более 5 минут</p>
            </div>
        </div>
    <?else:
        $iframeUrl = Url::toRoute('/profile/preview/view');?>
        <iframe class="w100pc h100pc" id="preview" src="<?=$iframeUrl?>" data-src="<?=$iframeUrl?>"></iframe>
        <div class="preloader absolute" id="preview-preload"></div>
    <?endif;?>
    <?/*
    <td></td>
    */?>
</div>
<div class="modal fade" id="create-site-modal" tabindex="-1" role="dialog" aria-labelledby="create-site-modal-label"></div>
<div class="modal fade" id="help-modal" tabindex="-1" role="dialog" aria-labelledby="help-modal-label"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
