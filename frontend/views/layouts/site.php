<?php
use app\models\Site;
use yii\helpers\Html;

frontend\assets\SiteAsset::register($this);

$site = Site::getSite(true);
$leftRightFixed = ($site['grid_position'] == 'logo-fixed-left') ? 'left' : (($site['grid_position'] == 'logo-fixed-right') ? 'right' : '');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://bootstrap-3.ru/assets/ico/favicon.ico">

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--
    <link rel="stylesheet/less" href="/less/variables.php">
    <script src="/js/less.min.js"></script>
-->
    <link href="/css/icomoon.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"></style>
</head>

<body>
<?php $this->beginBody() ?>
<div class="scroll-block">
    <?=app\components\MenuWidget::widget([
        'position' => $site['grid_position'],
        'type'     => $site['grid_type'],
    ]);?>
    <?if ($leftRightFixed):?>
        <div class="container-navbar-fixed <?=$leftRightFixed?>">
    <?endif;?>
    <div class="container">
        <div class="mb10 mb-dynamic">
            <div class="row mb-40px of-hidden">
                <?=$content;?>
            </div>
        </div>
        <footer class="pt20px">
            <ul class="social-icons list-inline text-center mb5">
                <li><a class="icon-facebook" href="http://facebook.com" target="_blank"></a>
                <li><a class="icon-Vkontakte" href="http://vk.com" target="_blank"></a>
                <li><a class="icon-Instagram" href="http://instagram.com" target="_blank"></a>
                <li><a class="icon-Pinterest" href="http://pinterest.com" target="_blank"></a>
                <li><a class="icon-twitter" href="http://twitter.com" target="_blank"></a>
            </ul>
            <p class="text-center c0 mb-dynamic">Powered by <a href="#"><u>Icon</u></a></p>
        </footer>
    </div> <!-- /container -->
    <?if ($leftRightFixed):?>
        </div>
    <?endif;?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>